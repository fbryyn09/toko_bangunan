@extends('layouts.pelanggan')

@section('title', 'Struk Pesanan')

@section('content')

<div class="receipt-page">

    {{-- TOMBOL AKSI --}}
    <div class="receipt-actions">
        <a href="{{ route('pelanggan.detail-pesanan', $pesanan->id_pesanan) }}"
           class="receipt-btn btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Detail
        </a>

        {{-- <a href="{{ route('pelanggan.struk-pesanan.pdf', $pesanan->id_pesanan) }}"
           class="receipt-btn btn-pdf">
            <i class="bi bi-file-earmark-pdf"></i>
            Download PDF
        </a> --}}

        <button type="button" onclick="window.print()"
                class="receipt-btn btn-print">
            <i class="bi bi-printer"></i>
            Cetak Struk
        </button>
    </div>

    {{-- AREA STRUK --}}
    <div class="receipt">

        {{-- HEADER TOKO --}}
        <div class="receipt-header">

            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt="Logo Toko Bintang Emas Mandiri"
                class="receipt-logo"
            >

            <h1>TOKO BANGUNAN</h1>
            <h2>BINTANG EMAS MANDIRI</h2>

            <div class="header-line"></div>

            <p class="receipt-label">STRUK PEMESANAN</p>
        </div>

        {{-- INFORMASI PESANAN --}}
        <div class="receipt-section">

            <div class="section-heading">
                <i class="bi bi-receipt"></i>
                Informasi Pesanan
            </div>

            <div class="receipt-info">

                <div class="info-item">
                    <span>Nomor Pesanan</span>
                    <strong>{{ $pesanan->id_pesanan }}</strong>
                </div>

                <div class="info-item">
                    <span>Tanggal Pesanan</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d-m-Y H:i') }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Nama Pelanggan</span>
                    <strong>
                        {{ optional(optional($pesanan->pelanggan)->user)->nama ?? '-' }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Metode Pembayaran</span>
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

                <div class="info-item">
                    <span>Status Pesanan</span>
                    <strong class="status-text">
                        {{ ucfirst($pesanan->status_pesanan) }}
                    </strong>
                </div>

            </div>
        </div>

        {{-- RINCIAN PRODUK --}}
        <div class="receipt-section">

            <div class="section-heading">
                <i class="bi bi-box-seam"></i>
                Rincian Produk
            </div>

            <div class="receipt-table-wrapper">
                <table class="receipt-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pesanan->detailPesanan as $detail)
                            <tr>
                                <td class="product-name">
                                    {{ $detail->produk->nama_produk ?? 'Produk tidak tersedia' }}
                                </td>

                                <td>
                                    {{ $detail->jumlah }}
                                    {{ $detail->produk->satuan ?? '' }}
                                </td>

                                <td class="money">
                                    Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                </td>

                                <td class="money">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        {{-- TOTAL PEMBAYARAN --}}
        <div class="receipt-total">
            <div>
                <span class="total-label">TOTAL PESANAN</span>
                <small>Jumlah keseluruhan pesanan</small>
            </div>

            <strong>
                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
            </strong>
        </div>

        {{-- CATATAN --}}
        <div class="receipt-note">
            <div class="note-icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <p>Terima kasih telah berbelanja!</p>

            <small>
                Toko Bangunan Bintang Emas Mandiri<br>
                Simpan struk ini sebagai bukti pemesanan.
            </small>
        </div>

        <div class="receipt-bottom-line"></div>

    </div>
</div>

<style>
    .receipt-page {
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
        padding: 15px 20px 50px;
        color: #252525;
    }

    /* TOMBOL AKSI */
    .receipt-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 22px;
    }

    .receipt-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 0 17px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .btn-back {
        background: #fff;
        color: #444;
    }

    .btn-back:hover {
        background: #f7f7f7;
        color: #222;
    }

    .btn-pdf,
    .btn-print {
        background: #f1f000;
        border-color: #e1df00;
        color: #222;
    }

    .btn-pdf:hover,
    .btn-print:hover {
        background: #dedc00;
        color: #222;
    }

    /* KERTAS STRUK */
    .receipt {
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8e5dc;
        border-radius: 14px;
        padding: 42px 40px 30px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .045);
    }

    /* HEADER */
    .receipt-header {
        text-align: center;
        padding-bottom: 22px;
    }

    .receipt-logo {
        display: block;
        width: 105px;
        height: 105px;
        object-fit: contain;
        margin: 0 auto 12px;
    }

    .receipt-header h1 {
        margin: 0;
        color: #777;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 3px;
    }

    .receipt-header h2 {
        margin: 5px 0 0;
        color: #222;
        font-size: 25px;
        font-weight: 900;
        letter-spacing: .5px;
    }

    .header-line {
        width: 65px;
        height: 4px;
        margin: 15px auto;
        border-radius: 10px;
        background: #f1e900;
    }

    .receipt-label {
        margin: 0;
        color: #777;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 3px;
    }

    /* BAGIAN STRUK */
    .receipt-section {
        margin-top: 22px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 9px;
        padding-bottom: 13px;
        border-bottom: 1px solid #eeeae0;
        color: #282828;
        font-size: 14px;
        font-weight: 800;
    }

    .section-heading i {
        color: #a18c00;
        font-size: 17px;
    }

    /* INFORMASI PESANAN */
    .receipt-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px 30px;
        padding: 22px 0 5px;
    }

    .info-item {
        min-width: 0;
    }

    .info-item span {
        display: block;
        margin-bottom: 6px;
        color: #888;
        font-size: 11px;
    }

    .info-item strong {
        display: block;
        overflow-wrap: anywhere;
        color: #292929;
        font-size: 13px;
        font-weight: 700;
    }

    .status-text {
        text-transform: capitalize;
    }

    /* TABEL PRODUK */
    .receipt-table-wrapper {
        width: 100%;
        margin-top: 15px;
    }

    .receipt-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .receipt-table thead {
        background: #fffbea;
    }

    .receipt-table th {
        padding: 13px 10px;
        border-bottom: 1px solid #e9e2c8;
        color: #4a442c;
        font-size: 11px;
        font-weight: 800;
        text-align: left;
    }

    .receipt-table td {
        padding: 15px 10px;
        border-bottom: 1px solid #f0eee8;
        color: #555;
        vertical-align: top;
    }

    .receipt-table .product-name {
        color: #292929;
        font-weight: 700;
    }

    .receipt-table .money {
        white-space: nowrap;
    }

    /* TOTAL */
    .receipt-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-top: 25px;
        padding: 22px;
        border: 1px solid #f0e7b8;
        border-radius: 10px;
        background: #fffdf3;
    }

    .total-label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .7px;
    }

    .receipt-total small {
        display: block;
        color: #888;
        font-size: 11px;
    }

    .receipt-total strong {
        color: #222;
        font-size: 21px;
        font-weight: 900;
        text-align: right;
        overflow-wrap: anywhere;
    }

    /* FOOTER */
    .receipt-note {
        margin-top: 35px;
        text-align: center;
    }

    .note-icon {
        margin-bottom: 8px;
        color: #a18c00;
        font-size: 23px;
    }

    .receipt-note p {
        margin: 0 0 7px;
        color: #333;
        font-size: 14px;
        font-weight: 800;
    }

    .receipt-note small {
        color: #888;
        font-size: 11px;
        line-height: 1.8;
    }

    .receipt-bottom-line {
        width: 100%;
        height: 4px;
        margin-top: 28px;
        border-radius: 10px;
        background: #f1e900;
    }

    /* RESPONSIVE */
    @media (max-width: 600px) {
        .receipt-page {
            padding: 10px 0 30px;
        }

        .receipt-actions {
            justify-content: flex-start;
        }

        .receipt-btn {
            padding: 0 12px;
            font-size: 12px;
        }

        .receipt {
            padding: 28px 16px 22px;
            border-radius: 10px;
        }

        .receipt-logo {
            width: 85px;
            height: 85px;
        }

        .receipt-header h2 {
            font-size: 20px;
        }

        .receipt-info {
            grid-template-columns: 1fr;
            gap: 17px;
        }

        .receipt-table-wrapper {
            overflow-x: auto;
        }

        .receipt-table {
            min-width: 530px;
        }

        .receipt-total {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
            padding: 17px;
        }

        .receipt-total strong {
            font-size: 20px;
            text-align: left;
        }
    }

    /* CETAK */
    @media print {
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        body * {
            visibility: hidden !important;
        }

        .receipt,
        .receipt * {
            visibility: visible !important;
        }

        .receipt-page {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 0;
        }

        .receipt-actions {
            display: none !important;
        }

        .receipt {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            box-sizing: border-box;
            overflow: visible;
            margin: 0;
            padding: 0;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }

        .receipt-logo {
            width: 80px;
            height: 80px;
        }

        .receipt-header {
            padding-bottom: 12px;
        }

        .receipt-section {
            margin-top: 16px;
        }

        .receipt-info {
            gap: 14px 25px;
        }

        .receipt-table-wrapper {
            overflow: visible;
        }

        .receipt-table {
            min-width: 0;
            font-size: 10px;
        }

        .receipt-table th,
        .receipt-table td {
            padding: 8px 6px;
        }

        .receipt-total {
            padding: 15px;
            break-inside: avoid;
        }

        .receipt-note {
            margin-top: 25px;
        }

        .receipt-bottom-line {
            margin-top: 20px;
        }
    }
</style>

@endsection