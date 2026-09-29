<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') — GKI Sunda Kelapa</title>

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
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="admin-site-link"
                >
                    Dashboard
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
        @if (session('status'))
            <div class="admin-message success" role="status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="admin-message error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>