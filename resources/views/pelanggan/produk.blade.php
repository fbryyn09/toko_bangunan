@extends('layouts.pelanggan')

@section('title', 'Produk')

@section('styles')

    <style>
        /* =========================================
               HALAMAN PRODUK
            ========================================= */
        .product-page {
            width: 100%;
            padding: 5px 0 40px;
        }

        /* =========================================
               TOPBAR
            ========================================= */
        .product-topbar {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 30px;
            padding: 5px 0;
        }

        /* =========================================
               SEARCH PRODUK
            ========================================= */
        .product-search {
            width: 100%;
            max-width: 760px;
        }

        .product-search-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 48px;
            padding: 5px;
            background: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
            transition: 0.25s ease;
        }

        .product-search-wrapper:focus-within {
            border-color: #f6c344;
            box-shadow: 0 4px 16px rgba(246, 195, 68, 0.18);
        }

        .product-search-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            min-width: 42px;
            font-size: 17px;
            color: #777;
        }

        .product-search-input {
            flex: 1;
            height: 38px;
            padding: 0 10px;
            border: none;
            outline: none;
            background: transparent;
            color: #333;
            font-size: 13px;
        }

        .product-search-input::placeholder {
            color: #999;
        }

        .product-category-filter {
            height: 38px;
            min-width: 150px;
            padding: 0 30px 0 12px;
            border: none;
            border-left: 1px solid #e5e5e5;
            border-radius: 0;
            background: #fff;
            color: #444;
            font-size: 12px;
            outline: none;
            cursor: pointer;
        }

        .product-category-filter:focus {
            border-color: transparent;
        }

        .product-search-button {
            height: 38px;
            padding: 0 18px;
            border: none;
            border-radius: 9px;
            background: #f6c344;
            color: #222;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .product-search-button:hover {
            background: #eab52f;
            transform: translateY(-1px);
            box-shadow: 0 4px 9px rgba(0, 0, 0, 0.08);
        }

        /* =========================================
               USER PELANGGAN
            ========================================= */
        .customer-info {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 9px;
            background: #fff;
            border: 1px solid #aaa;
            border-radius: 10px;
            padding: 5px 10px;
            min-width: 130px;
        }

        .customer-avatar {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #eeeecc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .customer-name {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.2;
        }

        .customer-role {
            display: block;
            font-size: 10px;
            color: #777;
            line-height: 1.2;
        }

        /* =========================================
               JUDUL PRODUK
            ========================================= */
        .product-heading {
            margin-bottom: 25px;
        }

        .product-heading h1 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .product-heading p {
            margin: 0;
            color: #666;
            font-size: 15px;
        }

        /* =========================================
               GRID PRODUK
            ========================================= */
        .product-page-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px 20px;
        }

        /* =========================================
               CARD PRODUK
            ========================================= */
        .product-item {
            display: block;
            background: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            color: #222;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;
            padding-bottom: 0;
        }

        .product-item:hover {
            transform: translateY(-4px);
            border-color: #f6c344;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        /* =========================================
               GAMBAR PRODUK
            ========================================= */
        .product-image {
            width: 100%;
            height: 190px;
            background: #f7f7f7;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 12px;
            transition: transform 0.3s ease;
        }

        .product-item:hover .product-image img {
            transform: scale(1.04);
        }

        /* =========================================
               INFORMASI PRODUK
            ========================================= */
        .product-info {
            padding: 15px 16px 16px;
        }

        .product-name {
            font-size: 15px;
            font-weight: 700;
            color: #222;
            margin-bottom: 6px;
            min-height: 38px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-category {
            display: inline-block;
            padding: 4px 9px;
            margin-bottom: 12px;
            background: #fff8df;
            color: #9a7410;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .product-price {
            font-size: 17px;
            font-weight: 800;
            color: #222;
            margin-bottom: 15px;
        }

        /* =========================================
               BAGIAN BAWAH CARD
            ========================================= */
        .product-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        /* =========================================
               STATUS PRODUK
            ========================================= */
        .product-status {
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-tersedia {
            color: #2e8b57;
        }

        .status-habis {
            color: #d9534f;
        }

        /* =========================================
               TOMBOL LIHAT PRODUK
            ========================================= */
        .detail-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 108px;
            height: 36px;
            padding: 0 13px;
            background: #f6c344;
            color: #222;
            border: 1px solid #f6c344;
            border-radius: 8px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            transition:
                background 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .detail-button:hover {
            background: #eab52f;
            border-color: #eab52f;
            color: #222;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        /* =========================================
               JIKA PRODUK KOSONG
            ========================================= */
        .empty-product {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px 20px;
            background: white;
            border-radius: 10px;
            border: 1px solid #ddd;
            color: #777;
        }

        /* =========================================
               RESPONSIVE TABLET
            ========================================= */
        @media (max-width: 1100px) {
            .product-page-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* =========================================
               RESPONSIVE HP
            ========================================= */
        @media (max-width: 800px) {
            .product-page-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-topbar {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .product-search {
                width: 100%;
                max-width: none;
            }

            .customer-info {
                width: fit-content;
            }
        }

        /* =========================================
               RESPONSIVE HP KECIL
            ========================================= */
        @media (max-width: 700px) {
            .product-search {
                max-width: 100%;
            }

            .product-search-wrapper {
                flex-wrap: wrap;
                padding: 6px;
                gap: 5px;
            }

            .product-search-input {
                min-width: 0;
            }

            .product-category-filter {
                width: 100%;
                height: 40px;
                border-left: none;
                border-top: 1px solid #e5e5e5;
                border-radius: 8px;
            }

            .product-search-button {
                width: 100%;
            }
        }

        @media (max-width: 500px) {
            .product-page-grid {
                grid-template-columns: 1fr;
            }

            .product-heading h1 {
                font-size: 25px;
            }

            .product-image {
                height: 200px;
            }

            .product-info {
                padding: 15px;
            }

            .product-bottom {
                gap: 8px;
            }

            .detail-button {
                min-width: 105px;
                height: 36px;
                padding: 0 11px;
                font-size: 11px;
            }
        }
    </style>

@endsection

@section('content')

    <div class="product-page">

        {{-- =====================================
         TOPBAR
    ====================================== --}}
        <div class="product-topbar">

            {{-- SEARCH --}}
            <form action="{{ route('pelanggan.produk') }}" method="GET" class="product-search">

                <div class="product-search-wrapper">

                    <span class="product-search-icon">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text" name="search" class="product-search-input"
                        placeholder="Cari produk, kategori, atau nama barang" value="{{ request('search') }}">

                    <select name="kategori" class="product-category-filter">

                        <option value="">Semua Kategori</option>

                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}"
                                {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach

                    </select>

                    <button type="submit" class="product-search-button">
                        Cari
                    </button>

                </div>

            </form>

            {{-- PROFIL PELANGGAN --}}
            @auth

                <div class="customer-info">

                    <div class="customer-avatar">
                        👤
                    </div>

                    <div>

                        <div class="customer-name">
                            {{ Auth::user()->nama }}
                        </div>

                        <span class="customer-role">
                            Pelanggan
                        </span>

                    </div>

                </div>

            @endauth

        </div>


        {{-- =====================================
         JUDUL
    ====================================== --}}
        <div class="product-heading">

            <h1>
                Semua Produk
            </h1>

            <p>
                Temukan berbagai produk bangunan berkualitas di sini.
            </p>

        </div>


        {{-- =====================================
         DAFTAR PRODUK
    ====================================== --}}
        <div class="product-page-grid">

            @forelse ($produk as $item)
                {{-- CARD PRODUK --}}
                <div class="product-item">

                    {{-- GAMBAR --}}
                    <div class="product-image">

                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
                        @else
                            <span class="text-muted">
                                Tidak ada gambar
                            </span>
                        @endif

                    </div>


                    {{-- INFORMASI --}}
                    <div class="product-info">

                        {{-- NAMA PRODUK --}}
                        <div class="product-name">
                            {{ $item->nama_produk }}
                        </div>

                        {{-- KATEGORI --}}
                        <div class="product-category">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </div>

                        {{-- HARGA --}}

                        {{-- HARGA PRODUK DAN DISKON --}}
                        @php
                            $hariIni = now()->toDateString();

                            $promoAktif = $item
                                ->promosi()
                                ->where('promosi.status', 'aktif')
                                ->whereDate('promosi.tanggal_mulai', '<=', $hariIni)
                                ->whereDate('promosi.tanggal_selesai', '>=', $hariIni)
                                ->orderBy('promosi.tanggal_selesai', 'asc')
                                ->first();

                            $hargaAsli = (float) $item->harga;
                            $hargaDiskon = $hargaAsli;
                            $nilaiDiskon = 0;

                            if ($promoAktif) {
                                if (in_array($promoAktif->jenis_diskon, ['persen', 'persentase'])) {
                                    $nilaiDiskon = $hargaAsli * ((float) $promoAktif->nilai_diskon / 100);
                                } else {
                                    $nilaiDiskon = (float) $promoAktif->nilai_diskon;
                                }

                                $nilaiDiskon = min($hargaAsli, max(0, $nilaiDiskon));
                                $hargaDiskon = $hargaAsli - $nilaiDiskon;
                            }
                        @endphp

                        <div class="product-price">
                            @if ($promoAktif && $hargaDiskon < $hargaAsli)
                                <div style="font-size: 12px; color: #888; text-decoration: line-through; font-weight: 500;">
                                    Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                                </div>

                                <div style="color: #d92d20;">
                                    Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                </div>

                                <span
                                    style="display: inline-block; background: #fde8e7; color: #d92d20; padding: 3px 7px; border-radius: 5px; font-size: 10px; font-weight: 700;">
                                    Hemat Rp {{ number_format($nilaiDiskon, 0, ',', '.') }}
                                </span>
                            @else
                                Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                            @endif
                        </div>


                        {{-- STATUS + TOMBOL --}}
                        <div class="product-bottom">

                            {{-- STATUS PRODUK --}}
                            @if ($item->status === 'tersedia')
                                <span class="product-status status-tersedia">
                                    ● Tersedia
                                </span>
                            @else
                                <span class="product-status status-habis">
                                    ● Tidak Tersedia
                                </span>
                            @endif


                            {{-- DETAIL PRODUK --}}
                            <a href="{{ route('pelanggan.detail-produk', $item->id_produk) }}" class="detail-button">
                                🛒 Lihat Produk
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                {{-- JIKA PRODUK BELUM ADA --}}
                <div class="empty-product">

                    <h5>
                        Belum ada produk
                    </h5>

                    <p class="mb-0">
                        Produk yang ditambahkan oleh admin akan muncul di halaman ini.
                    </p>

                </div>
            @endforelse

        </div>

    </div>

@endsection
