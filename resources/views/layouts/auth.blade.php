<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Akun Jemaat') — GKI Sunda Kelapa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <nav class="auth-navbar" aria-label="Navigasi akun">
        <a href="{{ route('home') }}" class="auth-brand">
            <img src="{{ asset('images/logo_gki.png') }}" alt="">
            <span>GKI Sunda Kelapa</span>
        </a>

        <a href="{{ route('home') }}" class="auth-back">
            Beranda &rarr;
        </a>
    </nav>

    <main class="auth-main">
        <section class="auth-card" aria-labelledby="page-title">
            @if (session('status'))
                <div class="auth-alert success" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="auth-alert error" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </section>
    </main>
    <script>
    document.querySelectorAll('input[type="password"]').forEach((input) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'auth-password-wrap';

        input.before(wrapper);
        wrapper.append(input);

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'auth-password-toggle';
        button.setAttribute('aria-controls', input.id);

        const fieldName = input.name === 'password_confirmation'
            ? 'konfirmasi password'
            : 'password';

        const eyeIcon = `
            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true"
                 focusable="false">
                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
        `;

        const eyeOffIcon = `
            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true"
                 focusable="false">
                <path d="m3 3 18 18"/>
                <path d="M10.6 5.1A11 11 0 0 1 12 5c6.5 0 10 7 10 7a18 18 0 0 1-3 3.8"/>
                <path d="M6.5 6.5A20 20 0 0 0 2 12s3.5 7 10 7a11 11 0 0 0 5.5-1.5"/>
                <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/>
            </svg>
        `;

        function updateButton() {
            const isVisible = input.type === 'text';
            const label = isVisible
                ? `Sembunyikan ${fieldName}`
                : `Tampilkan ${fieldName}`;

            button.innerHTML = isVisible ? eyeOffIcon : eyeIcon;
            button.setAttribute('aria-label', label);
            button.title = label;
        }

        button.addEventListener('click', () => {
            input.type = input.type === 'password' ? 'text' : 'password';
            updateButton();
        });

        // Sembunyikan kembali saat formulir dikirim.
        input.form?.addEventListener('submit', () => {
            input.type = 'password';
            updateButton();
        });

        updateButton();
        wrapper.append(button);
    });
    </script>
</body>
</html>