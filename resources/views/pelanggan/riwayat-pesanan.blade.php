@extends('layouts.pelanggan')

@section('title', 'Riwayat Pesanan')

@section('content')

    <div class="history-page">

        {{-- HEADER --}}
        <div class="history-header">
            <h1>Riwayat Pesanan</h1>
            <p>Lihat dan pantau pesanan yang pernah Anda lakukan.</p>
        </div>

        @forelse ($pesanan as $item)

            <div class="order-card">

                {{-- HEADER PESANAN --}}
                <div class="order-header">

                    <div>
                        {{-- <span class="order-label">
                            ID Pesanan
                        </span>

                        <h3 class="order-id">
                            {{ $item->id_pesanan }}
                        </h3> --}}

                        <p class="order-date">
                            {{ \Carbon\Carbon::parse($item->tanggal_pesanan)->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                    {{-- STATUS --}}
                    @if ($item->status_pesanan == 'menunggu')
                        <span class="order-status status-menunggu">
                            Menunggu
                        </span>
                    @elseif ($item->status_pesanan == 'diproses')
                        <span class="order-status status-diproses">
                            Diproses
                        </span>
                    @elseif ($item->status_pesanan == 'selesai')
                        <span class="order-status status-selesai">
                            Selesai
                        </span>
                    @elseif ($item->status_pesanan == 'dibatalkan')
                        <span class="order-status status-dibatalkan">
                            Dibatalkan
                        </span>
                    @else
                        <span class="order-status status-menunggu">
                            {{ ucfirst($item->status_pesanan) }}
                        </span>
                    @endif

                </div>


                {{-- DAFTAR PRODUK --}}
                <div class="order-items">

                    @foreach ($item->detailPesanan as $detail)
                        <div class="order-item">

                            {{-- FOTO --}}
                            <div class="item-image">

                                @if ($detail->produk && $detail->produk->gambar)
                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                        alt="{{ $detail->produk->nama_produk }}">
                                @else
                                    <div class="item-no-image">
                                        📦
                                    </div>
                                @endif

                            </div>


                            {{-- PRODUK --}}
                            <div class="item-info">

                                <h4>
                                    {{ $detail->produk->nama_produk ?? 'Produk tidak tersedia' }}
                                </h4>

                                <p>
                                    {{ $detail->jumlah }}
                                    {{ $detail->produk->satuan ?? '' }}
                                    × Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                </p>

                            </div>


                            {{-- SUBTOTAL --}}
                            <div class="item-price">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </div>

                        </div>
                    @endforeach

                </div>


                {{-- FOOTER PESANAN --}}
                <div class="order-footer">

                    <div class="payment">

                        <span>Metode Pembayaran</span>

                        <strong>

                            @if ($item->metode_pembayaran == 'cod')
                                COD
                            @elseif ($item->metode_pembayaran == 'qris')
                                QRIS
                            @else
                                {{ strtoupper($item->metode_pembayaran) }}
                            @endif

                        </strong>

                    </div>


                    <div class="order-total-wrapper">

                        <div class="total">

                            <span>Total Pesanan</span>

                            <strong>
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </strong>

                        </div>


                        {{-- TOMBOL DETAIL --}}
                        <a href="{{ route('pelanggan.detail-pesanan', $item->id_pesanan) }}" class="btn-detail-order">

                            <span>Lihat Detail</span>

                        </a>

                    </div>

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="empty-order">

                <div class="empty-icon">
                    🛒
                </div>

                <h3>
                    Belum Ada Pesanan
                </h3>

                <p>
                    Anda belum melakukan pemesanan produk.
                </p>

                <a href="{{ route('pelanggan.produk') }}" class="btn-products">

                    Mulai Belanja

                </a>

            </div>

        @endforelse

    </div>


    <style>
        /* =========================================
               HALAMAN
            ========================================= */

        .history-page {
            width: 100%;
            max-width: 950px;
            padding: 10px 25px 60px;
        }


        /* =========================================
               HEADER
            ========================================= */

        .history-header {
            margin-bottom: 30px;
        }

        .history-header h1 {
            margin: 0 0 6px;
            font-size: 30px;
            font-weight: 800;
            color: #222;
        }

        .history-header p {
            margin: 0;
            font-size: 15px;
            color: #777;
        }


        /* =========================================
               CARD PESANAN
            ========================================= */

        .order-card {
            background: #ffffff;
            border: 1px solid #e7e7e7;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: 0.2s ease;
        }

        .order-card:hover {
            border-color: #dcdcdc;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05);
        }


        /* =========================================
               HEADER ORDER
            ========================================= */

        .order-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 20px 22px;
            background: #fffdf8;
            border-bottom: 1px solid #eeeeee;
        }

        .order-label {
            display: block;
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .order-id {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            color: #222;
        }

        .order-date {
            margin: 4px 0 0;
            font-size: 13px;
            color: #888;
        }


        /* =========================================
               STATUS
            ========================================= */

        .order-status {
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
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
               ITEM PRODUK
            ========================================= */

        .order-items {
            padding: 8px 22px;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }


        /* FOTO PRODUK */

        .item-image {
            width: 68px;
            height: 68px;
            min-width: 68px;
            border-radius: 8px;
            overflow: hidden;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-no-image {
            font-size: 25px;
        }


        /* INFORMASI PRODUK */

        .item-info {
            flex: 1;
        }

        .item-info h4 {
            margin: 0 0 5px;
            font-size: 15px;
            font-weight: 700;
            color: #222;
        }

        .item-info p {
            margin: 0;
            font-size: 13px;
            color: #888;
        }


        /* HARGA */

        .item-price {
            font-size: 14px;
            font-weight: 700;
            color: #222;
            white-space: nowrap;
        }


        /* =========================================
               FOOTER ORDER
            ========================================= */

        .order-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 17px 22px;
            background: #fafafa;
            border-top: 1px solid #eeeeee;
        }

        .payment span,
        .total span {
            display: block;
            font-size: 11px;
            color: #888;
            margin-bottom: 4px;
        }

        .payment strong {
            font-size: 14px;
            color: #444;
        }

        .total {
            text-align: right;
        }

        .total strong {
            font-size: 18px;
            font-weight: 800;
            color: #222;
        }


        /* =========================================
               TOMBOL LIHAT DETAIL
            ========================================= */

        .order-total-wrapper {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .btn-detail-order {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            min-width: 125px;
            height: 40px;
            padding: 0 16px;

            background: #f1f000;
            color: #222;

            border: 1px solid #f1f000;
            border-radius: 8px;

            text-decoration: none;
            font-size: 13px;
            font-weight: 700;

            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);

            transition:
                background 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .btn-detail-order:hover {
            background: #dedf00;
            border-color: #dedf00;
            color: #222;

            transform: translateY(-2px);

            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
        }

        .btn-detail-order:hover .btn-detail-icon {
            transform: translateX(4px);
        }

        .btn-detail-order:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }


        /* =========================================
               EMPTY
            ========================================= */

        .empty-order {
            text-align: center;
            background: #fff;
            border: 1px solid #e7e7e7;
            border-radius: 12px;
            padding: 65px 20px;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fff8e8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .empty-order h3 {
            margin: 0 0 7px;
            font-size: 19px;
            font-weight: 700;
            color: #222;
        }

        .empty-order p {
            margin: 0 0 22px;
            font-size: 14px;
            color: #888;
        }

        .btn-products {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 22px;
            border-radius: 7px;
            background: #f1f000;
            color: #222;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-products:hover {
            background: #dcdc00;
            color: #222;
        }


        /* =========================================
               RESPONSIVE
            ========================================= */

        @media (max-width: 768px) {

            .history-page {
                padding: 10px 5px 40px;
            }

            .history-header h1 {
                font-size: 26px;
            }

            .history-header p {
                font-size: 14px;
            }

            .order-header {
                padding: 17px;
            }

            .order-items {
                padding: 5px 17px;
            }

            .order-footer {
                padding: 15px 17px;
            }

            .item-image {
                width: 58px;
                height: 58px;
                min-width: 58px;
            }

            .item-info h4 {
                font-size: 14px;
            }

            .item-info p {
                font-size: 12px;
            }

            .item-price {
                font-size: 13px;
            }

            .total strong {
                font-size: 16px;
            }

        }


        @media (max-width: 500px) {

            .order-header {
                align-items: flex-start;
                gap: 10px;
            }

            .order-status {
                padding: 6px 10px;
                font-size: 11px;
            }

            .order-item {
                gap: 11px;
            }

            .item-price {
                font-size: 12px;
            }

            .order-footer {
                gap: 20px;
            }

            .order-total-wrapper {
                gap: 12px;
            }

            .btn-detail-order {
                min-width: 105px;
                height: 38px;
                padding: 0 12px;
                font-size: 12px;
            }

        }
    </style>

@endsection
