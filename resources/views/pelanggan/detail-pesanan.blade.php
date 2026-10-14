@extends('layouts.pelanggan')

@section('title', 'Detail Pesanan')

@section('content')

    <div class="detail-page">

        {{-- HEADER --}}
        <div class="detail-header">

            <h1>Detail Pesanan</h1>

            <p>
                Informasi lengkap mengenai pesanan Anda.
            </p>

        </div>


        {{-- INFORMASI PESANAN --}}
        <div class="order-info">

            <div class="order-info-left">

                <span class="info-label">
                    ID Pesanan
                </span>

                <h2>
                    {{ $pesanan->id_pesanan }}
                </h2>

                <span class="order-date">
                    {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->translatedFormat('d F Y, H:i') }}
                </span>

            </div>


            {{-- STATUS --}}
            <div class="order-info-right">

                @if ($pesanan->status_pesanan == 'menunggu')
                    <span class="order-status status-menunggu">
                        Menunggu
                    </span>
                @elseif ($pesanan->status_pesanan == 'diproses')
                    <span class="order-status status-diproses">
                        Diproses
                    </span>
                @elseif ($pesanan->status_pesanan == 'selesai')
                    <span class="order-status status-selesai">
                        Selesai
                    </span>
                @elseif ($pesanan->status_pesanan == 'dibatalkan')
                    <span class="order-status status-dibatalkan">
                        Dibatalkan
                    </span>
                @else
                    <span class="order-status status-menunggu">
                        {{ ucfirst($pesanan->status_pesanan) }}
                    </span>
                @endif

            </div>

        </div>


        {{-- PRODUK --}}
        <div class="detail-section">

            <div class="section-title">
                Produk yang Dipesan
            </div>


            <div class="product-list">

                @foreach ($pesanan->detailPesanan as $detail)
                    <div class="product-row">

                        {{-- GAMBAR --}}
                        <div class="product-image">

                            @if ($detail->produk && $detail->produk->gambar)
                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                    alt="{{ $detail->produk->nama_produk }}">
                            @else
                                <div class="no-image">
                                    📦
                                </div>
                            @endif

                        </div>


                        {{-- INFORMASI PRODUK --}}
                        <div class="product-content">

                            <h3>
                                {{ $detail->produk->nama_produk ?? 'Produk tidak tersedia' }}
                            </h3>

                            <p>
                                {{ $detail->jumlah }}
                                {{ $detail->produk->satuan ?? '' }}
                                × Rp {{ number_format($detail->harga, 0, ',', '.') }}
                            </p>

                        </div>


                        {{-- SUBTOTAL --}}
                        <div class="product-total">

                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}

                        </div>

                    </div>
                @endforeach

            </div>

        </div>


        {{-- PEMBAYARAN --}}
        <div class="detail-section">

            <div class="section-title">
                Ringkasan Pembayaran
            </div>


            <div class="payment-content">

                <div class="payment-row">

                    <span>
                        Metode Pembayaran
                    </span>

                    <strong>

                        @if ($pesanan->metode_pembayaran == 'cod')
                            COD
                        @elseif ($pesanan->metode_pembayaran == 'qris')
                            QRIS
                        @else
                            {{ strtoupper($pesanan->metode_pembayaran) }}
                        @endif

                    </strong>

                </div>


                <div class="payment-line"></div>


                <div class="payment-row total-row">

                    <span>
                        Total Pesanan
                    </span>

                    <strong>
                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- TOMBOL AKSI --}}
        <div class="bottom-action">

            <div class="order-action-buttons">

                {{-- KEMBALI --}}
                <a href="{{ route('pelanggan.riwayat-pesanan') }}" class="aksi-button">
                    Kembali ke Riwayat
                </a>

                {{-- CETAK STRUK --}}
                <a href="{{ route('pelanggan.struk-pesanan', $pesanan->id_pesanan) }}" class="aksi-button"
                    style="background: #f1f000; border-color: #f1f000;">
                    Cetak Struk
                </a>

            </div>

        </div>

    </div>


    <style>
        /* =========================================
                       PAGE
                    ========================================= */

        .detail-page {
            width: 100%;
            max-width: 900px;

            padding: 8px 25px 60px;
        }


        /* =========================================
                       HEADER
                    ========================================= */

        .detail-header {
            margin-bottom: 25px;
        }

        .back-link {
            display: inline-block;

            margin-bottom: 18px;

            color: #777;

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;
        }

        .back-link:hover {
            color: #222;
        }

        .detail-header h1 {
            margin: 0 0 5px;

            color: #222;

            font-size: 30px;
            font-weight: 800;
        }

        .detail-header p {
            margin: 0;

            color: #777;

            font-size: 15px;
        }


        /* =========================================
                       ORDER INFO
                    ========================================= */

        .order-info {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px 22px;

            margin-bottom: 18px;

            background: #fffdf8;

            border: 1px solid #e7e7e7;
            border-radius: 10px;
        }

        .info-label {
            display: block;

            margin-bottom: 4px;

            color: #888;

            font-size: 11px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .order-info h2 {
            margin: 0;

            color: #222;

            font-size: 19px;
            font-weight: 800;
        }

        .order-date {
            display: block;

            margin-top: 4px;

            color: #888;

            font-size: 13px;
        }


        /* =========================================
                       STATUS
                    ========================================= */

        .order-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 7px 14px;

            border-radius: 20px;

            font-size: 12px;
            font-weight: 600;
        }

        .status-menunggu {
            background: #fff3d4;
            color: #9b7200;
        }

        .status-diproses {
            background: #eaf2ff;
            color: #3269ae;
        }

        .status-selesai {
            background: #e8f7ed;
            color: #28794a;
        }

        .status-dibatalkan {
            background: #ffeaea;
            color: #b33b3b;
        }


        /* =========================================
                       SECTION
                    ========================================= */

        .detail-section {
            width: 100%;

            margin-bottom: 18px;

            background: #fff;

            border: 1px solid #e7e7e7;
            border-radius: 10px;

            overflow: hidden;
        }

        .section-title {
            padding: 17px 22px;

            border-bottom: 1px solid #eeeeee;

            color: #222;

            font-size: 15px;
            font-weight: 700;
        }


        /* =========================================
                       PRODUK
                    ========================================= */

        .product-list {
            padding: 0 22px;
        }

        .product-row {
            display: flex;
            align-items: center;

            width: 100%;

            gap: 16px;

            padding: 17px 0;

            border-bottom: 1px solid #f0f0f0;
        }

        .product-row:last-child {
            border-bottom: none;
        }


        /* IMAGE */

        .product-image {
            width: 65px;
            height: 65px;

            min-width: 65px;

            overflow: hidden;

            border-radius: 8px;

            background: #f5f5f5;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .no-image {
            font-size: 24px;
        }


        /* PRODUCT CONTENT */

        .product-content {
            flex: 1;

            min-width: 0;
        }

        .product-content h3 {
            margin: 0 0 5px;

            color: #222;

            font-size: 15px;
            font-weight: 700;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-content p {
            margin: 0;

            color: #888;

            font-size: 13px;
        }


        /* TOTAL PRODUCT */

        .product-total {
            flex-shrink: 0;

            color: #222;

            font-size: 14px;
            font-weight: 700;

            text-align: right;

            white-space: nowrap;
        }


        /* =========================================
                       PEMBAYARAN
                    ========================================= */

        .payment-content {
            padding: 0 22px;
        }

        .payment-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 17px 0;
        }

        .payment-row span {
            color: #777;

            font-size: 14px;
        }

        .payment-row strong {
            color: #444;

            font-size: 14px;
            font-weight: 700;
        }

        .payment-line {
            width: 100%;
            height: 1px;

            background: #eeeeee;
        }

        .total-row {
            padding-top: 19px;
            padding-bottom: 19px;
        }

        .total-row span {
            color: #333;

            font-size: 14px;
            font-weight: 600;
        }

        .total-row strong {
            color: #222;

            font-size: 20px;
            font-weight: 800;
        }


        /* =========================================
                       BOTTOM BUTTON
                    ========================================= */

        .bottom-action {
            margin-top: 24px;
        }

        .aksi-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 40px;

            padding: 0 18px;

            border: 1px solid #ddd;
            border-radius: 6px;

            background: #fff;

            color: #222;

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;

            transition: .2s ease;
        }

        /* .aksi-button:hover {
                    background: #f1f000;
                    border-color: #f1f000;

                    color: #222;
                } */


        /* =========================================
                       RESPONSIVE
                    ========================================= */

        @media (max-width: 768px) {

            .detail-page {
                padding: 8px 5px 40px;
            }

            .detail-header h1 {
                font-size: 26px;
            }

            .detail-header p {
                font-size: 14px;
            }

            .order-info {
                padding: 17px;
            }

            .section-title {
                padding: 16px 17px;
            }

            .product-list {
                padding: 0 17px;
            }

            .product-row {
                gap: 12px;
            }

            .product-image {
                width: 58px;
                height: 58px;
                min-width: 58px;
            }

            .product-content h3 {
                font-size: 14px;
            }

            .product-content p {
                font-size: 12px;
            }

            .product-total {
                font-size: 12px;
            }

            .payment-content {
                padding: 0 17px;
            }

        }


        @media (max-width: 500px) {

            .order-info {
                align-items: flex-start;
                gap: 12px;
            }

            .order-status {
                padding: 6px 10px;

                font-size: 11px;
            }

            .product-row {
                gap: 10px;
            }

            .product-image {
                width: 52px;
                height: 52px;
                min-width: 52px;
            }

            .product-content h3 {
                font-size: 13px;
            }

            .product-total {
                font-size: 11px;
            }

            .total-row strong {
                font-size: 17px;
            }

        }
    </style>

@endsection
