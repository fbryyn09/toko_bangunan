@extends('layouts.pelanggan')

@section('title', 'Detail Produk')

@section('content')


    @php
        $hariIni = now()->toDateString();

        $promoAktif = $produk
            ->promosi()
            ->where('promosi.status', 'aktif')
            ->whereDate('promosi.tanggal_mulai', '<=', $hariIni)
            ->whereDate('promosi.tanggal_selesai', '>=', $hariIni)
            ->orderBy('promosi.tanggal_selesai', 'asc')
            ->first();

        $hargaAsli = (float) $produk->harga;
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


    <style>
        /* =====================================================
               DETAIL PAGE
            ===================================================== */

        .detail-page {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 10px 0 50px;
        }

        /* =====================================================
               BREADCRUMB
            ===================================================== */

        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #999;
        }

        .breadcrumb-custom a {
            color: #666;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .breadcrumb-custom a:hover {
            color: #d39b18;
        }

        .breadcrumb-custom strong {
            color: #333;
            font-weight: 600;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* =====================================================
               DETAIL PRODUK
            ===================================================== */

        .detail-product {
            display: grid;
            grid-template-columns: 470px 1fr;
            gap: 55px;
            align-items: start;
        }

        /* =====================================================
               GAMBAR PRODUK
            ===================================================== */

        .detail-image-section {
            width: 100%;
        }

        .main-product-image {
            width: 100%;
            height: 430px;
            background: #f8f8f8;
            border: 1px solid #eeeeee;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .main-product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 28px;
            transition: transform 0.3s ease;
        }

        .main-product-image:hover img {
            transform: scale(1.025);
        }

        .no-image {
            color: #aaa;
            font-size: 13px;
        }

        /* Thumbnail */

        .product-thumbnails {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .thumbnail {
            width: 62px;
            height: 62px;
            padding: 4px;
            border: 1.5px solid #e5e5e5;
            border-radius: 9px;
            background: #fff;
            overflow: hidden;
        }

        .thumbnail.active {
            border-color: #f6c344;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* =====================================================
               INFORMASI PRODUK
            ===================================================== */

        .detail-info {
            padding-top: 5px;
        }

        .detail-info h1 {
            margin: 0 0 10px;
            font-size: 30px;
            line-height: 1.3;
            font-weight: 750;
            color: #222;
        }

        .detail-price {
            margin-bottom: 15px;
            font-size: 25px;
            font-weight: 800;
            color: #222;
        }

        /* =====================================================
               STATUS
            ===================================================== */

        .detail-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            margin-bottom: 22px;
            border-radius: 20px;
            background: #eaf8ef;
            color: #178348;
            font-size: 12px;
            font-weight: 700;
        }

        .detail-status.not-available {
            background: #fdecec;
            color: #d63a3a;
        }

        /* =====================================================
               KATEGORI
            ===================================================== */

        .product-category-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 0;
            margin-bottom: 20px;
            border-top: 1px solid #eeeeee;
            border-bottom: 1px solid #eeeeee;
        }

        .product-category-label {
            color: #999;
            font-size: 13px;
            font-weight: 500;
        }

        .product-category-value {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            background: #f8f8f8;
            border: 1px solid #eeeeee;
            border-radius: 6px;
            color: #333;
            font-size: 12px;
            font-weight: 700;
        }

        /* =====================================================
               DESKRIPSI
            ===================================================== */

        .detail-description {
            margin-top: 20px;
        }

        .detail-description h3 {
            margin: 0 0 8px;
            font-size: 15px;
            font-weight: 700;
            color: #333;
        }

        .detail-description p {
            margin: 0;
            color: #777;
            font-size: 13px;
            line-height: 1.7;
        }

        /* =====================================================
               SATUAN & STOK
            ===================================================== */

        .product-info-small {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 22px;
        }

        .product-info-small div {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: 44px;
            padding: 9px 12px;
            background: #f8f8f8;
            border: 1px solid #eeeeee;
            border-radius: 8px;
            color: #888;
            font-size: 12px;
        }

        .product-info-small strong {
            margin-left: auto;
            color: #333;
            font-weight: 700;
        }

        /* =====================================================
               BUTTON PESAN
            ===================================================== */

        .detail-admin-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 46px;
            margin-top: 20px;
            padding: 11px 20px;
            border: 1px solid #f6c344;
            border-radius: 8px;
            background: #f6c344;
            color: #222;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .detail-admin-button:hover {
            background: #eab52f;
            border-color: #eab52f;
            color: #222;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.09);
        }

        .detail-admin-button:disabled {
            background: #e5e5e5;
            border-color: #e5e5e5;
            color: #999;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* =====================================================
               PRODUK LAINNYA
            ===================================================== */

        .other-products {
            margin-top: 55px;
            padding-top: 28px;
            border-top: 1px solid #eeeeee;
        }

        .other-products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .other-products-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 750;
            color: #222;
        }

        .other-product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .other-product-card {
            display: block;
            padding: 10px;
            background: #fff;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            color: #222;
            text-decoration: none;
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .other-product-card:hover {
            color: #222;
            border-color: #f6c344;
            transform: translateY(-3px);
            box-shadow: 0 7px 18px rgba(0, 0, 0, 0.07);
        }

        .other-image {
            width: 100%;
            height: 155px;
            background: #f8f8f8;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .other-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 10px;
            transition: transform 0.25s ease;
        }

        .other-product-card:hover .other-image img {
            transform: scale(1.04);
        }

        .other-product-card h3 {
            margin: 11px 2px 5px;
            font-size: 13px;
            line-height: 1.4;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .other-product-price {
            margin-left: 2px;
            font-size: 13px;
            font-weight: 700;
            color: #333;
        }

        .other-stock {
            display: inline-block;
            margin: 7px 2px 2px;
            padding: 4px 8px;
            background: #e9f8ee;
            border-radius: 10px;
            color: #168348;
            font-size: 10px;
            font-weight: 600;
        }

        /* =====================================================
               TABLET
            ===================================================== */

        @media (max-width: 1050px) {

            .detail-page {
                padding-left: 20px;
                padding-right: 20px;
            }

            .detail-product {
                grid-template-columns: 42% 58%;
                gap: 30px;
            }

            .main-product-image {
                height: 360px;
            }

            .detail-info h1 {
                font-size: 25px;
            }

            .detail-price {
                font-size: 22px;
            }

            .other-product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* =====================================================
               MOBILE
            ===================================================== */

        @media (max-width: 768px) {

            .detail-page {
                padding: 5px 15px 35px;
            }

            .breadcrumb-custom {
                margin-bottom: 18px;
                font-size: 12px;
            }

            .detail-product {
                display: block;
            }

            .detail-image-section {
                margin-bottom: 28px;
            }

            .main-product-image {
                height: 340px;
            }

            .detail-info {
                padding: 0;
            }

            .detail-info h1 {
                font-size: 23px;
            }

            .detail-price {
                font-size: 21px;
            }

            .product-category-info {
                margin-bottom: 18px;
            }

            .product-info-small {
                grid-template-columns: 1fr 1fr;
            }

            .other-products {
                margin-top: 40px;
            }

            .other-product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .other-image {
                height: 135px;
            }
        }

        /* =====================================================
               SMALL MOBILE
            ===================================================== */

        @media (max-width: 480px) {

            .main-product-image {
                height: 280px;
            }

            .detail-info h1 {
                font-size: 21px;
            }

            .detail-price {
                font-size: 20px;
            }

            .product-category-info {
                gap: 9px;
            }

            .product-category-label {
                font-size: 12px;
            }

            .product-category-value {
                font-size: 11px;
            }

            .product-info-small {
                gap: 8px;
            }

            .product-info-small div {
                padding: 8px;
                font-size: 11px;
            }

            .other-products-header h2 {
                font-size: 18px;
            }

            .other-image {
                height: 120px;
            }

            .other-product-card h3 {
                font-size: 12px;
            }

            .other-product-price {
                font-size: 12px;
            }
        }
    </style>


    <div class="detail-page">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-custom">

            <a href="{{ route('pelanggan.produk') }}">
                ← Produk
            </a>

            <span>›</span>

            <span>
                {{ $produk->kategori->nama_kategori ?? 'Kategori' }}
            </span>

            <span>›</span>

            <strong>
                {{ $produk->nama_produk }}
            </strong>

        </div>


        {{-- DETAIL PRODUK --}}
        <div class="detail-product">

            {{-- GAMBAR --}}
            <div class="detail-image-section">

                <div class="main-product-image">

                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                    @else
                        <span class="no-image">
                            Tidak ada gambar
                        </span>
                    @endif

                </div>


                @if ($produk->gambar)
                    <div class="product-thumbnails">

                        <div class="thumbnail active">

                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">

                        </div>

                    </div>
                @endif

            </div>


            {{-- INFORMASI --}}
            <div class="detail-info">

                <h1>
                    {{ $produk->nama_produk }}
                </h1>



                <div class="detail-price">
                    @if ($promoAktif && $hargaDiskon < $hargaAsli)
                        <div style="font-size: 15px; color: #888; text-decoration: line-through; font-weight: 500;">
                            Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                        </div>

                        <div style="color: #d92d20;">
                            Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                        </div>

                        <span
                            style="display: inline-block; margin-top: 5px; padding: 5px 9px; background: #fde8e7; color: #d92d20; border-radius: 6px; font-size: 12px; font-weight: 700;">
                            Hemat Rp {{ number_format($nilaiDiskon, 0, ',', '.') }}
                        </span>
                    @else
                        Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                    @endif
                </div>



                {{-- STATUS --}}
                @if ($produk->status == 'tersedia')
                    <div class="detail-status">
                        ● Tersedia
                    </div>
                @else
                    <div class="detail-status not-available">
                        ● Tidak Tersedia
                    </div>
                @endif


                {{-- KATEGORI --}}
                <div class="product-category-info">

                    <span class="product-category-label">
                        Kategori
                    </span>

                    <span class="product-category-value">
                        {{ $produk->kategori->nama_kategori ?? '-' }}
                    </span>

                </div>


                {{-- DESKRIPSI --}}
                <div class="detail-description">

                    <h3>
                        Deskripsi Produk
                    </h3>

                    <p>
                        {{ $produk->deskripsi ?: 'Belum ada deskripsi produk.' }}
                    </p>

                </div>


                {{-- SATUAN & STOK --}}
                <div class="product-info-small">

                    <div>

                        <span>📦</span>

                        <span>Satuan</span>

                        <strong>
                            {{ $produk->satuan ?? '-' }}
                        </strong>

                    </div>


                    <div>

                        <span>🛍️</span>

                        <span>Stok</span>

                        <strong>
                            {{ $produk->stok }}
                        </strong>

                    </div>

                </div>


                {{-- TOMBOL --}}
                @if ($produk->status == 'tersedia' && $produk->stok > 0)
                    <a href="{{ route('pelanggan.checkout', $produk->id_produk) }}" class="detail-admin-button">
                        🟢 &nbsp; Pesan / Hubungi Admin
                    </a>
                @else
                    <button type="button" class="detail-admin-button" disabled>
                        Produk Tidak Tersedia
                    </button>
                @endif

            </div>

        </div>


        {{-- PRODUK LAINNYA --}}
        <div class="other-products">

            <div class="other-products-header">

                <h2>
                    Produk Lainnya
                </h2>

            </div>


            @if ($produkLainnya->count() > 0)

                <div class="other-product-grid">

                    @foreach ($produkLainnya as $item)
                        <a href="{{ route('pelanggan.detail-produk', $item->id_produk) }}" class="other-product-card">

                            <div class="other-image">

                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
                                @else
                                    <span class="text-muted small">
                                        Tidak ada gambar
                                    </span>
                                @endif

                            </div>


                            <h3>
                                {{ $item->nama_produk }}
                            </h3>


                            <div class="other-product-price">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>


                            <span class="other-stock">
                                ● Tersedia
                            </span>

                        </a>
                    @endforeach

                </div>
            @else
                <p class="text-muted mb-0">
                    Belum ada produk lainnya dalam kategori ini.
                </p>

            @endif

        </div>

    </div>

@endsection
