@extends('layouts.main')

@section('title', 'GKI Sunda Kelapa')

@section('content')
<!-- HERO -->
<header class="hero-section" id="beranda">
    <div class="slideshow-container" aria-hidden="true">
        <div
            class="mySlides is-active"
            style="background-image: url('{{ asset('images/bg_greja.jfif') }}');"
        ></div>
        <div
            class="mySlides"
            style="background-image: url('{{ asset('images/bg_greja2.webp') }}');"
        ></div>
        <div
            class="mySlides"
            style="background-image: url('{{ asset('images/bg_greja3.webp') }}');"
        ></div>
        <div class="hero-overlay"></div>
    </div>

    <div class="hero-content">
        <p class="subtitle">Build A REAL Community,</p>
        <h1 class="title">
            Responsibility. Engagement.<br>
            Affection.<br>
            Learning.
        </h1>

        <div class="hero-buttons">
            <a href="#kebaktian" class="btn-primary">
                Jadwal Kebaktian
            </a>
            <a href="#tentang" class="btn-outline">
                Info Lebih Lanjut <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>

    <div class="hero-bottom">
        <a href="#tentang" class="scroll-link">
            Mengenal gereja kami <span aria-hidden="true">&darr;</span>
        </a>
        <button class="slideshow-toggle" type="button">
            Jeda slideshow
        </button>
    </div>
</header>

<!-- TENTANG -->
<section class="section about-section" id="tentang" aria-labelledby="about-title">
    <div class="section-container about-grid">
        <div class="about-visual">
            <img
                src="{{ asset('images/bg_greja.jfif') }}"
                alt="Tampak bangunan GKI Sunda Kelapa"
                class="about-image"
                loading="lazy"
            >
            <div class="about-caption">
                <span class="caption-line" aria-hidden="true"></span>
                <p>Bertumbuh dalam iman, bersama dalam kasih.</p>
            </div>
        </div>

        <div class="about-content">
            <p class="section-label">Tentang Kami</p>
            <h2 class="section-title" id="about-title">
                Selamat Datang di<br>
                <span>GKI Sunda Kelapa</span>
            </h2>

            <p class="section-description">
                Sebuah tempat untuk beribadah, bertumbuh dalam iman,
                dan membangun persekutuan yang saling menguatkan.
                Kami mengundang Anda untuk mengenal kehidupan
                bergereja dan mengambil bagian di dalamnya.
            </p>
            <p class="section-description">
                Melalui semangat REAL — Responsibility, Engagement,
                Affection, dan Learning — mari belajar untuk peduli,
                terlibat, dan melayani bersama.
            </p>

            <div class="values-grid">
                <div class="value-item">
                    <span class="value-letter" aria-hidden="true">R</span>
                    <div>
                        <h3>Responsibility</h3>
                        <p>Bertanggung jawab dalam pelayanan.</p>
                    </div>
                </div>
                <div class="value-item">
                    <span class="value-letter" aria-hidden="true">E</span>
                    <div>
                        <h3>Engagement</h3>
                        <p>Terlibat dalam persekutuan.</p>
                    </div>
                </div>
                <div class="value-item">
                    <span class="value-letter" aria-hidden="true">A</span>
                    <div>
                        <h3>Affection</h3>
                        <p>Saling mengasihi dan memperhatikan.</p>
                    </div>
                </div>
                <div class="value-item">
                    <span class="value-letter" aria-hidden="true">L</span>
                    <div>
                        <h3>Learning</h3>
                        <p>Terus belajar dan bertumbuh.</p>
                    </div>
                </div>
            </div>

            <a href="#kebaktian" class="text-link">
                Temukan jadwal kebaktian <span aria-hidden="true">&rarr;</span>
            </a>
            <p class="demo-note">
                Narasi pengenalan merupakan contoh untuk presentasi.
            </p>
        </div>
    </div>
</section>

<!-- JADWAL KEBAKTIAN -->
<section class="section worship-section" id="kebaktian" aria-labelledby="worship-title">
    <div class="section-container">
        <div class="section-heading">
            <p class="section-label">Waktu Beribadah</p>
            <h2 class="section-title" id="worship-title">
                Mari Beribadah <span>Bersama</span>
            </h2>
            <p class="section-description">
                Temukan waktu untuk bersekutu, mendengarkan firman,
                dan bertumbuh bersama dalam iman.
            </p>
        </div>

        <div class="schedule-grid">
            <article class="schedule-card">
                <span class="card-category"></span>
                <h3>Kebaktian Umum</h3>
                <p class="card-description">
                    Membangun Komunitas yang REAL
                </p>
                <dl class="schedule-details">
                    <div><dt>Hari</dt><dd>Minggu</dd></div>
                    <div><dt>Waktu</dt><dd>07.30 WIB/dd></div>
                    <div><dt>Lokasi</dt><dd>Ruangan Ibadah</dd></div>
                </dl>
                <p class="card-footer">Kebaktian Umum</p>
            </article>

            <article class="schedule-card">
                <span class="card-category"></span>
                <h3>Sekolah Minggu</h3>
                <p class="card-description">
                    Mengenal kasih Tuhan dan belajar bersama
                    melalui kegiatan anak.
                </p>
                <dl class="schedule-details">
                    <div><dt>Hari</dt><dd>Minggu</dd></div>
                    <div><dt>Waktu</dt><dd>09.00 WIB</dd></div>
                    <div><dt>Lokasi</dt><dd>Ruang Kebaktian</dd></div>
                </dl>
                <p class="card-footer">Sekolah Minggu</p>
            </article>

            <article class="schedule-card">
                <span class="card-category"></span>
                <h3>Persekutuan Remaja Pemuda</h3>
                <p class="card-description">
                    Bertumbuh dalam iman dan membangun
                    persahabatan dalam komunitas.
                </p>
                <dl class="schedule-details">
                    <div><dt>Hari</dt><dd>Minggu</dd></div>
                    <div><dt>Waktu</dt><dd>11.00 WIB</dd></div>
                    <div><dt>Lokasi</dt><dd>Ruang Kebaktian</dd></div>
                </dl>
                <p class="card-footer">KRKP</p>
            </article>
        </div>
    </div>
</section>

<!-- WARTA DAN KEGIATAN -->
<section class="section news-section" id="warta" aria-labelledby="news-title">
    <div class="section-container">
        <div class="news-heading">
            <div>
                <p class="section-label">Kabar Persekutuan</p>
                <h2 class="section-title" id="news-title">
                    Warta & <span>Kegiatan</span>
                </h2>
            </div>
            <p class="section-description">
                Ikuti kabar, pengumuman, dan kegiatan
                dalam kehidupan bergereja.
            </p>
        </div>

        <div class="news-toolbar">
            <div class="news-filters" role="group" aria-label="Filter warta dan kegiatan">
                <button
                    class="filter-btn is-active"
                    type="button"
                    data-filter="semua"
                    aria-pressed="true"
                    aria-controls="news-grid"
                >Semua</button>
                <button
                    class="filter-btn"
                    type="button"
                    data-filter="warta"
                    aria-pressed="false"
                    aria-controls="news-grid"
                >Warta</button>
                <button
                    class="filter-btn"
                    type="button"
                    data-filter="kegiatan"
                    aria-pressed="false"
                    aria-controls="news-grid"
                >Kegiatan</button>
            </div>
            <p class="demo-label">Konten contoh untuk presentasi</p>
        </div>

        <p class="sr-only" id="filter-status" role="status"></p>

        <div class="news-grid" id="news-grid">
            <!-- WARTA -->
            <article class="news-card" data-category="warta">
                <div class="news-cover cover-warta">
                    <span class="cover-kicker">GKI Sunda Kelapa</span>
                    <p class="cover-title">Warta<br>Jemaat.</p>
                    <span class="cover-footnote">Bertumbuh bersama dalam iman</span>
                </div>

                <div class="news-card-body">
                    <div class="news-meta">
                        <span class="news-badge">Warta</span>
                        
                    </div>
                    <h3>Warta Jemaat Mingguan</h3>
                    <p class="news-excerpt">
                        Ringkasan informasi ibadah, pengumuman,
                        dan kabar pelayanan untuk jemaat.
                    </p>
                    <button
                        class="text-link news-detail-btn"
                        type="button"
                        data-news="warta-mingguan"
                        aria-haspopup="dialog"
                        aria-label="Baca selengkapnya: Warta Jemaat Mingguan"
                    >
                        Baca Selengkapnya <span aria-hidden="true">&rarr;</span>
                    </button>
                </div>
            </article>

            <!-- KEGIATAN 1 -->
            <article class="news-card" data-category="kegiatan">
                <div class="news-cover cover-fellowship">
                    <span class="cover-kicker">GKI Sunda Kelapa</span>
                    <p class="cover-title">Doa Pagi<br>Anugerah.</p>
                    <span class="cover-footnote">Setiap Sabtu 06.00 WIB (online)</span>
                </div>

                <div class="news-card-body">
                    <div class="news-meta">
                        <span class="news-badge">Kegiatan</span>
                    </div>
                    <h3>Doa Pagi Anugerah</h3>
                    <p class="news-excerpt">
                        Untuk link zoom dapat diakses melalui: 
                        s.id/doa-pagi atau scan barcode pada info gambar.
                    </p>
                    <button
                        class="text-link news-detail-btn"
                        type="button"
                        data-news="persekutuan"
                        aria-haspopup="dialog"
                        aria-label="Lihat detail: Persekutuan dan Doa Bersama"
                    >
                        Lihat Detail <span aria-hidden="true">&rarr;</span>
                    </button>
                </div>
            </article>

            <!-- KEGIATAN 2 -->
            <article class="news-card" data-category="kegiatan">
                <div class="news-cover cover-service">
                    <span class="cover-kicker">GKI Sunda Kelapa</span>
                    <p class="cover-title">GEBER<br>Gerakan Berdoa.</p>
                    <span class="cover-footnote">Setiap Hari Rabu 20.00 WIB (online)</span>
                </div>

                <div class="news-card-body">
                    <div class="news-meta">
                        <span class="news-badge">Kegiatan</span>
                        
                    </div>
                    <h3>Kegiatan Berbagi Kasih</h3>
                    <p class="news-excerpt">
                        Menumbuhkan kepedulian melalui
                        kebersamaan dan pelayanan kepada sesama.
                    </p>
                    <button
                        class="text-link news-detail-btn"
                        type="button"
                        data-news="berbagi-kasih"
                        aria-haspopup="dialog"
                        aria-label="Lihat detail: Kegiatan Berbagi Kasih"
                    >
                        Lihat Detail <span aria-hidden="true">&rarr;</span>
                    </button>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection

@section('dialogs')
<!-- POPUP DETAIL WARTA / KEGIATAN -->
<dialog class="news-dialog" id="news-dialog" aria-labelledby="dialog-title">
    <div class="dialog-top">
        <span class="news-badge" id="dialog-category"></span>
        <form method="dialog">
            <button class="dialog-close" aria-label="Tutup detail" autofocus>
                &times;
            </button>
        </form>
    </div>

    <div class="dialog-content">
        <p class="section-label">GKI Sunda Kelapa</p>
        <h2 class="section-title" id="dialog-title"></h2>
        <p class="dialog-notice">
            Contoh untuk presentasi — bukan pengumuman resmi gereja.
        </p>

        <div id="dialog-description"></div>
        <dl class="dialog-details" id="dialog-details"></dl>
        <p class="dialog-info" id="dialog-info"></p>
    </div>

    <div class="dialog-bottom">
        <form method="dialog">
            <button class="btn-primary">Tutup Detail</button>
        </form>
    </div>
</dialog>
<!-- LOKASI DAN KONTAK -->
<section
    class="section contact-section"
    id="kontak"
    aria-labelledby="contact-title"
>
    <div class="section-container">

        <div class="contact-heading">
            <p class="section-label">Temui Kami</p>

            <h2 class="section-title" id="contact-title">
                Kami Menantikan <span>Kehadiran Anda</span>
            </h2>

            <p class="section-description">
                Temukan lokasi gereja dan rencanakan kunjungan Anda.
                Mari beribadah dan bertumbuh bersama di GKI Sunda Kelapa.
            </p>
        </div>

        <div class="contact-grid">

            <!-- ALAMAT DAN KONTAK -->
            <div class="contact-info">
                <div class="contact-address-block">
                    <span class="contact-eyebrow">
                        Lokasi Gereja
                    </span>

                    <h3>GKI Sunda Kelapa</h3>

                    <address>
                        Jl. Ekor Kuning No.20, RT.3/RW.3,
                        Penjaringan, Kecamatan Penjaringan,
                        Jakarta Utara, Daerah Khusus Ibukota Jakarta 14440
                    </address>

                    <a
                        class="btn-primary contact-direction"
                        href="https://www.google.com/maps/dir/?api=1&amp;destination=-6.1301637%2C106.8088972"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Google Maps
                        <span aria-hidden="true">&#8599;</span>
                        <span class="sr-only">
                            (buka Google Maps di tab baru)
                        </span>
                    </a>
                </div>

                <!-- ISI SETELAH KONTAK RESMI TERSEDIA -->
                <dl class="contact-details">
                    <div>
                        <dt>Telepon / WhatsApp</dt>
                        <dd>Belum tersedia</dd>
                    </div>

                    <div>
                        <dt>Email Sekretariat</dt>
                        <dd>Belum tersedia</dd>
                    </div>

                    <div>
                        <dt>Jam Pelayanan Sekretariat</dt>
                        <dd>Belum tersedia</dd>
                    </div>
                </dl>

                <p class="contact-note">
                    Informasi kontak akan dilengkapi setelah dikonfirmasi.
                </p>
            </div>

            <!-- GOOGLE MAPS -->
            <div class="contact-map-card">
                <iframe
                    class="contact-map"
                    src="https://maps.google.com/maps?q=-6.1301637%2C106.8088972&amp;z=17&amp;output=embed"
                    title="Peta lokasi GKI Sunda Kelapa, Jalan Ekor Kuning No.20, Jakarta Utara"
                    width="640"
                    height="440"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>

                <div class="contact-map-caption">
                    <div>
                        <p class="map-location-name">
                            GKI Sunda Kelapa
                        </p>
                        <p>Penjaringan, Jakarta Utara</p>
                    </div>

                    <a
                        class="text-link"
                        href="https://www.google.com/maps/place/GKI+Sunda+Kelapa/@-6.1301637,106.8063223,17z/data=!3m1!4b1!4m6!3m5!1s0x2e6a1db620b1ac19:0xeb893c845b2ca8bf!8m2!3d-6.1301637!4d106.8088972!16s%2Fg%2F11kj26ymqr"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Buka Google Maps
                        <span aria-hidden="true">&#8599;</span>
                        <span class="sr-only">(tab baru)</span>
                    </a>
                </div>

                <p class="map-fallback">
                    Jika peta tidak tampil, gunakan tautan Google Maps di atas.
                </p>
            </div>

        </div>
    </div>
</section>
@endsection
