<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Bintang Emas Mandiri</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- CSS Pelanggan --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @yield('styles')

</head>


<body>

    {{-- =====================================================
         SIDEBAR PELANGGAN
    ====================================================== --}}

    <aside class="sidebar">

        {{-- LOGO --}}

        <div class="sidebar-logo-wrapper">

            <img src="{{ asset('assets/images/logo.png') }}" alt="Bintang Emas Mandiri" class="sidebar-logo">

        </div>


        {{-- MENU --}}

        <nav class="sidebar-menu">

            {{-- BERANDA --}}

            <a href="{{ route('pelanggan.beranda') }}"
                class="{{ request()->routeIs('pelanggan.beranda') ? 'active' : '' }}">

                <span class="menu-icon">⌂</span>

                <span>Beranda</span>

            </a>


            {{-- PRODUK --}}

            <a href="{{ route('pelanggan.produk') }}"
                class="{{ request()->routeIs('pelanggan.produk') || request()->routeIs('pelanggan.detail-produk') ? 'active' : '' }}">

                <span class="menu-icon">🛒</span>

                <span>Produk</span>

            </a>


            {{-- KATEGORI --}}

            <a href="{{ route('pelanggan.kategori') }}"
                class="{{ request()->routeIs('pelanggan.kategori') || request()->routeIs('pelanggan.kategori-produk') ? 'active' : '' }}">

                <span class="menu-icon">▤</span>

                <span>Kategori</span>

            </a>


            {{-- PROMO --}}

            <a href="{{ route('pelanggan.promo') }}"
                class="{{ request()->routeIs('pelanggan.promo') ? 'active' : '' }}">

                <span class="menu-icon">%</span>

                <span>Promo</span>

            </a>


            {{-- RIWAYAT PESANAN --}}

            <a href="{{ route('pelanggan.riwayat-pesanan') }}"
                class="{{ request()->routeIs('pelanggan.riwayat-pesanan') ? 'active' : '' }}">

                <span class="menu-icon">🧾</span>

                <span>Riwayat Pesanan</span>

            </a>


            {{-- TENTANG TOKO --}}

            <a href="{{ route('pelanggan.tentang') }}"
                class="{{ request()->routeIs('pelanggan.tentang') ? 'active' : '' }}">

                <span class="menu-icon">⊞</span>

                <span>Tentang Toko</span>

            </a>


            {{-- PROFIL --}}

            <a href="{{ route('pelanggan.profil') }}"
                class="{{ request()->routeIs('pelanggan.profil') ? 'active' : '' }}">

                <span class="menu-icon">◉</span>

                <span>Profil</span>

            </a>

        </nav>

    </aside>


    {{-- =====================================================
         KONTEN UTAMA
    ====================================================== --}}

    <main class="content">

        @yield('content')

    </main>


    {{-- Bootstrap JS --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>

</html>
