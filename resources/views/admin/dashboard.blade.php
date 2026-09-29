<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin — GKI Sunda Kelapa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="admin-page">
    <header class="admin-header">
        <nav class="admin-nav" aria-label="Navigasi admin">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <img
                    src="{{ asset('images/logo_gki.png') }}"
                    alt=""
                    width="40"
                    height="44"
                >

                <span>
                    <strong>GKI Sunda Kelapa</strong>
                    <small>Administrasi Gereja</small>
                </span>
            </a>

            <div class="admin-nav-actions">
                <a href="{{ route('home') }}" class="admin-site-link">
                    Lihat Website
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="admin-button">
                        Keluar
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <main class="admin-main">
        <p class="admin-eyebrow">Dashboard Admin</p>

        <h1 class="admin-title">
            Selamat datang, {{ $admin->name }}.
        </h1>

        <p class="admin-intro">
            Ringkasan akun terdaftar dan pusat pengelolaan
            website GKI Sunda Kelapa.
        </p>

        <dl class="admin-stats">
            <div class="admin-stat">
                <dt>Akun Jemaat</dt>
                <dd>{{ number_format($jemaatAccounts, 0, ',', '.') }}</dd>
            </div>

            <div class="admin-stat">
                <dt>Akun Admin</dt>
                <dd>{{ number_format($adminAccounts, 0, ',', '.') }}</dd>
            </div>

            <div class="admin-stat">
                <dt>Jemaat Belum Verifikasi Nomor</dt>
                <dd>{{ number_format($pendingVerification, 0, ',', '.') }}</dd>
            </div>
        </dl>

        <section aria-labelledby="management-title">
            <h2 id="management-title" class="admin-section-title">
                Pengelolaan
            </h2>

            <div class="admin-modules">
                <article class="admin-module">
                    <span class="admin-badge">Aktif</span>

                    <h3>Warta Jemaat</h3>

                    <p>
                        Unggah PDF, atur tanggal terbit, dan kelola
                        warta yang ditampilkan kepada jemaat.
                    </p>

                    <a href="{{ route('admin.warta.index') }}" class="admin-button">
                        kelola Warta
                    </a>
                </article>

                <article class="admin-module">
                    <span class="admin-badge">Belum tersedia</span>

                    <h3>Data Jemaat &amp; Keluarga</h3>

                    <p>
                        Kelola identitas jemaat dan hubungan
                        anggota dalam satu keluarga.
                    </p>
                </article>

                <article class="admin-module">
                    <span class="admin-badge">Belum tersedia</span>

                    <h3>Kebaktian &amp; Absensi</h3>

                    <p>
                        Buat sesi kebaktian, tampilkan QR,
                        dan pantau rekap kehadiran.
                    </p>
                </article>

                <article class="admin-module">
                    <span class="admin-badge">Belum tersedia</span>

                    <h3>Pengaturan Pengurus</h3>

                    <p>
                        Kelola akun pengurus dan akses
                        sesuai bidang pelayanannya.
                    </p>
                </article>
            </div>
        </section>

        <p class="admin-note">
            Statistik menghitung akun website yang sudah terdaftar.
            Verifikasi WhatsApp belum diaktifkan.
        </p>
    </main>
</body>
</html>