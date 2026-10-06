@extends('layouts.pelanggan')

@section('title', 'Pembayaran')

@section('content')

<style>
    /* =====================================================
       PEMBAYARAN
    ===================================================== */

    .payment-page {
        width: 100%;
        max-width: 1050px;
        margin: 0 auto;
        padding: 10px 0 50px;
    }

    /* =====================================================
       HEADER
    ===================================================== */

    .payment-header {
        margin-bottom: 25px;
    }

    .payment-header h1 {
        margin: 0 0 6px;
        color: #222;
        font-size: 28px;
        font-weight: 750;
    }

    .payment-header p {
        margin: 0;
        color: #888;
        font-size: 13px;
    }

    /* =====================================================
       MAIN CARD
    ===================================================== */

    .payment-card {
        background: #fff;
        border: 1px solid #eeeeee;
        border-radius: 14px;
        overflow: hidden;
    }

    .payment-card-body {
        padding: 28px;
    }

    /* =====================================================
       SECTION TITLE
    ===================================================== */

    .payment-section-title {
        margin: 0 0 18px;
        color: #222;
        font-size: 16px;
        font-weight: 700;
    }

    /* =====================================================
       PRODUCT SUMMARY
    ===================================================== */

    .order-summary {
        background: #fafafa;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        overflow: hidden;
    }

    .summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 50px;
        padding: 0 16px;
        border-bottom: 1px solid #eeeeee;
        font-size: 13px;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-label {
        color: #999;
    }

    .summary-value {
        color: #333;
        font-weight: 600;
        text-align: right;
    }

    .summary-total {
        background: #fffaf0;
        border-top: 1px solid #f3d889;
    }

    .summary-total .summary-label {
        color: #444;
        font-weight: 700;
    }

    .summary-total .summary-value {
        color: #222;
        font-size: 19px;
        font-weight: 800;
    }

    /* =====================================================
       PAYMENT METHOD
    ===================================================== */

    .selected-payment {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 17px;
        background: #fffaf0;
        border: 1px solid #f0cf6b;
        border-radius: 10px;
    }

    .payment-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f6c344;
        border-radius: 8px;
        color: #222;
        font-size: 16px;
        font-weight: 700;
    }

    .payment-method-name {
        margin-bottom: 4px;
        color: #333;
        font-size: 14px;
        font-weight: 700;
    }

    .payment-method-description {
        color: #888;
        font-size: 12px;
        line-height: 1.5;
    }

    /* =====================================================
       QRIS
    ===================================================== */

    .qris-section {
        margin-top: 20px;
        padding: 20px;
        background: #fafafa;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        text-align: center;
    }

    .qris-title {
        margin-bottom: 15px;
        color: #444;
        font-size: 13px;
        font-weight: 700;
    }

    .qris-placeholder {
        width: 250px;
        height: 250px;
        margin: 0 auto;
        background: #fff;
        border: 1px dashed #d8d8d8;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .qris-placeholder span {
        color: #999;
        font-size: 12px;
        line-height: 1.5;
    }

    /* =====================================================
       DIVIDER
    ===================================================== */

    .payment-divider {
        height: 1px;
        margin: 28px 0;
        background: #eeeeee;
        border: none;
    }

    /* =====================================================
       CONFIRMATION
    ===================================================== */

    .confirmation-box {
        margin-bottom: 20px;
        padding: 13px 15px;
        background: #f8f8f8;
        border: 1px solid #eeeeee;
        border-radius: 8px;
        color: #777;
        font-size: 12px;
        line-height: 1.6;
    }

    /* =====================================================
       BUTTON
    ===================================================== */

    .payment-action {
        display: flex;
        justify-content: flex-end;
        margin-top: 22px;
        padding-top: 22px;
        border-top: 1px solid #eeeeee;
    }

    .confirm-button {
        min-width: 175px;
        height: 45px;
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

    .confirm-button:hover {
        background: #eab52f;
        border-color: #eab52f;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.09);
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 900px) {

        .payment-page {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media (max-width: 600px) {

        .payment-page {
            padding: 5px 15px 35px;
        }

        .payment-header h1 {
            font-size: 24px;
        }

        .payment-card-body {
            padding: 20px;
        }

        .summary-row {
            min-height: 48px;
            padding: 0 12px;
            font-size: 12px;
        }

        .summary-total .summary-value {
            font-size: 17px;
        }

        .selected-payment {
            padding: 14px;
        }

        .qris-placeholder {
            width: 210px;
            height: 210px;
        }

        .payment-action {
            justify-content: stretch;
        }

        .confirm-button {
            width: 100%;
        }
    }
</style>


<div class="payment-page">

    {{-- HEADER --}}
    <div class="payment-header">

        <h1>
            Pembayaran
        </h1>

        <p>
            Periksa kembali pesanan dan metode pembayaran Anda.
        </p>

    </div>


    {{-- MAIN CARD --}}
    <div class="payment-card">

        <div class="payment-card-body">


            {{-- =================================================
                 RINGKASAN PESANAN
            ================================================== --}}

            <div>

                <h2 class="payment-section-title">
                    Ringkasan Pesanan
                </h2>


                <div class="order-summary">

                    {{-- PRODUK --}}
                    <div class="summary-row">

                        <span class="summary-label">
                            Produk
                        </span>

                        <span class="summary-value">
                            {{ $produk->nama_produk }}
                        </span>

                    </div>


                    {{-- JUMLAH --}}
                    <div class="summary-row">

                        <span class="summary-label">
                            Jumlah
                        </span>

                        <span class="summary-value">
                            {{ $jumlah }} {{ $produk->satuan }}
                        </span>

                    </div>


                    {{-- HARGA --}}
                    <div class="summary-row">

                        <span class="summary-label">
                            Harga
                        </span>

                        <span class="summary-value">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </span>

                    </div>


                    {{-- TOTAL --}}
                    <div class="summary-row summary-total">

                        <span class="summary-label">
                            Total Pembayaran
                        </span>

                        <span class="summary-value">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

            </div>


            <hr class="payment-divider">


            {{-- =================================================
                 METODE PEMBAYARAN
            ================================================== --}}

            <div>

                <h2 class="payment-section-title">
                    Metode Pembayaran
                </h2>


                @if ($metodePembayaran === 'cod')

                    <div class="selected-payment">

                        <div class="payment-icon">
                            💵
                        </div>

                        <div>

                            <div class="payment-method-name">
                                COD
                            </div>

                            <div class="payment-method-description">
                                Pembayaran dilakukan saat barang diterima.
                            </div>

                        </div>

                    </div>


                @elseif ($metodePembayaran === 'qris')

                    <div class="selected-payment">

                        <div class="payment-icon">
                            QR
                        </div>

                        <div>

                            <div class="payment-method-name">
                                QRIS
                            </div>

                            <div class="payment-method-description">
                                Silakan lakukan pembayaran menggunakan QRIS.
                            </div>

                        </div>

                    </div>


                    {{-- QRIS --}}
                    <div class="qris-section">

                        <div class="qris-title">
                            QRIS Toko
                        </div>


                        <div class="qris-placeholder">

                            <span>
                                QRIS akan ditempatkan di sini
                            </span>

                        </div>

                    </div>

                @endif

            </div>


            <div class="confirmation-box">

                Pastikan produk, jumlah pesanan, dan metode pembayaran
                sudah sesuai sebelum melakukan konfirmasi pesanan.

            </div>


            {{-- =================================================
                 FORM KONFIRMASI
            ================================================== --}}

            <form
                action="{{ route('pelanggan.pesanan.store') }}"
                method="POST"
            >

                @csrf

                <input
                    type="hidden"
                    name="id_produk"
                    value="{{ $produk->id_produk }}"
                >

                <input
                    type="hidden"
                    name="jumlah"
                    value="{{ $jumlah }}"
                >

                <input
                    type="hidden"
                    name="metode_pembayaran"
                    value="{{ $metodePembayaran }}"
                >


                <div class="payment-action">

                    <button
                        type="submit"
                        class="confirm-button"
                    >
                        Konfirmasi Pesanan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection