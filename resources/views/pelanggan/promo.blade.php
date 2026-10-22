
@extends('layouts.pelanggan')

@section('title', 'Promo')

@section('content')

<style>
    .promo-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .promo-header {
        margin-bottom: 28px;
    }

    .promo-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
    }

    .promo-header p {
        font-size: 13px;
        color: #777;
        margin-bottom: 0;
    }

    /* PROMO UTAMA */
    .promo-featured {
        position: relative;
        min-height: 220px;
        border-radius: 16px;
        overflow: hidden;
        background: linear-gradient(100deg, #f6c344, #f5a06b);
        margin-bottom: 42px;
    }

    .promo-featured-content {
        position: relative;
        z-index: 2;
        width: 60%;
        padding: 30px 35px;
    }

    .promo-label {
        display: inline-block;
        background: #fff;
        color: #d18b00;
        font-size: 10px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .promo-featured h2 {
        font-size: 25px;
        font-weight: 700;
        color: #222;
        margin-bottom: 7px;
    }

    .promo-featured-description {
        font-size: 13px;
        color: #555;
        line-height: 1.5;
        margin-bottom: 10px;
        max-width: 500px;
    }

    .promo-discount {
        font-size: 20px;
        font-weight: 700;
        color: #e85d04;
        margin-bottom: 5px;
    }

    .promo-period {
        font-size: 11px;
        color: #666;
        margin-bottom: 15px;
    }

    .promo-button {
        display: inline-block;
        background: #fff;
        color: #222;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 20px;
        transition: 0.2s;
    }

    .promo-button:hover {
        background: #222;
        color: #fff;
    }

    .promo-featured-image {
        position: absolute;
        right: 25px;
        top: 15px;
        width: 35%;
        height: calc(100% - 30px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .promo-featured-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 10px;
    }

    .promo-no-image {
        color: rgba(0, 0, 0, 0.4);
        font-size: 13px;
    }

    /* JUDUL DAFTAR PROMO */
    .promo-list-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .promo-list-header h2 {
        font-size: 21px;
        font-weight: 700;
        margin: 0;
        color: #222;
    }

    .promo-list-header span {
        font-size: 12px;
        color: #888;
    }

    /* GRID */
    .promo-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    /* CARD PROMO */
    .promo-card {
        display: flex;
        align-items: center;
        gap: 18px;
        min-height: 160px;
        background: #f7f7f7;
        border-radius: 12px;
        padding: 15px;
        transition: 0.2s;
    }

    .promo-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    }

    .promo-card-image {
        flex-shrink: 0;
        width: 120px;
        height: 120px;
        background: #fff;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .promo-card-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 8px;
    }

    .promo-card-info {
        flex: 1;
        min-width: 0;
    }

    .promo-card-info h3 {
        font-size: 15px;
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
    }

    .promo-card-info p {
        font-size: 12px;
        color: #777;
        line-height: 1.5;
        margin-bottom: 7px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .promo-card-discount {
        font-size: 14px;
        font-weight: 700;
        color: #e85d04;
        margin-bottom: 4px;
    }

    .promo-card-period {
        font-size: 10px;
        color: #777;
        margin-bottom: 9px;
    }

    .promo-active {
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        color: #15803d;
        background: #dcfce7;
        padding: 4px 9px;
        border-radius: 20px;
        margin-bottom: 8px;
    }

    .promo-card-button {
        display: inline-block;
        background: #f6c344;
        color: #222;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
        padding: 7px 13px;
        border-radius: 7px;
        transition: 0.2s;
    }

    .promo-card-button:hover {
        background: #eab52f;
        color: #222;
    }

    /* KOSONG */
    .promo-empty {
        background: #f7f7f7;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
    }

    .promo-empty-icon {
        font-size: 30px;
        color: #aaa;
        margin-bottom: 10px;
    }

    .promo-empty h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .promo-empty p {
        font-size: 13px;
        color: #888;
        margin-bottom: 0;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .promo-featured {
            min-height: auto;
        }

        .promo-featured-content {
            width: 100%;
            padding: 25px;
        }

        .promo-featured-image {
            position: relative;
            right: auto;
            top: auto;
            width: 100%;
            height: 170px;
            padding: 0 20px 20px;
        }

        .promo-grid {
            grid-template-columns: 1fr;
        }

        .promo-card {
            min-height: 140px;
        }

        .promo-card-image {
            width: 95px;
            height: 95px;
        }
    }

    @media (max-width: 480px) {
        .promo-featured h2 {
            font-size: 21px;
        }

        .promo-card {
            gap: 12px;
        }

        .promo-card-image {
            width: 85px;
            height: 85px;
        }
    }
</style>

<div class="promo-page">

    {{-- HEADER --}}
    <div class="promo-header">
        <h1>Promo Spesial</h1>
        <p>
            Jangan lewatkan berbagai promo menarik dari
            Toko Bangunan Bintang Emas Mandiri.
        </p>
    </div>

    @if ($promosi->count() > 0)

        {{-- PROMO UTAMA --}}
        @php
            $promoUtama = $promosi->first();
        @endphp

        <div class="promo-featured">

            <div class="promo-featured-content">

                <span class="promo-label">PROMO AKTIF</span>

                <h2>{{ $promoUtama->nama_promosi }}</h2>

                <div class="promo-discount">
                    @if (in_array($promoUtama->jenis_diskon, ['persen', 'persentase']))
                        {{ number_format($promoUtama->nilai_diskon, 0) }}% OFF
                    @else
                        Rp {{ number_format($promoUtama->nilai_diskon, 0, ',', '.') }} OFF
                    @endif
                </div>

                <p class="promo-featured-description">
                    {{ $promoUtama->deskripsi }}
                </p>

                <div class="promo-period">
                    Berlaku:
                    {{ \Carbon\Carbon::parse($promoUtama->tanggal_mulai)->translatedFormat('d F Y') }}
                    -
                    {{ \Carbon\Carbon::parse($promoUtama->tanggal_selesai)->translatedFormat('d F Y') }}
                </div>

                {{-- MENUJU HALAMAN DETAIL PROMO --}}
                <a
                    href="{{ route('pelanggan.detail-promo', $promoUtama->id_promosi) }}"
                    class="promo-button"
                >
                    Lihat Produk →
                </a>

            </div>

            {{-- GAMBAR PROMO --}}
            <div class="promo-featured-image">
                @if ($promoUtama->gambar)
                    <img
                        src="{{ asset('storage/' . $promoUtama->gambar) }}"
                        alt="{{ $promoUtama->nama_promosi }}"
                    >
                @else
                    <span class="promo-no-image">
                        Tidak ada gambar promo
                    </span>
                @endif
            </div>

        </div>

        {{-- DAFTAR PROMO --}}
        <div class="promo-list-header">
            <h2>Daftar Promo</h2>
            <span>{{ $promosi->count() }} promo aktif</span>
        </div>

        <div class="promo-grid">

            @foreach ($promosi as $item)

                <div class="promo-card">

                    {{-- GAMBAR --}}
                    <div class="promo-card-image">
                        @if ($item->gambar)
                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->nama_promosi }}"
                            >
                        @else
                            <span class="promo-no-image">
                                Tidak ada gambar
                            </span>
                        @endif
                    </div>

                    {{-- INFORMASI --}}
                    <div class="promo-card-info">

                        <span class="promo-active">● Aktif</span>

                        <h3>{{ $item->nama_promosi }}</h3>

                        <div class="promo-card-discount">
                            @if (in_array($item->jenis_diskon, ['persen', 'persentase']))
                                Diskon {{ number_format($item->nilai_diskon, 0) }}%
                            @else
                                Diskon Rp {{ number_format($item->nilai_diskon, 0, ',', '.') }}
                            @endif
                        </div>

                        <div class="promo-card-period">
                            Berlaku
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') }}
                        </div>

                        {{-- MENUJU HALAMAN DETAIL PROMO --}}
                        <a
                            href="{{ route('pelanggan.detail-promo', $item->id_promosi) }}"
                            class="promo-card-button"
                        >
                            Lihat Produk
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- BELUM ADA PROMO --}}
        <div class="promo-empty">
            <div class="promo-empty-icon">—</div>

            <h3>Belum Ada Promo</h3>

            <p>
                Saat ini belum ada promo aktif yang tersedia.
            </p>
        </div>

    @endif

</div>

@endsection