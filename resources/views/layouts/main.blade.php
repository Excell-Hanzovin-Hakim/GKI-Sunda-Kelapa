<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GKI Sunda Kelapa')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar" aria-label="Navigasi utama">
        <a
            href="{{ route('home') }}#beranda"
            class="logo"
            aria-label="GKI Sunda Kelapa — Beranda"
        >
            <img
                src="{{ asset('images/logo_gki.png') }}"
                alt=""
                width="40"
                height="40"
            >
            <span>GKI Sunda Kelapa</span>
        </a>

        <button
            class="menu-toggle"
            type="button"
            aria-label="Buka menu"
            aria-expanded="false"
            aria-controls="navbar-menu"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navbar-menu" id="navbar-menu">
            <ul class="nav-links">
                <li>
                    <a href="{{ route('home') }}#tentang">Tentang</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#kebaktian">Kebaktian</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#warta">Warta</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#kontak">Kontak</a>
                </li>
            </ul>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-login">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('jemaat.account') }}" class="btn-login">
                        Akun Saya
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-login">
                    Login
                </a>
            @endauth
        </div>
    </nav>

    <!-- KONTEN HALAMAN -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="site-footer footer-expanded">
        <div class="section-container">
            <div class="footer-grid">

                <!-- IDENTITAS GEREJA -->
                <div class="footer-about">
                    <a
                        href="{{ route('home') }}#beranda"
                        class="logo footer-logo"
                    >
                        <img
                            src="{{ asset('images/logo_gki.png') }}"
                            alt=""
                            width="40"
                            height="40"
                        >
                        <span>GKI Sunda Kelapa</span>
                    </a>

                    <p class="footer-motto">
                        Build A REAL Community.
                    </p>

                    <p class="footer-description">
                        Bertumbuh dalam iman, bersama dalam kasih.
                    </p>

                    <address class="footer-address">
                        Jl. Ekor Kuning No.20, RT.3/RW.3,
                        Penjaringan, Kecamatan Penjaringan,
                        Jakarta Utara, Daerah Khusus Ibukota Jakarta 14440
                    </address>
                </div>

                <!-- NAVIGASI FOOTER -->
                <nav class="footer-nav" aria-label="Navigasi footer">
                    <h2 class="footer-heading">Jelajahi</h2>

                    <ul>
                        <li>
                            <a href="{{ route('home') }}#beranda">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#tentang">
                                Tentang Gereja
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#kebaktian">
                                Jadwal Kebaktian
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#warta">
                                Warta &amp; Kegiatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#kontak">
                                Lokasi &amp; Kontak
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- MEDIA SOSIAL -->
                <div class="footer-social">
                    <h2 class="footer-heading">
                        Terhubung dengan Kami
                    </h2>

                    <p class="footer-description">
                        Informasi media sosial resmi gereja
                        akan ditampilkan di sini.
                    </p>

                    <p class="footer-pending">
                        Media sosial: belum tersedia
                    </p>

                    <a
                        href="{{ route('home') }}#kontak"
                        class="text-link"
                    >
                        Kunjungi Kami
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- COPYRIGHT -->
            <div class="footer-bottom">
                <p>
                    &copy; {{ date('Y') }} GKI Sunda Kelapa.
                    Seluruh hak cipta dilindungi.
                </p>

                <a
                    href="{{ route('home') }}#beranda"
                    class="text-link"
                >
                    Kembali ke atas
                    <span aria-hidden="true">&uarr;</span>
                </a>
            </div>
        </div>
    </footer>

    <!-- POPUP DARI HALAMAN -->
    @yield('dialogs')

    <!-- PESAN LOGIN DEMO -->
    <p class="toast" id="login-note" role="status"></p>
</body>
</html>