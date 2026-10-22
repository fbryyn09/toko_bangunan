@extends('layouts.pelanggan')

@section('title', 'Detail Promo')

@section('content')

<style>
    .detail-promo-page {
        max-width: 1100px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    .promo-back {
        display: inline-block;
        margin-bottom: 20px;
        color: #555;
        text-decoration: none;
        font-size: 13px;
    }

    .promo-back:hover {
        color: #d18b00;
    }

    /* INFORMASI PROMO */
    .promo-info {
        padding: 28px;
        margin-bottom: 30px;
        border-radius: 14px;
        background: linear-gradient(110deg, #fff2c9, #ffe0bd);
    }

    .promo-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        background: #fff;
        color: #b56b00;
        font-size: 11px;
        font-weight: 700;
    }

    .promo-info h1 {
        margin: 12px 0;
        color: #222;
        font-size: 28px;
        font-weight: 800;
    }

    .promo-description {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
    }

    .promo-period {
        font-size: 12px;
        color: #777;
    }

    /* JUDUL PRODUK */
    .promo-products-title {
        margin-bottom: 20px;
        font-size: 21px;
        font-weight: 750;
        color: #222;
    }

    /* DAFTAR PRODUK */
    .promo-product-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
    }

    .promo-product-card {
        overflow: hidden;
        border: 1px solid #eee;
        border-radius: 12px;
        background: #fff;
        transition: 0.2s;
    }

    .promo-product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
    }

    .promo-product-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 175px;
        padding: 12px;
        background: #fafafa;
    }

    .promo-product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .promo-no-image {
        color: #aaa;
        font-size: 12px;
    }

    .promo-product-info {
        padding: 15px;
    }

    .promo-product-info h3 {
        margin-bottom: 10px;
        color: #222;
        font-size: 14px;
        font-weight: 700;
    }

    .promo-original-price {
        color: #999;
        font-size: 12px;
        text-decoration: line-through;
    }

    .promo-discount-price {
        margin-top: 3px;
        color: #d92d20;
        font-size: 17px;
        font-weight: 800;
    }

    .promo-saving {
        display: inline-block;
        margin-top: 8px;
        padding: 5px 8px;
        border-radius: 5px;
        background: #fde8e7;
        color: #d92d20;
        font-size: 10px;
        font-weight: 700;
    }

    .promo-product-button {
        display: block;
        margin-top: 15px;
        padding: 10px;
        border-radius: 7px;
        background: #f6c344;
        color: #222;
        text-align: center;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
    }

    .promo-product-button:hover {
        background: #eab52f;
        color: #222;
    }

    /* JIKA PRODUK KOSONG */
    .promo-empty {
        padding: 35px 20px;
        border-radius: 12px;
        background: #f7f7f7;
        color: #777;
        text-align: center;
    }

    .promo-empty h3 {
        color: #333;
        font-size: 17px;
    }

    .promo-empty p {
        margin-bottom: 0;
        font-size: 13px;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .promo-product-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .promo-product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .promo-info {
            padding: 20px;
        }

        .promo-info h1 {
            font-size: 23px;
        }

        .promo-product-image {
            height: 135px;
        }

        .promo-product-info {
            padding: 12px;
        }
    }
</style>

<div class="detail-promo-page">

    {{-- TOMBOL KEMBALI --}}
    <a href="{{ route('pelanggan.promo') }}" class="promo-back">
        &larr; Kembali ke Promo
    </a>

    {{-- INFORMASI PROMO --}}
    <div class="promo-info">

        <span class="promo-badge">PROMO AKTIF</span>

        <h1>{{ $promosi->nama_promosi }}</h1>

        <p class="promo-description">
            {{ $promosi->deskripsi ?: 'Dapatkan penawaran menarik untuk produk pilihan kami.' }}
        </p>

        <div class="promo-period">
            Berlaku:
            {{ \Carbon\Carbon::parse($promosi->tanggal_mulai)->translatedFormat('d F Y') }}
            -
            {{ \Carbon\Carbon::parse($promosi->tanggal_selesai)->translatedFormat('d F Y') }}
        </div>

    </div>

    {{-- DAFTAR PRODUK --}}
    <h2 class="promo-products-title">
        Produk dalam Promo
    </h2>

    @if ($produkPromo->isNotEmpty())

        <div class="promo-product-grid">

            @foreach ($produkPromo as $item)

                <div class="promo-product-card">

                    {{-- GAMBAR PRODUK --}}
                    <div class="promo-product-image">

                        @if ($item->gambar)
                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->nama_produk }}"
                            >
                        @else
                            <span class="promo-no-image">
                                Tidak ada gambar
                            </span>
                        @endif

                    </div>

                    {{-- INFORMASI PRODUK --}}
                    <div class="promo-product-info">

                        <h3>{{ $item->nama_produk }}</h3>

                        <div class="promo-original-price">
                            Rp {{ number_format($item->harga_asli, 0, ',', '.') }}
                        </div>

                        <div class="promo-discount-price">
                            Rp {{ number_format($item->harga_setelah_diskon, 0, ',', '.') }}
                        </div>

                        <span class="promo-saving">
                            Hemat Rp {{ number_format($item->nilai_diskon, 0, ',', '.') }}
                        </span>

                        <a
                            href="{{ route('pelanggan.detail-produk', $item->id_produk) }}"
                            class="promo-product-button"
                        >
                            Lihat Detail Produk
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="promo-empty">
            <h3>Belum Ada Produk yang Mendapatkan Diskon</h3>
            <p>
                Promo ini belum memiliki produk tersedia
                yang memperoleh potongan harga.
            </p>
        </div>

    @endif

</div>

@endsection
