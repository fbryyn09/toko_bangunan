@extends('layouts.pelanggan')

@section('title', 'Beranda')

@section('styles')

    <style>
        /* =========================================
           BERANDA PELANGGAN
        ========================================= */
        .home-page {
            width: 100%;
            padding: 5px 0 40px;
        }

        /* =========================================
           TOPBAR
        ========================================= */
        .home-topbar {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 18px;
        }

        .home-search {
            flex: 1;
            max-width: 650px;
        }

        .home-search-wrapper {
            position: relative;
            width: 100%;
        }

        .home-search-input {
            width: 100%;
            height: 40px;
            box-sizing: border-box;
            padding: 0 18px 0 42px;
            border: 1px solid #999;
            border-radius: 10px;
            background: #fff;
            font-size: 14px;
            outline: none;
        }

        .home-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
        }

        /* =========================================
           USER
        ========================================= */
        .home-user {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid #aaa;
            border-radius: 8px;
            padding: 4px 9px;
            flex-shrink: 0;
        }

        .home-user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #eeeecc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .home-user-name {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.1;
        }

        .home-user-role {
            display: block;
            font-size: 9px;
            color: #777;
            line-height: 1.1;
        }

        /* =========================================
           HERO
        ========================================= */
        .home-hero {
            position: relative;
            width: 100%;
            height: 230px;
            overflow: hidden;
            border-radius: 14px;
            margin-bottom: 14px;
            background: #ddd;
        }

        .home-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .home-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, 0.65),
                    rgba(0, 0, 0, 0.25),
                    rgba(0, 0, 0, 0));
        }

        .home-hero-content {
            position: absolute;
            left: 18px;
            top: 25px;
            max-width: 430px;
            color: white;
        }

        .home-hero-content h1 {
            font-size: 25px;
            line-height: 1.2;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .home-hero-content p {
            font-size: 13px;
            line-height: 1.4;
            margin: 0;
            color: #fff;
        }

        /* =========================================
           SECTION HEADER
        ========================================= */
        .home-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 8px 0 10px;
        }

        .home-section-header h2 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .home-section-header a {
            font-size: 12px;
            color: #999;
            text-decoration: none;
        }

        .home-section-header a:hover {
            color: #555;
        }

        /* =========================================
           KATEGORI
        ========================================= */
        .home-category-list {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .home-category-card {
            height: 88px;
            background: #fff;
            border: 1px solid #bbb;
            border-radius: 6px;
            text-decoration: none;
            color: #222;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: 0.2s;
        }

        .home-category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .home-category-image {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
            background: #f5f5f5;
        }

        .home-category-name {
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }

        /* =========================================
           KATEGORI KOSONG
        ========================================= */
        .home-category-empty {
            grid-column: 1 / -1;
            text-align: center;
            color: #777;
            padding: 20px;
        }

        /* =========================================
           PRODUK
        ========================================= */
        .home-product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .home-product-card {
            background: #fff;
            border: 1px solid #bbb;
            border-radius: 6px;
            overflow: hidden;
            text-decoration: none;
            color: #222;
            transition: 0.2s;
        }

        .home-product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .home-product-image {
            width: 100%;
            height: 145px;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .home-product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .home-product-info {
            padding: 8px 10px 10px;
        }

        .home-product-name {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 3px;
            min-height: 32px;
        }

        .home-product-price {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        /* =========================================
           STATUS
        ========================================= */
        .home-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .home-status-available {
            background: #dff5e5;
            color: #159447;
        }

        .home-status-unavailable {
            background: #ffe1e1;
            color: #dc3545;
        }

        /* =========================================
           BUTTON LIHAT PRODUK
        ========================================= */
        .home-admin-button {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
            border-radius: 5px;
            background: #eeeecc;
            color: #333;
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */
        @media (max-width: 1000px) {

            .home-category-list {
                grid-template-columns: repeat(3, 1fr);
            }

            .home-product-grid {
                grid-template-columns: repeat(3, 1fr);
            }

        }

        @media (max-width: 700px) {

            .home-topbar {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .home-search {
                max-width: none;
            }

            .home-user {
                width: fit-content;
            }

            .home-hero {
                height: 210px;
            }

            .home-product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 450px) {

            .home-category-list {
                grid-template-columns: repeat(2, 1fr);
            }

            .home-product-grid {
                grid-template-columns: 1fr;
            }

            .home-hero-content h1 {
                font-size: 21px;
            }

        }
    </style>

@endsection


@section('content')

    <div class="home-page">

        {{-- =====================================
         TOPBAR
    ====================================== --}}
        <div class="home-topbar">

            <div class="home-search">

                <div class="home-search-wrapper">

                    <span class="home-search-icon">
                        🔍
                    </span>

                    <input type="text" class="home-search-input" placeholder="Cari produk, kategori, atau nama barang">

                </div>

            </div>


            @auth

                <div class="home-user">

                    <div class="home-user-avatar">
                        👤
                    </div>

                    <div>

                        <a href="{{ route('pelanggan.profil') }}"
                            class="{{ request()->routeIs('pelanggan.profil') ? 'active' : '' }}">

                            <div class="home-user-name">
                                {{ Auth::user()->nama }}
                            </div>

                            <span class="home-user-role">
                                Pelanggan
                            </span>
                        </a>


                    </div>

                </div>

            @endauth

        </div>


        {{-- =====================================
         HERO
    ====================================== --}}
        <section class="home-hero">

            <img src="{{ asset('assets/images/toko.jpg') }}" alt="Toko Bintang Emas Mandiri">

            <div class="home-hero-overlay"></div>

            <div class="home-hero-content">

                <h1>
                    SELAMAT DATANG DI<br>
                    Toko Bangunan<br>
                    Bintang Emas Mandiri
                </h1>

                <p>
                    Temukan berbagai kebutuhan material bangunan
                    dengan informasi produk, harga, dan ketersediaan barang.
                </p>

            </div>

        </section>


        {{-- =====================================
         KATEGORI
    ====================================== --}}
        <div class="home-section-header">

            <h2>
                Kategori Pilihan
            </h2>

            <a href="{{ route('pelanggan.kategori') }}">
                Lihat Semua
            </a>

        </div>


        <div class="home-category-list">

            @forelse ($kategori as $item)
                <a href="{{ route('pelanggan.produk') }}?kategori={{ $item->id_kategori }}" class="home-category-card">

                    {{-- GAMBAR KATEGORI --}}
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_kategori }}"
                            class="home-category-image">
                    @else
                        <div class="home-category-image d-flex align-items-center justify-content-center">
                            📦
                        </div>
                    @endif


                    {{-- NAMA KATEGORI --}}
                    <span class="home-category-name">
                        {{ $item->nama_kategori }}
                    </span>

                </a>

            @empty

                <div class="home-category-empty">
                    Belum ada kategori.
                </div>
            @endforelse

        </div>


        {{-- =====================================
         PRODUK TERSEDIA
    ====================================== --}}
        <div class="home-section-header">

            <h2>
                Produk Tersedia
            </h2>

            <a href="{{ route('pelanggan.produk') }}">
                Lihat Semua
            </a>

        </div>


        <div class="home-product-grid">

            @forelse ($produk as $item)
                <div class="home-product-card">

                    {{-- GAMBAR PRODUK --}}
                    <div class="home-product-image">

                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
                        @else
                            <span class="text-muted">
                                Tidak ada gambar
                            </span>
                        @endif

                    </div>


                    {{-- INFORMASI PRODUK --}}
                    <div class="home-product-info">

                        <div class="home-product-name">
                            {{ $item->nama_produk }}
                        </div>


                        <div class="home-product-price">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </div>


                        @if ($item->status === 'tersedia')
                            <span class="home-status home-status-available">
                                ● Tersedia
                            </span>
                        @else
                            <span class="home-status home-status-unavailable">
                                ● Tidak Tersedia
                            </span>
                        @endif


                        <a href="{{ route('pelanggan.detail-produk', $item->id_produk) }}" class="home-admin-button">
                            Lihat Produk
                        </a>

                    </div>

                </div>

            @empty

                <div class="home-category-empty">
                    Belum ada produk tersedia.
                </div>
            @endforelse

        </div>

    </div>

@endsection
