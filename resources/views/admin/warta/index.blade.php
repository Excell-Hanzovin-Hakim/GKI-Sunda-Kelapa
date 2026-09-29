@extends('layouts.admin')

@section('title', 'Kelola Warta')

@section('content')
    <p class="admin-eyebrow">Publikasi Gereja</p>

    <h1 class="admin-title">Warta Jemaat</h1>

    <p class="admin-intro">
        Unggah PDF dan tentukan warta yang dapat dibaca jemaat.
    </p>

    <section class="admin-panel" aria-labelledby="upload-title">
        <h2 id="upload-title" class="admin-section-title">
            Tambah Warta
        </h2>

        <form
            method="POST"
            action="{{ route('admin.warta.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="admin-form-grid">
                <div class="admin-field">
                    <label for="title">Judul warta</label>

                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        placeholder="Warta Jemaat — 4 Oktober 2026"
                        maxlength="150"
                        required
                    >
                </div>

                <div class="admin-field">
                    <label for="edition_date">Tanggal warta</label>

                    <input
                        id="edition_date"
                        name="edition_date"
                        type="date"
                        value="{{ old('edition_date') }}"
                        required
                    >
                </div>
            </div>

            <div class="admin-field">
                <label for="summary">Ringkasan (opsional)</label>

                <textarea
                    id="summary"
                    name="summary"
                    rows="3"
                    maxlength="2000"
                    placeholder="Pengantar singkat untuk warta ini."
                >{{ old('summary') }}</textarea>
            </div>

            <div class="admin-field">
                <label for="pdf">File PDF</label>

                <input
                    id="pdf"
                    name="pdf"
                    type="file"
                    accept=".pdf,application/pdf"
                    aria-describedby="pdf-help"
                    required
                >

                <small id="pdf-help">
                    Maksimal 20 MB. Jika formulir gagal, pilih ulang filenya.
                </small>
            </div>

            <label class="admin-check">
                <input
                    type="checkbox"
                    name="is_published"
                    value="1"
                    @checked(old('is_published'))
                >

                <span>
                    Terbitkan sekarang agar PDF dapat dibaca publik.
                </span>
            </label>

            <p class="admin-note">
                Jika tidak dicentang, warta disimpan sebagai draft.
                Tanggal warta adalah tanggal edisi, bukan jadwal terbit otomatis.
            </p>

            <button type="submit" class="admin-button">
                Simpan Warta
            </button>
        </form>
    </section>

    <section class="admin-panel" aria-labelledby="list-title">
        <h2 id="list-title" class="admin-section-title">
            Daftar Warta
        </h2>

        @forelse ($wartas as $warta)
            <article class="warta-row">
                <div class="warta-information">
                    <span class="admin-badge">
                        {{ $warta->is_published ? 'Terbit' : 'Draft' }}
                    </span>

                    <h3>{{ $warta->title }}</h3>

                    <p>
                        Edisi {{ $warta->edition_date->format('d/m/Y') }}
                    </p>

                    @if ($warta->summary)
                        <p>{{ $warta->summary }}</p>
                    @endif
                </div>

                <div class="warta-actions">
                    <a
                        href="{{ route('warta.pdf', $warta) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="admin-button"
                    >
                        Buka PDF ↗
                    </a>

                    <form
                        method="POST"
                        action="{{ route('admin.warta.status', $warta) }}"
                    >
                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="is_published"
                            value="{{ $warta->is_published ? '0' : '1' }}"
                        >

                        <button
                            type="submit"
                            class="admin-button admin-button-secondary"
                        >
                            {{ $warta->is_published
                                ? 'Jadikan Draft'
                                : 'Terbitkan' }}
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('admin.warta.destroy', $warta) }}"
                        onsubmit="return confirm('Hapus warta ini beserta file PDF-nya secara permanen? Tindakan ini tidak dapat dibatalkan.');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="admin-button admin-button-danger"
                            aria-label="Hapus warta: {{ $warta->title }}"
                        >
                            Hapus
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <p class="admin-intro">
                Belum ada warta. Unggah PDF pertama melalui formulir di atas.
            </p>
        @endforelse

        @if ($wartas->hasPages())
            <nav class="warta-pagination" aria-label="Halaman daftar warta">
                @if ($wartas->previousPageUrl())
                    <a
                        href="{{ $wartas->previousPageUrl() }}"
                        class="admin-site-link"
                    >
                        ← Sebelumnya
                    </a>
                @endif

                <span>
                    {{ $wartas->currentPage() }} / {{ $wartas->lastPage() }}
                </span>

                @if ($wartas->nextPageUrl())
                    <a
                        href="{{ $wartas->nextPageUrl() }}"
                        class="admin-site-link"
                    >
                        Berikutnya →
                    </a>
                @endif
            </nav>
        @endif
    </section>
@endsection