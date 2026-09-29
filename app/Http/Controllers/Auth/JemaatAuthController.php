<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class JemaatAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $this->normalizePhone($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => [
                'required',
                'regex:/^628[0-9]{8,11}$/',
                'unique:users,phone',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:72',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'phone.regex' => 'Masukkan nomor Indonesia yang valid, misalnya 081234567890.',
            'phone.unique' => 'Nomor ini sudah terdaftar. Silakan masuk.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password terlalu panjang.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf besar dan 1 angka',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Bcrypt memiliki batas input 72 byte.
        if (strlen($data['password']) > 72) {
            throw ValidationException::withMessages([
                'password' => 'Password terlalu panjang. Gunakan maksimal 72 byte.',
            ]);
        }

        try {
            $user = new User();

            $user->name = $data['name'];
            $user->phone = $data['phone'];
            $user->password = $data['password'];

            // Ditetapkan server, bukan dari pilihan pengguna.
            $user->role = 'jemaat';
            $user->phone_verified_at = null;

            $user->save();
        } catch (UniqueConstraintViolationException $exception) {
            throw ValidationException::withMessages([
                'phone' => 'Nomor ini sudah terdaftar. Silakan masuk.',
            ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('jemaat.account')
            ->with('status', 'Akun berhasil dibuat.');
    }

    public function login(Request $request): RedirectResponse
    {
        $this->normalizePhone($request);

        $data = $request->validate([
            'phone' => ['required', 'regex:/^628[0-9]{8,11}$/'],
            'password' => ['required', 'string', 'max:72'],
        ], [
            'phone.regex' => 'Masukkan nomor WhatsApp yang valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Membatasi percobaan gagal untuk nomor yang sama.
        $key = 'jemaat-login:' . hash('sha256', $data['phone']);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'phone' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $success = Auth::attempt([
            'phone' => $data['phone'],
            'password' => $data['password'],

        ]);

        if (! $success) {
            RateLimiter::hit($key, 60);

            throw ValidationException::withMessages([
                'phone' => 'Nomor WhatsApp atau password tidak cocok.',
            ]);
        }

        RateLimiter::clear($key);

        $request->session()->regenerate();

        return redirect()->route(
            $request->user()->role == 'admin'
                ? 'admin.dashboard'
                : 'home');
    }

    public function account(Request $request): View
    {
        abort_unless($request->user()->role === 'jemaat', 403);

        return view('jemaat.account', [
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('status', 'Kamu berhasil keluar.');
    }

    private function normalizePhone(Request $request): void
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:40'],
        ], [
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.max' => 'Nomor WhatsApp terlalu panjang.',
        ]);

        $phone = trim($request->input('phone'));

        // Mengizinkan pemisah yang umum diketik pengguna.
        $phone = preg_replace('/[\s()\-]+/', '', $phone);

        if (str_starts_with($phone, '+')) {
            $phone = substr($phone, 1);
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $request->merge([
            'phone' => $phone,
        ]);
    }
}