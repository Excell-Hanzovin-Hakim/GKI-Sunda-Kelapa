@extends('layouts.auth')

@section('title', 'Akun Jemaat')

@section('content')
    <p class="auth-eyebrow">Akun Jemaat</p>

    <h1 id="page-title">Halo, {{ $user->name }}</h1>

    <p class="auth-description">
        Selamat datang di ruang jemaat GKI Sunda Kelapa.
    </p>

    @if (! $user->phone_verified_at)
        <div class="auth-alert notice" role="status">
            Nomor WhatsApp kamu belum terverifikasi.
            Verifikasi WhatsApp belum tersedia.
            Fitur absensi belum dapat digunakan.
        </div>
    @else
        <div class="auth-alert success" role="status">
            Nomor WhatsApp kamu sudah terverifikasi.
        </div>
    @endif

    <dl class="account-details">
        <div>
            <dt>Nama lengkap</dt>
            <dd>{{ $user->name }}</dd>
        </div>

        <div>
            <dt>Nomor WhatsApp</dt>
            <dd>+{{ $user->phone }}</dd>
        </div>

        <div>
            <dt>Jenis akun</dt>
            <dd>Jemaat</dd>
        </div>
    </dl>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="auth-submit">
            Keluar
        </button>
    </form>
@endsection