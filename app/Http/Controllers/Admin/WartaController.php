<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WartaController extends Controller
{
    public function index(): View
    {
        return view('admin.warta.index', [
            'wartas' => Warta::orderByDesc('edition_date')
                ->orderByDesc('id')
                ->paginate(10),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'edition_date' => ['required', 'date_format:Y-m-d'],
            'summary' => ['nullable', 'string', 'max:2000'],
            'pdf' => [
                'required',
                'file',
                'mimes:pdf',
                'extensions:pdf',
                'max:20480',
            ],
            'is_published' => ['sometimes', 'boolean'],
        ], [
            'title.required' => 'Judul warta wajib diisi.',
            'title.max' => 'Judul maksimal 150 karakter.',
            'edition_date.required' => 'Tanggal warta wajib diisi.',
            'edition_date.date_format' => 'Tanggal warta tidak valid.',
            'summary.max' => 'Ringkasan maksimal 2.000 karakter.',
            'pdf.required' => 'Pilih file PDF warta.',
            'pdf.file' => 'File tidak berhasil diunggah.',
            'pdf.mimes' => 'File harus berupa PDF.',
            'pdf.extensions' => 'Nama file harus berakhiran .pdf.',
            'pdf.max' => 'Ukuran PDF maksimal 20 MB.',
            'pdf.uploaded' => 'Unggahan gagal. Periksa ukuran file.',
        ]);

        // Simpan secara privat, bukan langsung di folder public.
        $path = $request->file('pdf')->store('warta', 'local');

        if (! $path) {
            return back()
                ->withInput($request->except('pdf'))
                ->withErrors([
                    'pdf' => 'File gagal disimpan. Silakan coba lagi.',
                ]);
        }

        try {
            Warta::create([
                'title' => $data['title'],
                'edition_date' => $data['edition_date'],
                'summary' => $data['summary'] ?? null,
                'pdf_path' => $path,
                'is_published' => $request->boolean('is_published'),
                'uploaded_by' => $request->user()->id,
            ]);
        } catch (\Throwable $exception) {
            // Hindari file tertinggal jika penyimpanan database gagal.
            Storage::disk('local')->delete($path);

            throw $exception;
        }

        return redirect()
            ->route('admin.warta.index')
            ->with('status', 'Warta berhasil disimpan.');
    }

    public function updateStatus(
        Request $request,
        Warta $warta
    ): RedirectResponse {
        $data = $request->validate([
            'is_published' => ['required', 'boolean'],
        ]);

        $warta->update([
            'is_published' => (bool) $data['is_published'],
        ]);

        return redirect()
            ->route('admin.warta.index')
            ->with('status', 'Status warta berhasil diperbarui.');
    }

    public function pdf(
        Request $request,
        Warta $warta
    ): BinaryFileResponse {
        // Draft hanya dapat dibuka admin.
        abort_unless(
            $warta->is_published
                || $request->user()?->role === 'admin',
            404
        );

        $disk = Storage::disk('local');

        abort_unless($disk->exists($warta->pdf_path), 404);

        return response()->file($disk->path($warta->pdf_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>
                'inline; filename="warta-' . $warta->id . '.pdf"',
            'Cache-Control' => 'private, no-store',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function destroy(Warta $warta): RedirectResponse
{
    try {
        $disk = Storage::disk('local');

        // Hapus file PDF jika masih tersimpan.
        if ($disk->exists($warta->pdf_path)) {
            $deleted = $disk->delete($warta->pdf_path);

            if (! $deleted) {
                throw new \RuntimeException('File PDF gagal dihapus.');
            }
        }

        // Hapus data warta setelah file berhasil dihapus.
        // Jika file sudah tidak ada, data tetap dapat dibersihkan.
        $warta->deleteOrFail();
    } catch (\Throwable $exception) {
        report($exception);

        return redirect()
            ->route('admin.warta.index')
            ->withErrors([
                'delete' => 'Penghapusan belum selesai. Silakan coba lagi. Jika tetap gagal, periksa log Laravel.',
            ]);
    }

    return redirect()
        ->route('admin.warta.index')
        ->with('status', 'Warta dan file PDF berhasil dihapus.');
}
}