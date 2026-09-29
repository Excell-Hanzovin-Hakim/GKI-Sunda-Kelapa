@extends('layouts.auth')

@section('title', 'Daftar Jemaat')

@section('content')
    <p class="auth-eyebrow">Ruang Jemaat</p>

    <h1 id="page-title">Mari terhubung</h1>

    <p class="auth-description">
        Buat akun menggunakan nama dan nomor WhatsApp milikmu.
    </p>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="auth-field">
            <label for="name">Nama lengkap</label>

            <input
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                value="{{ old('name') }}"
                maxlength="100"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                required
            >
        </div>

        <div class="auth-field">
            <label for="phone">Nomor WhatsApp</label>

            <input
                id="phone"
                name="phone"
                type="tel"
                inputmode="tel"
                autocomplete="tel"
                placeholder="081234567890"
                value="{{ old('phone') }}"
                maxlength="40"
                aria-describedby="phone-hint"
                aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}"
                required
            >

            <small id="phone-hint" class="auth-hint">
                Gunakan nomor Indonesia yang aktif.
            </small>
        </div>

        <div class="auth-field">
            <label for="password">Password</label>

            <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                minlength="6"
                maxlength="72"
                aria-describedby="password-hint"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                required
            >

            <small id="password-hint" class="auth-hint">
                Minimal 6 karakter, dan menggunakan minimal 1 huruf besar dan 1 angka, contoh : Andi123.
            </small>
        </div>

        <div class="auth-field">
            <label for="password_confirmation">
                Ulangi password
            </label>

            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                minlength="6"
                maxlength="72"
                required
            >
        </div>

        <button type="submit" class="auth-submit">
            Buat akun
        </button>
    </form>

    <p class="auth-switch">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk</a>
    </p>
@endsection