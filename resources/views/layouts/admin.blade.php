<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Bintang Jaya Emas</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8f8f6;
            color: #222;
            display: flex;
            min-height: 100vh;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 245px;
            min-height: 100vh;
            flex-shrink: 0;

            background: #ffffff;
            border-right: 1px solid #eeeeee;

            padding: 25px 16px;

            display: flex;
            flex-direction: column;
        }


        /* =====================================================
   LOGO / BRAND
===================================================== */

        .sidebar-brand {
            padding: 5px 8px 22px;
            border-bottom: 1px solid #eeeeee;
            margin-bottom: 22px;
            text-align: center;
        }

        .sidebar-logo {
            width: 130px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 11px;

            min-height: 44px;
            padding: 10px 13px;

            border-radius: 8px;

            color: #666;
            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }

        .sidebar-menu a:hover {
            background: #fff9e9;
            color: #333;
        }

        .sidebar-menu a.active {
            background: #fff5d8;
            color: #a87808;
        }


        /* ICON MENU */

        .menu-icon {
            width: 22px;
            height: 22px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 6px;

            background: #f7f7f7;

            color: #777;

            font-size: 12px;
            font-weight: 700;

            flex-shrink: 0;
        }

        .sidebar-menu a.active .menu-icon {
            background: #f6c344;
            color: #222;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .sidebar-logout {
            margin-top: auto;
            padding-top: 20px;
        }

        .sidebar-logout form {
            margin: 0;
        }

        .logout-button {
            width: 100%;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            background: #fff;
            border: 1px solid #e4e4e4;
            border-radius: 8px;

            color: #777;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease;
        }

        .logout-button:hover {
            background: #fff8f0;
            border-color: #e6c99c;
            color: #9a6b15;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            flex: 1;
            min-width: 0;

            padding: 30px 35px 50px;
        }


        /* =====================================================
           GENERAL CARD
        ===================================================== */

        .card {
            background: #ffffff;
            border: 1px solid #eeeeee !important;
            border-radius: 12px !important;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, 0.04) !important;
        }


        /* =====================================================
           BOOTSTRAP BUTTON OVERRIDE
        ===================================================== */

        .btn-dark {
            background: #f6c344 !important;
            border-color: #f6c344 !important;
            color: #222 !important;
            font-weight: 700;
        }

        .btn-dark:hover {
            background: #eab52f !important;
            border-color: #eab52f !important;
            color: #222 !important;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast-text {
            flex: 1;
        }

        .toast-icon {
            flex-shrink: 0;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .content {
                padding: 25px;
            }

        }


        @media (max-width: 700px) {

            body {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;

                padding: 15px;

                border-right: none;
                border-bottom: 1px solid #eeeeee;
            }

            .sidebar-brand {
                padding-bottom: 18px;
                margin-bottom: 15px;
            }

            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 5px;
            }

            .sidebar-menu a {
                min-height: 40px;
            }

            .sidebar-logout {
                margin-top: 15px;
                padding-top: 15px;
            }

            .content {
                padding: 20px 15px 40px;
            }

        }


        @media (max-width: 450px) {

            .sidebar-menu {
                grid-template-columns: 1fr;
            }

            .sidebar-brand-name {
                font-size: 18px;
            }

        }
    </style>

</head>


<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="sidebar">

        {{-- BRAND --}}
        <div class="sidebar-brand">

            <img src="{{ asset('assets/images/logo.png') }}" alt="Bintang Emas Mandiri" class="sidebar-logo">


        </div>

        {{-- MENU --}}
        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">
                    ⌂
                </span>

                <span>
                    Dashboard
                </span>
            </a>


            <a href="{{ route('admin.kategori.index') }}"
                class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    ▤
                </span>

                <span>
                    Kategori
                </span>
            </a>


            <a href="{{ route('admin.produk.index') }}"
                class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    ◈
                </span>

                <span>
                    Produk
                </span>
            </a>


            <a href="{{ route('admin.promosi.index') }}"
                class="{{ request()->routeIs('admin.promosi.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    %
                </span>

                <span>
                    Promosi
                </span>
            </a>


            <a href="{{ route('admin.pesanan.index') }}"
                class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    🧾
                </span>

                <span>
                    Pesanan
                </span>
            </a>

        </nav>


        {{-- LOGOUT --}}
        <div class="sidebar-logout">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit" class="logout-button">
                    <span>↪</span>

                    <span>
                        Logout
                    </span>
                </button>

            </form>

        </div>

    </aside>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <main class="content">

        @yield('content')

    </main>


    {{-- =====================================================
         GLOBAL BOOTSTRAP TOAST
    ====================================================== --}}

    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-4" style="z-index: 9999;">

            <div id="successToast" class="toast border-0 shadow-lg" role="alert" aria-live="assertive"
                aria-atomic="true"
                style="
                    width: 360px;
                    border-radius: 12px;
                    overflow: hidden;
                ">

                {{-- AKSEN ATAS --}}
                <div
                    style="
                        height: 4px;
                        background: #f6c344;
                    ">
                </div>


                <div class="toast-body bg-white p-3">

                    <div class="d-flex align-items-start">


                        {{-- ICON --}}
                        <div class="d-flex align-items-center justify-content-center toast-icon"
                            style="
                                width: 38px;
                                height: 38px;
                                border-radius: 10px;
                                background: #fff5d8;
                                color: #a87808;
                                font-size: 19px;
                                font-weight: bold;
                            ">
                            ✓
                        </div>


                        {{-- TEXT --}}
                        <div class="ms-3 toast-text">

                            <div class="fw-semibold"
                                style="
                                    color: #212529;
                                    font-size: 14px;
                                    margin-bottom: 3px;
                                ">
                                Berhasil
                            </div>


                            <div
                                style="
                                    color: #6c757d;
                                    font-size: 13px;
                                    line-height: 1.5;
                                ">
                                {{ session('success') }}
                            </div>

                        </div>


                        {{-- CLOSE --}}
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"
                            style="font-size: 9px;">
                        </button>

                    </div>

                </div>

            </div>

        </div>
    @endif


    {{-- =====================================================
         BOOTSTRAP JAVASCRIPT
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    {{-- =====================================================
         TOAST JAVASCRIPT
    ====================================================== --}}

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const successToast =
                    document.getElementById('successToast');

                if (successToast) {

                    const toast =
                        new bootstrap.Toast(successToast, {
                            delay: 3000
                        });

                    toast.show();

                }

            });
        </script>
    @endif


</body>

</html>
