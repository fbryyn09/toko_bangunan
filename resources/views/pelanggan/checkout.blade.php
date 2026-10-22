@extends('layouts.pelanggan')

@section('title', 'Checkout')

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
               CHECKOUT PAGE
            ===================================================== */

        .checkout-page {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 10px 0 50px;
        }

        /* =====================================================
               HEADER
            ===================================================== */

        .checkout-header {
            margin-bottom: 25px;
        }

        .checkout-header h1 {
            margin: 0 0 6px;
            color: #222;
            font-size: 28px;
            font-weight: 750;
        }

        .checkout-header p {
            margin: 0;
            color: #888;
            font-size: 13px;
        }

        /* =====================================================
               ERROR
            ===================================================== */

        .checkout-error {
            margin-bottom: 20px;
            padding: 13px 16px;
            background: #fff1f1;
            border: 1px solid #f2caca;
            border-radius: 9px;
            color: #c0392b;
            font-size: 13px;
        }

        .checkout-error ul {
            margin: 0;
            padding-left: 18px;
        }

        /* =====================================================
               MAIN CARD
            ===================================================== */

        .checkout-card {
            background: #fff;
            border: 1px solid #eeeeee;
            border-radius: 14px;
            overflow: hidden;
        }

        .checkout-card-body {
            padding: 28px;
        }

        /* =====================================================
               SECTION
            ===================================================== */

        .checkout-section {
            margin-bottom: 30px;
        }

        .checkout-section:last-child {
            margin-bottom: 0;
        }

        .checkout-section-title {
            margin: 0 0 18px;
            color: #222;
            font-size: 16px;
            font-weight: 700;
        }

        .checkout-divider {
            height: 1px;
            margin: 28px 0;
            background: #eeeeee;
            border: none;
        }

        /* =====================================================
               PRODUK
            ===================================================== */

        .product-checkout-box {
            display: flex;
            align-items: center;
            gap: 16px;
            min-height: 110px;
            padding: 15px;
            background: #fafafa;
            border: 1px solid #eeeeee;
            border-radius: 10px;
        }

        .checkout-product-image {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            background: #fff;
            border: 1px solid #eeeeee;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .checkout-product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .checkout-no-image {
            color: #aaa;
            font-size: 11px;
            text-align: center;
        }

        .checkout-product-info {
            min-width: 0;
        }

        .checkout-product-name {
            margin-bottom: 5px;
            color: #222;
            font-size: 15px;
            font-weight: 700;
        }

        .checkout-product-unit {
            margin-bottom: 5px;
            color: #999;
            font-size: 12px;
        }

        .checkout-product-price {
            color: #333;
            font-size: 14px;
            font-weight: 750;
        }

        /* =====================================================
               JUMLAH
            ===================================================== */

        .quantity-box {
            padding: 18px;
            background: #fafafa;
            border: 1px solid #eeeeee;
            border-radius: 10px;
        }

        .checkout-label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 13px;
            font-weight: 600;
        }

        .quantity-input {
            width: 100%;
            height: 43px;
            padding: 8px 12px;
            background: #fff;
            border: 1px solid #dddddd;
            border-radius: 7px;
            outline: none;
            color: #333;
            font-size: 13px;
            transition: 0.2s ease;
        }

        .quantity-input:focus {
            border-color: #f6c344;
            box-shadow: 0 0 0 3px rgba(246, 195, 68, 0.12);
        }

        .quantity-help {
            margin-top: 8px;
            color: #999;
            font-size: 11px;
        }

        /* =====================================================
               DATA PELANGGAN
            ===================================================== */

        .customer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .customer-field.full {
            grid-column: 1 / -1;
        }

        .customer-input,
        .customer-textarea {
            width: 100%;
            background: #f8f8f8;
            border: 1px solid #eeeeee;
            border-radius: 7px;
            color: #444;
            font-size: 13px;
            outline: none;
        }

        .customer-input {
            height: 43px;
            padding: 8px 12px;
        }

        .customer-textarea {
            min-height: 85px;
            padding: 10px 12px;
            resize: none;
        }

        /* =====================================================
               PEMBAYARAN
            ===================================================== */

        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .payment-option {
            position: relative;
            display: block;
            cursor: pointer;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .payment-card {
            min-height: 92px;
            padding: 17px;
            background: #fff;
            border: 1px solid #e2e2e2;
            border-radius: 9px;
            transition:
                border-color 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .payment-card:hover {
            border-color: #f0c24b;
        }

        .payment-option input:checked+.payment-card {
            background: #fffaf0;
            border-color: #f6c344;
            box-shadow: 0 3px 10px rgba(246, 195, 68, 0.12);
        }

        .payment-top {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 6px;
        }

        .payment-radio {
            width: 15px;
            height: 15px;
            border: 1.5px solid #bbb;
            border-radius: 50%;
            position: relative;
        }

        .payment-option input:checked+.payment-card .payment-radio {
            border-color: #d39b18;
        }

        .payment-option input:checked+.payment-card .payment-radio::after {
            content: "";
            position: absolute;
            width: 7px;
            height: 7px;
            top: 2.5px;
            left: 2.5px;
            background: #d39b18;
            border-radius: 50%;
        }

        .payment-name {
            color: #333;
            font-size: 13px;
            font-weight: 700;
        }

        .payment-description {
            margin-left: 24px;
            color: #999;
            font-size: 11px;
            line-height: 1.5;
        }

        /* =====================================================
               BUTTON
            ===================================================== */

        .checkout-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #eeeeee;
        }

        .checkout-submit {
            min-width: 150px;
            height: 44px;
            padding: 10px 22px;
            border: 1px solid #f6c344;
            border-radius: 8px;
            background: #f6c344;
            color: #222;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .checkout-submit:hover {
            background: #eab52f;
            border-color: #eab52f;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.09);
        }

        /* =====================================================
               DESKTOP GRID
            ===================================================== */

        .product-order-grid {
            display: grid;
            grid-template-columns: 1.35fr 0.65fr;
            gap: 22px;
        }

        /* =====================================================
               TABLET
            ===================================================== */

        @media (max-width: 900px) {

            .checkout-page {
                padding-left: 20px;
                padding-right: 20px;
            }

            .product-order-grid {
                grid-template-columns: 1fr;
            }
        }

        /* =====================================================
               MOBILE
            ===================================================== */

        @media (max-width: 650px) {

            .checkout-page {
                padding: 5px 15px 35px;
            }

            .checkout-header h1 {
                font-size: 24px;
            }

            .checkout-card-body {
                padding: 20px;
            }

            .customer-grid,
            .payment-grid {
                grid-template-columns: 1fr;
            }

            .customer-field.full {
                grid-column: auto;
            }

            .product-checkout-box {
                padding: 12px;
            }

            .checkout-product-image {
                width: 75px;
                height: 75px;
            }

            .checkout-product-name {
                font-size: 13px;
            }

            .checkout-product-price {
                font-size: 13px;
            }

            .checkout-actions {
                justify-content: stretch;
            }

            .checkout-submit {
                width: 100%;
            }
        }
    </style>


    <div class="checkout-page">

        {{-- HEADER --}}
        <div class="checkout-header">

            <h1>
                Checkout
            </h1>

            <p>
                Periksa produk dan tentukan jumlah pesanan Anda.
            </p>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="checkout-error">

                <ul>

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('pelanggan.pembayaran') }}" method="POST">

            @csrf

            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">


            <div class="checkout-card">

                <div class="checkout-card-body">


                    {{-- =================================================
                     PRODUK & JUMLAH
                ================================================== --}}

                    <div class="checkout-section">

                        <h2 class="checkout-section-title">
                            Produk Pesanan
                        </h2>


                        <div class="product-order-grid">

                            {{-- PRODUK --}}
                            <div class="product-checkout-box">

                                <div class="checkout-product-image">

                                    @if ($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                                            alt="{{ $produk->nama_produk }}">
                                    @else
                                        <span class="checkout-no-image">
                                            Tidak ada gambar
                                        </span>
                                    @endif

                                </div>


                                <div class="checkout-product-info">

                                    <div class="checkout-product-name">
                                        {{ $produk->nama_produk }}
                                    </div>

                                    <div class="checkout-product-unit">
                                        Satuan: {{ $produk->satuan ?? '-' }}
                                    </div>


                                    <div class="checkout-product-price">
                                        @if ($promoAktif && $hargaDiskon < $hargaAsli)
                                            <div
                                                style="color: #888; font-size: 12px; text-decoration: line-through; font-weight: 500;">
                                                Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                                            </div>

                                            <div style="color: #d92d20; font-size: 16px; font-weight: 800;">
                                                Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                            </div>

                                            <div style="margin-top: 4px; color: #168348; font-size: 11px;">
                                                Hemat Rp {{ number_format($nilaiDiskon, 0, ',', '.') }}
                                            </div>
                                        @else
                                            Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                                        @endif
                                    </div>


                                </div>

                            </div>


                            {{-- JUMLAH --}}
                            <div class="quantity-box">

                                <label for="jumlah" class="checkout-label">
                                    Jumlah Pesanan
                                </label>

                                <input type="number" name="jumlah" id="jumlah" class="quantity-input" value="1"
                                    min="1" max="{{ $produk->stok }}" required>

                                <div class="quantity-help">

                                    Stok tersedia:
                                    {{ $produk->stok }}
                                    {{ $produk->satuan }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="checkout-divider">


                    {{-- =================================================
                     DATA PELANGGAN
                ================================================== --}}

                    <div class="checkout-section">

                        <h2 class="checkout-section-title">
                            Data Pelanggan
                        </h2>


                        <div class="customer-grid">

                            {{-- NAMA --}}
                            <div class="customer-field">

                                <label class="checkout-label">
                                    Nama
                                </label>

                                <input type="text" class="customer-input" value="{{ Auth::user()->nama }}" readonly>

                            </div>


                            {{-- USERNAME --}}
                            <div class="customer-field">

                                <label class="checkout-label">
                                    Username
                                </label>

                                <input type="text" class="customer-input" value="{{ Auth::user()->username }}" readonly>

                            </div>


                            @if (Auth::user()->pelanggan)
                                {{-- NOMOR HP --}}
                                <div class="customer-field">

                                    <label class="checkout-label">
                                        Nomor HP
                                    </label>

                                    <input type="text" class="customer-input"
                                        value="{{ Auth::user()->pelanggan->no_hp }}" readonly>

                                </div>


                                {{-- EMAIL --}}
                                <div class="customer-field">

                                    <label class="checkout-label">
                                        Email
                                    </label>

                                    <input type="text" class="customer-input"
                                        value="{{ Auth::user()->pelanggan->email }}" readonly>

                                </div>


                                {{-- ALAMAT --}}
                                <div class="customer-field full">

                                    <label class="checkout-label">
                                        Alamat
                                    </label>

                                    <textarea class="customer-textarea" readonly>{{ Auth::user()->pelanggan->alamat }}</textarea>

                                </div>
                            @endif

                        </div>

                    </div>


                    <hr class="checkout-divider">


                    {{-- =================================================
                     METODE PEMBAYARAN
                ================================================== --}}

                    <div class="checkout-section">

                        <h2 class="checkout-section-title">
                            Metode Pembayaran
                        </h2>


                        <div class="payment-grid">

                            {{-- COD --}}
                            <label for="cod" class="payment-option">

                                <input type="radio" name="metode_pembayaran" id="cod" value="cod" checked
                                    required>

                                <div class="payment-card">

                                    <div class="payment-top">

                                        <span class="payment-radio"></span>

                                        <span class="payment-name">
                                            COD
                                        </span>

                                    </div>

                                    <div class="payment-description">
                                        Bayar saat barang diterima.
                                    </div>

                                </div>

                            </label>


                            {{-- QRIS --}}
                            <label for="qris" class="payment-option">

                                <input type="radio" name="metode_pembayaran" id="qris" value="qris" required>

                                <div class="payment-card">

                                    <div class="payment-top">

                                        <span class="payment-radio"></span>

                                        <span class="payment-name">
                                            QRIS
                                        </span>

                                    </div>

                                    <div class="payment-description">
                                        Bayar menggunakan QRIS.
                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>


                    {{-- TOMBOL --}}
                    <div class="checkout-actions">

                        <button type="submit" class="checkout-submit">
                            Lanjutkan
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection
