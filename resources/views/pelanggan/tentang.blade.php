@extends('layouts.pelanggan')

@section('title', 'Tentang Toko')

@section('content')

<style>
    .about-page {
        color: #262626;
        padding-bottom: 30px;
    }

    .about-heading {
        margin-bottom: 28px;
    }

    .about-heading .eyebrow {
        display: inline-block;
        color: #8a7200;
        background: #fff7cc;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .about-heading h1 {
        font-size: clamp(25px, 3vw, 34px);
        letter-spacing: -0.8px;
    }

    .about-heading p {
        font-size: 14px;
        line-height: 1.8;
        max-width: 600px;
    }

    .about-hero {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(120deg, #fffbea 0%, #fff 65%, #fff5c2 100%);
        border: 1px solid #f0ead5;
        margin-bottom: 28px;
    }

    .about-hero-content {
        padding: 38px;
        position: relative;
        z-index: 1;
    }

    .about-hero h2 {
        font-size: clamp(25px, 3vw, 36px);
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -1px;
        margin-bottom: 17px;
    }

    .about-hero h2 span {
        color: #a78a00;
    }

    .about-hero p {
        color: #666;
        font-size: 14px;
        line-height: 1.9;
        margin-bottom: 22px;
    }

    .about-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 7px;
        background: #f6eebc;
        color: #625300;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .about-image-wrap {
        height: 100%;
        min-height: 350px;
        position: relative;
        overflow: hidden;
    }

    .about-image-wrap img {
        width: 100%;
        height: 100%;
        min-height: 350px;
        object-fit: cover;
        display: block;
        transition: transform .5s ease;
    }

    .about-image-wrap:hover img {
        transform: scale(1.04);
    }

    .about-image-caption {
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: 18px;
        padding: 15px 18px;
        border-radius: 12px;
        background: rgba(25, 25, 25, .82);
        color: white;
        backdrop-filter: blur(8px);
    }

    .about-image-caption strong {
        display: block;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .about-image-caption span {
        font-size: 11px;
        color: #e0e0e0;
    }

    .about-section-title {
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -.4px;
        margin-bottom: 7px;
    }

    .about-section-subtitle {
        font-size: 13px;
        color: #777;
        margin-bottom: 20px;
    }

    .about-info-card {
        height: 100%;
        background: #fff;
        border: 1px solid #eee9dc;
        border-radius: 14px;
        padding: 23px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .about-info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
    }

    .about-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        border-radius: 12px;
        background: #fff5c7;
        color: #725e00;
        font-size: 21px;
        margin-bottom: 16px;
    }

    .about-info-card h3 {
        font-size: 15px;
        font-weight: 750;
        margin-bottom: 9px;
    }

    .about-info-card p {
        color: #777;
        font-size: 12px;
        line-height: 1.8;
        margin-bottom: 0;
        overflow-wrap: anywhere;
    }

    .about-feature {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 18px 0;
        border-bottom: 1px solid #eee9dc;
    }

    .about-feature:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .about-feature-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        flex-shrink: 0;
        border-radius: 10px;
        background: #f7f3df;
        color: #8a7200;
        font-size: 16px;
    }

    .about-feature h3 {
        font-size: 13px;
        font-weight: 750;
        margin-bottom: 5px;
    }

    .about-feature p {
        color: #777;
        font-size: 12px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .about-cta {
        margin-top: 28px;
        padding: 25px 28px;
        border-radius: 15px;
        background: #252525;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .about-cta h3 {
        font-size: 17px;
        font-weight: 750;
        margin-bottom: 7px;
    }

    .about-cta p {
        font-size: 12px;
        line-height: 1.7;
        color: #d0d0d0;
        margin-bottom: 0;
    }

    .about-cta a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-shrink: 0;
        padding: 12px 17px;
        border-radius: 8px;
        background: #f6c344;
        color: #292929;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        transition: .2s ease;
    }

    .about-cta a:hover {
        background: #ffda72;
        transform: translateY(-2px);
        color: #222;
    }

    @media (max-width: 767px) {
        .about-hero-content {
            padding: 25px;
        }

        .about-image-wrap,
        .about-image-wrap img {
            min-height: 260px;
            max-height: 300px;
        }

        .about-cta {
            align-items: flex-start;
            flex-direction: column;
            padding: 23px;
        }

        .about-cta a {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .about-image-wrap img,
        .about-info-card,
        .about-cta a {
            transition: none;
        }
    }
</style>

<div class="about-page">

    {{-- HEADER HALAMAN --}}
    <div class="about-heading">

        <h1 class="fw-bold mb-2">
            Tentang Toko
        </h1>

        <p class="text-muted mb-0">
            Kenali lebih dekat Toko Bintang Emas Mandiri dan temukan
            informasi kebutuhan material bangunan melalui website kami.
        </p>
    </div>

    {{-- HERO PROFIL TOKO --}}
    <div class="about-hero">
        <div class="row g-0 align-items-stretch">

            {{-- INFORMASI UTAMA --}}
            <div class="col-md-7 order-2 order-md-1">
                <div class="about-hero-content">

                    <div class="about-label">
                        <i class="bi bi-shop"></i>
                        TOKO MATERIAL BANGUNAN
                    </div>

                    <h2>
                        Solusi Kebutuhan<br>
                        <span>Material Bangunan</span> Anda
                    </h2>

                    <p>
                        Toko Bangunan Bintang Emas Mandiri merupakan toko
                        yang menyediakan berbagai kebutuhan material dan
                        perlengkapan bangunan untuk masyarakat di wilayah
                        Kota Palu dan sekitarnya.
                    </p>

                    <p class="mb-0">
                        Melalui website ini, pelanggan dapat melihat katalog
                        produk, mengetahui harga dan ketersediaan barang,
                        mencari produk berdasarkan kategori, serta melihat
                        informasi promosi sebelum melakukan pemesanan.
                    </p>

                </div>
            </div>

            {{-- GAMBAR TOKO --}}
            <div class="col-md-5 order-1 order-md-2">
                <div class="about-image-wrap">

                    <img
                        src="{{ asset('assets/images/toko.jpg') }}"
                        alt="Foto Toko Bintang Emas Mandiri"
                        loading="lazy"
                    >

                    <div class="about-image-caption">
                        <strong>Toko Bintang Emas Mandiri</strong>
                        <span>Melayani kebutuhan material bangunan Anda</span>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- INFORMASI TOKO --}}
    <div class="mb-4">
        <h2 class="about-section-title">
            Informasi Toko
        </h2>

        <p class="about-section-subtitle">
            Informasi lokasi dan waktu pelayanan toko.
        </p>

        <div class="row g-3">

            {{-- ALAMAT --}}
            <div class="col-md-6">
                <div class="about-info-card">

                    <div class="about-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <h3>Lokasi Toko</h3>

                    <p>
                        Jl. Berdikari, Sunju, Kecamatan Marawola.
                        Silakan hubungi admin toko untuk memastikan lokasi
                        dan petunjuk arah sebelum berkunjung.
                    </p>

                </div>
            </div>

            {{-- JAM OPERASIONAL --}}
            <div class="col-md-6">
                <div class="about-info-card">

                    <div class="about-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <h3>Jam Operasional</h3>

                    <p>
                        Kami melayani pelanggan setiap hari pada pukul
                        08.00–17.00. Untuk memastikan jadwal pelayanan,
                        silakan konfirmasi terlebih dahulu kepada admin.
                    </p>

                </div>
            </div>

        </div>
    </div>

    {{-- LAYANAN WEBSITE --}}
    <div class="row g-4 align-items-start mt-2">

        <div class="col-lg-5">
            <h2 class="about-section-title">
                Kemudahan untuk Pelanggan
            </h2>

            <p class="about-section-subtitle">
                Website ini dirancang agar pelanggan lebih mudah mendapatkan
                informasi produk sebelum melakukan pemesanan.
            </p>

            <div class="about-feature">
                <div class="about-feature-icon">
                    <i class="bi bi-grid"></i>
                </div>

                <div>
                    <h3>Katalog Produk</h3>
                    <p>
                        Lihat nama produk, foto, harga, deskripsi, dan
                        ketersediaan barang dalam satu halaman.
                    </p>
                </div>
            </div>

            <div class="about-feature">
                <div class="about-feature-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div>
                    <h3>Informasi Promosi</h3>
                    <p>
                        Temukan informasi promo dan diskon produk yang
                        tersedia di toko.
                    </p>
                </div>
            </div>

            <div class="about-feature">
                <div class="about-feature-icon">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div>
                    <h3>Pemesanan Produk</h3>
                    <p>
                        Lakukan pemesanan melalui website dan pantau status
                        pesanan melalui menu riwayat pesanan.
                    </p>
                </div>
            </div>
        </div>

        {{-- KEUNGGULAN --}}
        <div class="col-lg-7">
            <div class="about-info-card">

                <h3 class="mb-2">Mengapa Menggunakan Website Kami?</h3>

                <p class="mb-3">
                    Kami menyediakan akses informasi produk yang lebih praktis
                    sehingga pelanggan dapat mempertimbangkan kebutuhan
                    bangunan sebelum melakukan pemesanan.
                </p>

                <div class="about-feature">
                    <div class="about-feature-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>
                        <h3>Pencarian Lebih Mudah</h3>
                        <p>
                            Cari produk berdasarkan nama maupun kategori
                            sesuai kebutuhan Anda.
                        </p>
                    </div>
                </div>

                <div class="about-feature">
                    <div class="about-feature-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>
                        <h3>Informasi Lebih Jelas</h3>
                        <p>
                            Periksa detail produk dan ketersediaan stok
                            sebelum menentukan pesanan.
                        </p>
                    </div>
                </div>

                <div class="about-feature">
                    <div class="about-feature-icon">
                        <i class="bi bi-receipt"></i>
                    </div>

                    <div>
                        <h3>Riwayat Pesanan</h3>
                        <p>
                            Lihat informasi pesanan yang telah dibuat melalui
                            akun pelanggan Anda.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- AJAKAN MELIHAT PRODUK --}}
    <div class="about-cta">

        <div>
            <h3>Temukan Produk yang Anda Butuhkan</h3>

            <p>
                Jelajahi katalog produk kami dan dapatkan informasi
                kebutuhan material bangunan dengan lebih mudah.
            </p>
        </div>

        <a href="{{ route('pelanggan.produk') }}">
            Lihat Katalog Produk
            <i class="bi bi-arrow-right"></i>
        </a>

    </div>

</div>

@endsection
