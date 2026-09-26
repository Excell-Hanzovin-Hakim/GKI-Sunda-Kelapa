function initChurchWebsite() {
    // MENU MOBILE
    const menuToggle = document.querySelector(".menu-toggle");
    const navbarMenu = document.querySelector(".navbar-menu");

    function closeMenu() {
        navbarMenu.classList.remove("is-open");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.setAttribute("aria-label", "Buka menu");
    }

    menuToggle.addEventListener("click", () => {
        const isOpen = navbarMenu.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", String(isOpen));
        menuToggle.setAttribute("aria-label", isOpen ? "Tutup menu" : "Buka menu");
    });

    document.querySelectorAll(".navbar a").forEach((link) => {
        link.addEventListener("click", closeMenu);
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            const wasOpen = navbarMenu.classList.contains("is-open");
            closeMenu();
            if (wasOpen) menuToggle.focus();
        }
    });

    document.addEventListener("click", (event) => {
        if (!event.target.closest(".navbar")) closeMenu();
    });

    window.matchMedia("(min-width: 901px)")
        .addEventListener("change", closeMenu);

    // Fitur di bawah ini khusus halaman beranda.
    if (!document.querySelector("#beranda")) return;

    // SLIDESHOW
    const slides = document.querySelectorAll(".mySlides");
    const slideshowToggle = document.querySelector(".slideshow-toggle");
    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

    let slideIndex = 0;
    let slideshowTimer = null;
    let isPaused = reducedMotion.matches;

    function showNextSlide() {
        slides[slideIndex].classList.remove("is-active");
        slideIndex = (slideIndex + 1) % slides.length;
        slides[slideIndex].classList.add("is-active");
    }

    function updateSlideshow() {
        window.clearInterval(slideshowTimer);
        slideshowTimer = null;

        if (!isPaused && !document.hidden && slides.length > 1) {
            slideshowTimer = window.setInterval(showNextSlide, 5000);
        }

        slideshowToggle.textContent =
            isPaused ? "Putar slideshow" : "Jeda slideshow";
    }

    slideshowToggle.addEventListener("click", () => {
        isPaused = !isPaused;
        updateSlideshow();
    });

    document.addEventListener("visibilitychange", updateSlideshow);
    reducedMotion.addEventListener("change", (event) => {
        isPaused = event.matches;
        updateSlideshow();
    });

    updateSlideshow();

    // PESAN LOGIN DEMO
    const loginNote = document.querySelector("#login-note");
    let toastTimer;

    document.querySelector(".btn-login").addEventListener("click", () => {
        closeMenu();
        window.clearTimeout(toastTimer);
        loginNote.textContent = "Halaman Login Pengurus sedang disiapkan.";
        loginNote.classList.add("is-visible");

        toastTimer = window.setTimeout(() => {
            loginNote.classList.remove("is-visible");
        }, 4000);
    });

    // FILTER WARTA / KEGIATAN
    const filterButtons = document.querySelectorAll(".filter-btn");
    const newsCards = document.querySelectorAll(".news-card");
    const filterStatus = document.querySelector("#filter-status");

    filterButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const category = button.dataset.filter;
            let visibleCount = 0;

            filterButtons.forEach((item) => {
                const active = item === button;
                item.classList.toggle("is-active", active);
                item.setAttribute("aria-pressed", String(active));
            });

            newsCards.forEach((card) => {
                const matches =
                    category === "semua" || card.dataset.category === category;
                card.hidden = !matches;
                if (matches) visibleCount++;
            });

            filterStatus.textContent =
                `${visibleCount} konten ditampilkan untuk kategori ${button.textContent.trim()}.`;
        });
    });

    // DATA CONTOH UNTUK POPUP DETAIL
    // Ganti isi data ini dengan informasi resmi setelah tersedia.
    const newsData = {
        "warta-mingguan": {
            category: "Warta",
            title: "Warta Jemaat Mingguan",
            paragraphs: [
                "Warta jemaat menjadi ruang untuk menyampaikan informasi ibadah, pengumuman, dan kabar pelayanan dalam kehidupan bergereja.",
                "Pada versi final, bagian ini dapat memuat tema ibadah, bacaan Alkitab, pengumuman jemaat, serta tautan dokumen warta mingguan."
            ],
            details: [
                ["Edisi", "Contoh tampilan"],
                ["Tanggal terbit", "Belum diisi"]
            ],
            info: "Dokumen PDF warta belum tersedia pada contoh ini."
        },
        "persekutuan": {
            category: "Kegiatan",
            title: "Persekutuan & Doa Bersama",
            paragraphs: [
                "Contoh agenda persekutuan untuk menyediakan waktu berbagi, mendengarkan firman, dan saling menguatkan dalam doa.",
                "Informasi peserta, susunan kegiatan, dan kontak penanggung jawab dapat ditambahkan setelah agenda resmi tersedia."
            ],
            details: [
                ["Hari / tanggal", "Belum ditentukan"],
                ["Waktu", "Belum ditentukan"],
                ["Lokasi", "Belum ditentukan"]
            ],
            info: "Agenda ini hanya contoh desain. Pendaftaran belum tersedia."
        },
        "berbagi-kasih": {
            category: "Kegiatan",
            title: "Kegiatan Berbagi Kasih",
            paragraphs: [
                "Contoh kegiatan yang mengajak jemaat menumbuhkan kepedulian dan mengambil bagian dalam pelayanan kepada sesama.",
                "Pada pengumuman resmi, bagian ini dapat menjelaskan bentuk kegiatan, kebutuhan pelayanan, serta cara jemaat berpartisipasi."
            ],
            details: [
                ["Hari / tanggal", "Belum ditentukan"],
                ["Waktu", "Belum ditentukan"],
                ["Lokasi", "Belum ditentukan"]
            ],
            info: "Agenda ini hanya contoh desain. Informasi partisipasi belum tersedia."
        }
    };

    // POPUP DETAIL
    const newsDialog = document.querySelector("#news-dialog");
    const dialogDescription = document.querySelector("#dialog-description");
    const dialogDetails = document.querySelector("#dialog-details");
    let lastDetailButton = null;

    document.querySelectorAll(".news-detail-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const data = newsData[button.dataset.news];
            if (!data) return;

            lastDetailButton = button;

            document.querySelector("#dialog-category").textContent = data.category;
            document.querySelector("#dialog-title").textContent = data.title;
            document.querySelector("#dialog-info").textContent = data.info;

            dialogDescription.replaceChildren();
            data.paragraphs.forEach((text) => {
                const paragraph = document.createElement("p");
                paragraph.className = "section-description";
                paragraph.textContent = text;
                dialogDescription.append(paragraph);
            });

            dialogDetails.replaceChildren();
            data.details.forEach(([label, value]) => {
                const row = document.createElement("div");
                const term = document.createElement("dt");
                const description = document.createElement("dd");

                term.textContent = label;
                description.textContent = value;
                row.append(term, description);
                dialogDetails.append(row);
            });

            newsDialog.showModal();
            document.body.classList.add("modal-open");
        });
    });

    // Klik di luar kotak untuk menutup popup.
    newsDialog.addEventListener("click", (event) => {
        if (event.target !== newsDialog) return;

        const rect = newsDialog.getBoundingClientRect();
        const outside =
            event.clientX < rect.left || event.clientX > rect.right ||
            event.clientY < rect.top || event.clientY > rect.bottom;

        if (outside) newsDialog.close();
    });

    // Tombol Escape juga menutup dialog secara otomatis.
    newsDialog.addEventListener("close", () => {
        document.body.classList.remove("modal-open");
        lastDetailButton?.focus();
    });
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initChurchWebsite, { once: true });
} else {
    initChurchWebsite();
}
