<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - Toko Bangunan Bintang Emas Mandiri</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #eeeece;
        }


        .register-wrapper {
            min-height: 100vh;
            display: flex;
        }


        /* ==============================
           BAGIAN GAMBAR
        ============================== */

        .register-image {
            width: 50%;
            min-height: 100vh;

            position: relative;

            background-image: url('{{ asset('assets/images/toko.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }


        /* Gradasi kuning tipis */

        .register-image::after {
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
           BAGIAN REGISTER
        ============================== */

        .register-content {
            width: 50%;
            min-height: 100vh;

            background-color: #eeeece;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;
        }


        .register-box {
            width: 100%;
            max-width: 420px;
        }


        /* ==============================
           LOGO
        ============================== */

        .register-logo {
            width: 130px;
            height: auto;
            object-fit: contain;
        }


        /* ==============================
           JUDUL
        ============================== */

        .register-title {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }


        .register-subtitle {
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


        /* Textarea */

        textarea.form-control {
            height: auto;
            padding: 12px 15px;
            resize: vertical;
        }


        .form-control:focus {
            border-color: #d8d800;

            box-shadow:
                0 0 0 0.15rem rgba(216, 216, 0, 0.15);
        }


        /* ==============================
           TOMBOL
        ============================== */

        .btn-register-submit {
            height: 50px;

            border: none;
            border-radius: 8px;

            background-color: #f1f000;
            color: #222;

            font-weight: 700;
            font-size: 16px;

            transition: 0.2s;
        }


        .btn-register-submit:hover {
            background-color: #dcdc00;
            color: #222;
        }


        /* ==============================
           LINK LOGIN
        ============================== */

        .login-link {
            color: #333;
            font-weight: 600;
            text-decoration: none;
        }


        .login-link:hover {
            color: #b8b800;
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

            .register-wrapper {
                display: block;
            }


            .register-image {
                width: 100%;
                min-height: 260px;
                height: 260px;
            }


            .register-content {
                width: 100%;
                min-height: auto;

                padding: 40px 25px;
            }


            .register-box {
                max-width: 450px;
            }


            .register-title {
                font-size: 26px;
            }

        }

    </style>

</head>


<body>

    <div class="register-wrapper">


        {{-- =========================================
             FOTO TOKO
        ========================================== --}}

        <div class="register-image"></div>


        {{-- =========================================
             FORM REGISTER
        ========================================== --}}

        <div class="register-content">

            <div class="register-box">


                {{-- LOGO --}}

                <div class="text-center mb-3">

                    <img
                        src="{{ asset('assets/images/logo.png') }}"
                        alt="Logo Bintang Emas"
                        class="register-logo"
                    >

                </div>


                {{-- JUDUL --}}

                <div class="text-center">

                    <h1 class="register-title">
                        Buat Akun
                    </h1>

                    <p class="register-subtitle">
                        Daftar untuk melanjutkan sebagai pelanggan
                    </p>

                </div>


                {{-- ERROR --}}

                @if ($errors->any())

                    <div class="alert alert-danger mb-4">

                        <ul class="mb-0 ps-3">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- FORM --}}

                <form
                    action="{{ route('register.process') }}"
                    method="POST"
                >

                    @csrf


                    {{-- NAMA LENGKAP --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama lengkap"
                            value="{{ old('nama') }}"
                            required
                        >

                    </div>


                    {{-- USERNAME --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}"
                            required
                        >

                    </div>


                    {{-- NOMOR HP --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Nomor HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            class="form-control"
                            placeholder="Contoh: 081234567890"
                            value="{{ old('no_hp') }}"
                            required
                        >

                    </div>


                    {{-- EMAIL --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Contoh: nama@email.com"
                            value="{{ old('email') }}"
                            required
                        >

                    </div>


                    {{-- ALAMAT --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan alamat lengkap"
                            required>{{ old('alamat') }}</textarea>

                    </div>


                    {{-- PASSWORD --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Minimal 6 karakter"
                            required
                        >

                    </div>


                    {{-- KONFIRMASI PASSWORD --}}

                    <div class="mb-4">

                        <label class="form-label">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password"
                            required
                        >

                    </div>


                    {{-- TOMBOL DAFTAR --}}

                    <button
                        type="submit"
                        class="btn btn-register-submit w-100"
                    >
                        Daftar
                    </button>

                </form>


                {{-- LOGIN --}}

                <div class="text-center mt-3">

                    <small class="text-muted">
                        Sudah punya akun?
                    </small>

                    <a
                        href="{{ route('login') }}"
                        class="login-link"
                    >
                        Login
                    </a>

                </div>


            </div>

        </div>

    </div>

</body>

</html>