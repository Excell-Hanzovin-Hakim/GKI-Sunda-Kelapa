@extends('layouts.auth')

@section('title', 'Masuk Jemaat')

@section('content')
    <p class="auth-eyebrow">Ruang Jemaat</p>

    <h1 id="page-title">Selamat datang kembali</h1>

    <p class="auth-description">
        Masuk menggunakan nomor WhatsApp yang kamu daftarkan.
    </p>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="auth-field">
            <label for="phone">Nomor WhatsApp</label>

            <input
                id="phone"
                name="phone"
                type="tel"
                inputmode="tel"
                autocomplete="username"
                placeholder="081234567890"
                value="{{ old('phone') }}"
                maxlength="40"
                aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}"
                required
            >
        </div>

        <div class="auth-field">
            <label for="password">Password</label>

            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                maxlength="72"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                required
            >
        </div>

        <button type="submit" class="auth-submit">
            Masuk
        </button>
    </form>

    <p class="auth-switch">
        Belum punya akun?
        <a href="{{ route('register') }}">Registrasi</a>
    </p>
@endsection