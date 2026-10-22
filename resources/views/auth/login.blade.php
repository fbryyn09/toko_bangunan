<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Toko Bangunan Bintang Emas Mandiri</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #eeeece;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
        }

        /* ==============================
           BAGIAN GAMBAR
        ============================== */

        .login-image {
            width: 50%;
            min-height: 100vh;
            position: relative;
            background-image: url('{{ asset('assets/images/toko.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(255, 220, 0, 0.18),
                rgba(255, 220, 0, 0.08),
                transparent
            );
            pointer-events: none;
        }

        /* ==============================
           BAGIAN LOGIN
        ============================== */

        .login-content {
            width: 50%;
            min-height: 100vh;
            background-color: #eeeece;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            box-sizing: border-box;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        /* ==============================
           LOGO
        ============================== */

        .login-logo {
            width: 130px;
            height: auto;
            object-fit: contain;
        }

        /* ==============================
           JUDUL
        ============================== */

        .login-title {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #555;
            font-size: 15px;
            margin-bottom: 30px;
        }

        /* ==============================
           FORM
        ============================== */

        .form-label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-control {
            height: 50px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 0 15px;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #d8d800;
            box-shadow: 0 0 0 0.15rem rgba(216, 216, 0, 0.15);
        }

        /* ==============================
           PASSWORD DAN ICON MATA
        ============================== */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #666;
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            color: #222;
        }

        .toggle-password:focus-visible {
            outline: 2px solid #d8d800;
            outline-offset: 3px;
            border-radius: 4px;
        }

        /* ==============================
           TOMBOL
        ============================== */

        .btn-login {
            height: 50px;
            border: none;
            border-radius: 8px;
            background-color: #f1f000;
            color: #222;
            font-weight: 700;
            font-size: 16px;
            transition: 0.2s;
        }

        .btn-login:hover {
            background-color: #dcdc00;
            color: #222;
        }

        .btn-register {
            height: 50px;
            border-radius: 8px;
            background-color: white;
            border: 1px solid #ddd;
            color: #333;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-register:hover {
            background-color: #f8f8f8;
            color: #222;
        }

        /* ==============================
           ERROR
        ============================== */

        .alert-danger {
            border: 0;
            border-radius: 8px;
            font-size: 14px;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 768px) {
            .login-wrapper {
                display: block;
            }

            .login-image {
                width: 100%;
                min-height: 260px;
                height: 260px;
            }

            .login-content {
                width: 100%;
                min-height: auto;
                padding: 40px 25px;
            }

            .login-box {
                max-width: 450px;
            }

            .login-title {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        {{-- =========================================
             FOTO TOKO
        ========================================== --}}

        <div class="login-image"></div>

        {{-- =========================================
             FORM LOGIN
        ========================================== --}}

        <div class="login-content">

            <div class="login-box">

                {{-- LOGO --}}

                <div class="text-center mb-3">
                    <img
                        src="{{ asset('assets/images/logo.png') }}"
                        alt="Logo Bintang Emas"
                        class="login-logo"
                    >
                </div>

                {{-- JUDUL --}}

                <div class="text-center">
                    <h1 class="login-title">
                        Selamat Datang
                    </h1>

                    <p class="login-subtitle">
                        Silakan login untuk melanjutkan
                    </p>
                </div>

                {{-- ERROR LOGIN --}}

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- FORM LOGIN --}}

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    {{-- USERNAME --}}

                    <div class="mb-3">
                        <label for="username" class="form-label">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-control"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>

                    {{-- PASSWORD --}}

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <div class="password-wrapper">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePassword"
                                aria-label="Tampilkan password"
                                title="Tampilkan password"
                            >
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- TOMBOL --}}

                    <div class="row g-3">

                        <div class="col-6">
                            <button type="submit" class="btn btn-login w-100">
                                Masuk
                            </button>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('register') }}" class="btn-register">
                                Buat Akun
                            </a>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- JAVASCRIPT ICON MATA PASSWORD --}}

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const isPasswordHidden = passwordInput.type === 'password';

            if (isPasswordHidden) {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');

                togglePassword.setAttribute('aria-label', 'Sembunyikan password');
                togglePassword.setAttribute('title', 'Sembunyikan password');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');

                togglePassword.setAttribute('aria-label', 'Tampilkan password');
                togglePassword.setAttribute('title', 'Tampilkan password');
            }
        });
    </script>

</body>
</html>