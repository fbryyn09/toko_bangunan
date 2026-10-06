@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')

<style>
    /* =========================================
       HEADER
    ========================================= */

    .pesanan-header {
        margin-bottom: 24px;
    }

    .pesanan-header h1 {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #222;
    }

    .pesanan-header p {
        margin: 6px 0 0;
        color: #888;
        font-size: 14px;
    }


    /* =========================================
       STATISTIK
    ========================================= */

    .pesanan-stat-card {
        background: #fff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        padding: 18px 20px;
        height: 100%;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.025);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .pesanan-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #fff5d8;
        color: #d49e16;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .pesanan-stat-icon.menunggu {
        background: #fff7df;
        color: #a77908;
    }

    .pesanan-stat-icon.diproses {
        background: #eef5ff;
        color: #3478c9;
    }

    .pesanan-stat-icon.selesai {
        background: #eaf8ef;
        color: #208045;
    }

    .pesanan-stat-label {
        color: #888;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .pesanan-stat-value {
        color: #222;
        font-size: 21px;
        font-weight: 700;
    }

    .pesanan-stat-value.menunggu {
        color: #a77908;
    }

    .pesanan-stat-value.diproses {
        color: #3478c9;
    }

    .pesanan-stat-value.selesai {
        color: #208045;
    }


    /* =========================================
       ALERT
    ========================================= */

    .pesanan-alert {
        padding: 12px 16px;
        margin-bottom: 20px;
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        font-size: 13px;
    }


    /* =========================================
       CARD TABEL
    ========================================= */

    .pesanan-table-card {
        background: #fff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.025);
    }

    .pesanan-table-header {
        padding: 18px 20px;
        border-bottom: 1px solid #eeeeee;
        background: #fff;
    }

    .pesanan-table-header h5 {
        margin: 0 0 4px;
        color: #222;
        font-size: 15px;
        font-weight: 700;
    }

    .pesanan-table-header p {
        margin: 0;
        color: #999;
        font-size: 12px;
    }


    /* =========================================
       TABLE
    ========================================= */

    .pesanan-table-wrapper {
        overflow-x: auto;
    }

    .pesanan-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .pesanan-table th,
    .pesanan-table td {
        padding: 15px 16px;
        border-bottom: 1px solid #eeeeee;
        vertical-align: middle;
        text-align: left;
    }

    .pesanan-table th {
        background: #fafafa;
        color: #555;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .pesanan-table td {
        color: #555;
        font-size: 13px;
    }

    .pesanan-table tbody tr {
        transition: 0.15s ease;
    }

    .pesanan-table tbody tr:hover {
        background: #fffdf6;
    }

    .pesanan-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================
       PESANAN
    ========================================= */

    .pesanan-id {
        color: #222;
        font-size: 13px;
        font-weight: 700;
    }

    .pesanan-produk-count {
        color: #999;
        font-size: 11px;
        margin-top: 3px;
    }


    /* =========================================
       PELANGGAN
    ========================================= */

    .pelanggan-nama {
        color: #333;
        font-size: 13px;
        font-weight: 700;
    }

    .pelanggan-hp {
        color: #999;
        font-size: 11px;
        margin-top: 3px;
    }


    /* =========================================
       TANGGAL
    ========================================= */

    .tanggal-pesanan {
        color: #444;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .jam-pesanan {
        color: #999;
        font-size: 11px;
        margin-top: 3px;
    }


    /* =========================================
       TOTAL
    ========================================= */

    .total-pesanan {
        color: #222;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================
       PEMBAYARAN
    ========================================= */

    .pembayaran-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 7px;
        background: #f5f5f5;
        color: #555;
        border: 1px solid #e1e1e1;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================
       STATUS
    ========================================= */

    .status-pesanan {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff7df;
        color: #a77908;
        border: 1px solid #f0d78b;
    }

    .status-diproses {
        background: #eef5ff;
        color: #3478c9;
        border: 1px solid #cbdff7;
    }

    .status-selesai {
        background: #eaf8ef;
        color: #208045;
        border: 1px solid #ccebd8;
    }

    .status-dibatalkan {
        background: #fff0f0;
        color: #bd3939;
        border: 1px solid #f0cccc;
    }

    .status-lain {
        background: #f1f1f1;
        color: #777;
        border: 1px solid #dedede;
    }


    /* =========================================
       BUTTON DETAIL
    ========================================= */

    .btn-detail-pesanan {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 34px;
        padding: 0 12px;
        border-radius: 7px;
        background: #fff7df;
        color: #a77908;
        border: 1px solid #f0d78b;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .btn-detail-pesanan:hover {
        background: #f6c344;
        color: #222;
        border-color: #f6c344;
    }


    /* =========================================
       EMPTY STATE
    ========================================= */

    .pesanan-empty {
        text-align: center;
        padding: 55px 20px;
    }

    .pesanan-empty-icon {
        width: 55px;
        height: 55px;
        margin: 0 auto 14px;
        border-radius: 12px;
        background: #fff5d8;
        color: #d49e16;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        font-weight: 700;
    }

    .pesanan-empty h6 {
        margin: 0 0 5px;
        color: #444;
        font-weight: 700;
    }

    .pesanan-empty p {
        margin: 0;
        color: #999;
        font-size: 13px;
    }


    /* =========================================
       MODAL
    ========================================= */

    .pesanan-modal .modal-content {
        border: none;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
    }

    .pesanan-modal .modal-header {
        padding: 18px 22px;
        border-bottom: 1px solid #eeeeee;
        background: #fff;
    }

    .pesanan-modal .modal-title {
        color: #222;
        font-size: 17px;
        font-weight: 700;
    }

    .pesanan-modal-subtitle {
        display: block;
        margin-top: 3px;
        color: #999;
        font-size: 11px;
    }

    .pesanan-modal .modal-body {
        padding: 22px;
    }

    .pesanan-modal .modal-footer {
        padding: 15px 22px;
        border-top: 1px solid #eeeeee;
        background: #fafafa;
    }


    /* =========================================
       INFORMASI PELANGGAN
    ========================================= */

    .pelanggan-info-card {
        padding: 17px;
        margin-bottom: 22px;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        background: #fafafa;
    }

    .pelanggan-info-title {
        color: #333;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .info-label {
        color: #999;
        font-size: 11px;
        margin-bottom: 3px;
    }

    .info-value {
        color: #444;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.5;
    }


    /* =========================================
       PRODUK DETAIL
    ========================================= */

    .detail-section-title {
        color: #333;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .detail-produk-wrapper {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        overflow: hidden;
    }

    .detail-produk-item {
        padding: 12px;
        border-bottom: 1px solid #eeeeee;
    }

    .detail-produk-item:last-child {
        border-bottom: none;
    }

    .detail-produk-item:hover {
        background: #fffdf6;
    }

    .detail-produk-image {
        width: 62px;
        height: 62px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #eeeeee;
        flex-shrink: 0;
    }

    .detail-produk-no-image {
        width: 62px;
        height: 62px;
        border-radius: 8px;
        border: 1px solid #eeeeee;
        background: #f7f7f7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-size: 10px;
        flex-shrink: 0;
    }

    .detail-produk-name {
        color: #333;
        font-size: 13px;
        font-weight: 700;
    }

    .detail-produk-id {
        color: #999;
        font-size: 10px;
        margin-top: 2px;
    }

    .detail-produk-price {
        color: #999;
        font-size: 11px;
        margin-top: 4px;
    }

    .detail-subtotal-label {
        color: #999;
        font-size: 10px;
    }

    .detail-subtotal {
        color: #333;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================
       TOTAL & CATATAN
    ========================================= */

    .detail-total {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #eeeeee;
    }

    .detail-total-label {
        color: #444;
        font-size: 13px;
        font-weight: 700;
    }

    .detail-total-value {
        color: #222;
        font-size: 18px;
        font-weight: 700;
    }

    .catatan-wrapper {
        margin-top: 20px;
    }

    .catatan-label {
        color: #999;
        font-size: 11px;
        margin-bottom: 6px;
    }

    .catatan-box {
        padding: 12px;
        border: 1px solid #eeeeee;
        border-radius: 8px;
        background: #fafafa;
        color: #555;
        font-size: 12px;
        line-height: 1.6;
    }


    /* =========================================
       STATUS FORM
    ========================================= */

    .status-form {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .status-form label {
        color: #777;
        font-size: 12px;
        margin: 0;
        white-space: nowrap;
    }

    .status-form select {
        width: 145px;
        border: 1px solid #dcdcdc;
        border-radius: 7px;
        padding: 7px 10px;
        color: #444;
        font-size: 12px;
        outline: none;
    }

    .status-form select:focus {
        border-color: #f0c23e;
        box-shadow: 0 0 0 3px rgba(246, 195, 68, 0.13);
    }

    .btn-simpan-status {
        padding: 8px 13px;
        border: none;
        border-radius: 7px;
        background: #f6c344;
        color: #222;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-simpan-status:hover {
        background: #eab52f;
    }

    .btn-tutup-modal {
        padding: 8px 14px;
        border: 1px solid #d8d8d8;
        border-radius: 7px;
        background: #fff;
        color: #555;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-tutup-modal:hover {
        background: #f2f2f2;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 768px) {

        .pesanan-modal .modal-body {
            padding: 18px;
        }

        .pesanan-modal .modal-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .status-form {
            width: 100%;
            flex-wrap: wrap;
        }

        .status-form select {
            flex: 1;
            width: auto;
        }

        .btn-simpan-status,
        .btn-tutup-modal {
            width: 100%;
        }

        .detail-total-value {
            font-size: 16px;
        }
    }
</style>


<div class="container-fluid px-0">


    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="pesanan-header">

        <h1>
            Data Pesanan
        </h1>

        <p>
            Kelola pesanan pelanggan toko bangunan.
        </p>

    </div>


    {{-- =========================================================
         STATISTIK
    ========================================================= --}}

    <div class="row g-3 mb-4">


        {{-- TOTAL --}}

        <div class="col-md-3">

            <div class="pesanan-stat-card">

                <div class="pesanan-stat-icon">
                    #
                </div>

                <div>

                    <div class="pesanan-stat-label">
                        Total Pesanan
                    </div>

                    <div class="pesanan-stat-value">
                        {{ $pesanan->count() }}
                    </div>

                </div>

            </div>

        </div>


        {{-- MENUNGGU --}}

        <div class="col-md-3">

            <div class="pesanan-stat-card">

                <div class="pesanan-stat-icon menunggu">
                    !
                </div>

                <div>

                    <div class="pesanan-stat-label">
                        Menunggu
                    </div>

                    <div class="pesanan-stat-value menunggu">
                        {{ $pesanan->where('status_pesanan', 'menunggu')->count() }}
                    </div>

                </div>

            </div>

        </div>


        {{-- DIPROSES --}}

        <div class="col-md-3">

            <div class="pesanan-stat-card">

                <div class="pesanan-stat-icon diproses">
                    ↻
                </div>

                <div>

                    <div class="pesanan-stat-label">
                        Diproses
                    </div>

                    <div class="pesanan-stat-value diproses">
                        {{ $pesanan->where('status_pesanan', 'diproses')->count() }}
                    </div>

                </div>

            </div>

        </div>


        {{-- SELESAI --}}

        <div class="col-md-3">

            <div class="pesanan-stat-card">

                <div class="pesanan-stat-icon selesai">
                    ✓
                </div>

                <div>

                    <div class="pesanan-stat-label">
                        Selesai
                    </div>

                    <div class="pesanan-stat-value selesai">
                        {{ $pesanan->where('status_pesanan', 'selesai')->count() }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ALERT
    ========================================================= --}}

    @if (session('success'))

        <div class="pesanan-alert">
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================================================
         TABEL PESANAN
    ========================================================= --}}

    <div class="pesanan-table-card">


        <div class="pesanan-table-header">

            <h5>
                Daftar Pesanan
            </h5>

            <p>
                Data pesanan pelanggan
            </p>

        </div>


        @if ($pesanan->count() == 0)

            {{-- DATA KOSONG --}}

            <div class="pesanan-empty">

                <div class="pesanan-empty-icon">
                    #
                </div>

                <h6>
                    Belum ada pesanan
                </h6>

                <p>
                    Belum terdapat pesanan dari pelanggan.
                </p>

            </div>

        @else

            <div class="pesanan-table-wrapper">

                <table class="pesanan-table">

                    <thead>

                        <tr>

                            <th>
                                Pesanan
                            </th>

                            <th>
                                Pelanggan
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Pembayaran
                            </th>

                            <th>
                                Status
                            </th>

                            <th style="text-align: center;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($pesanan as $item)

                            <tr>


                                {{-- PESANAN --}}

                                <td>

                                    <div class="pesanan-id">
                                        {{ $item->id_pesanan }}
                                    </div>

                                    <div class="pesanan-produk-count">
                                        {{ $item->detailPesanan->count() }} produk
                                    </div>

                                </td>


                                {{-- PELANGGAN --}}

                                <td>

                                    @if ($item->pelanggan && $item->pelanggan->user)

                                        <div class="pelanggan-nama">
                                            {{ $item->pelanggan->user->nama }}
                                        </div>

                                        <div class="pelanggan-hp">
                                            {{ $item->pelanggan->no_hp ?? '-' }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    @if ($item->tanggal_pesanan)

                                        <div class="tanggal-pesanan">
                                            {{ $item->tanggal_pesanan->format('d M Y') }}
                                        </div>

                                        <div class="jam-pesanan">
                                            {{ $item->tanggal_pesanan->format('H:i') }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- TOTAL --}}

                                <td>

                                    <span class="total-pesanan">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- PEMBAYARAN --}}

                                <td>

                                    @if ($item->metode_pembayaran == 'cod')

                                        <span class="pembayaran-badge">
                                            COD
                                        </span>

                                    @elseif ($item->metode_pembayaran == 'qris')

                                        <span class="pembayaran-badge">
                                            QRIS
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            {{ $item->metode_pembayaran ?? '-' }}
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if ($item->status_pesanan == 'menunggu')

                                        <span class="status-pesanan status-menunggu">
                                            Menunggu
                                        </span>

                                    @elseif ($item->status_pesanan == 'diproses')

                                        <span class="status-pesanan status-diproses">
                                            Diproses
                                        </span>

                                    @elseif ($item->status_pesanan == 'selesai')

                                        <span class="status-pesanan status-selesai">
                                            Selesai
                                        </span>

                                    @elseif ($item->status_pesanan == 'dibatalkan')

                                        <span class="status-pesanan status-dibatalkan">
                                            Dibatalkan
                                        </span>

                                    @else

                                        <span class="status-pesanan status-lain">
                                            {{ $item->status_pesanan }}
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="d-flex justify-content-center">

                                        <button
                                            type="button"
                                            class="btn-detail-pesanan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $item->id_pesanan }}"
                                        >
                                            Lihat Detail
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>



{{-- =============================================================
     MODAL DETAIL PESANAN
============================================================= --}}

@foreach ($pesanan as $item)

    <div
        class="modal fade pesanan-modal"
        id="modalDetail{{ $item->id_pesanan }}"
        tabindex="-1"
        aria-labelledby="modalDetailLabel{{ $item->id_pesanan }}"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="modalDetailLabel{{ $item->id_pesanan }}"
                        >
                            Detail Pesanan
                        </h5>

                        <span class="pesanan-modal-subtitle">
                            {{ $item->id_pesanan }}
                        </span>

                    </div>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                    </button>

                </div>


                {{-- BODY --}}

                <div class="modal-body">


                    {{-- INFORMASI PELANGGAN --}}

                    <div class="pelanggan-info-card">

                        <div class="pelanggan-info-title">
                            Informasi Pelanggan
                        </div>


                        <div class="row g-3">


                            {{-- NAMA --}}

                            <div class="col-md-6">

                                <div class="info-label">
                                    Nama
                                </div>

                                <div class="info-value">

                                    @if ($item->pelanggan && $item->pelanggan->user)

                                        {{ $item->pelanggan->user->nama }}

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>


                            {{-- NO HP --}}

                            <div class="col-md-6">

                                <div class="info-label">
                                    No. HP
                                </div>

                                <div class="info-value">
                                    {{ $item->pelanggan->no_hp ?? '-' }}
                                </div>

                            </div>


                            {{-- EMAIL --}}

                            <div class="col-md-6">

                                <div class="info-label">
                                    Email
                                </div>

                                <div class="info-value">
                                    {{ $item->pelanggan->email ?? '-' }}
                                </div>

                            </div>


                            {{-- ALAMAT --}}

                            <div class="col-md-6">

                                <div class="info-label">
                                    Alamat
                                </div>

                                <div class="info-value">
                                    {{ $item->pelanggan->alamat ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PRODUK PESANAN --}}

                    <div class="detail-section-title">
                        Produk Pesanan
                    </div>


                    @if ($item->detailPesanan->count() > 0)

                        <div class="detail-produk-wrapper">

                            @foreach ($item->detailPesanan as $detail)

                                <div class="detail-produk-item">

                                    <div class="d-flex align-items-center">


                                        {{-- GAMBAR --}}

                                        @if ($detail->produk && $detail->produk->gambar)

                                            <img
                                                src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                alt="{{ $detail->produk->nama_produk }}"
                                                class="detail-produk-image me-3"
                                            >

                                        @else

                                            <div class="detail-produk-no-image me-3">
                                                Tidak ada
                                            </div>

                                        @endif


                                        {{-- INFORMASI --}}

                                        <div class="flex-grow-1">

                                            @if ($detail->produk)

                                                <div class="detail-produk-name">
                                                    {{ $detail->produk->nama_produk }}
                                                </div>

                                                <div class="detail-produk-id">
                                                    {{ $detail->produk->id_produk }}
                                                </div>

                                            @else

                                                <div class="detail-produk-name">
                                                    Produk tidak ditemukan
                                                </div>

                                            @endif


                                            <div class="detail-produk-price">

                                                {{ $detail->jumlah }}
                                                {{ $detail->produk->satuan ?? 'produk' }}

                                                ×

                                                Rp {{ number_format($detail->harga, 0, ',', '.') }}

                                            </div>

                                        </div>


                                        {{-- SUBTOTAL --}}

                                        <div class="text-end">

                                            <div class="detail-subtotal-label">
                                                Subtotal
                                            </div>

                                            <div class="detail-subtotal">
                                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="text-center text-muted py-4 border rounded">
                            Belum ada detail produk.
                        </div>

                    @endif


                    {{-- TOTAL --}}

                    <div class="detail-total">

                        <span class="detail-total-label">
                            Total Pesanan
                        </span>

                        <span class="detail-total-value">
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </span>

                    </div>


                    {{-- CATATAN --}}

                    @if ($item->catatan)

                        <div class="catatan-wrapper">

                            <div class="catatan-label">
                                Catatan Pelanggan
                            </div>

                            <div class="catatan-box">
                                {{ $item->catatan }}
                            </div>

                        </div>

                    @endif

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">


                    {{-- UPDATE STATUS --}}

                    <form
                        action="{{ route('admin.pesanan.update', $item->id_pesanan) }}"
                        method="POST"
                        class="status-form"
                    >

                        @csrf

                        @method('PUT')


                        <label>
                            Status:
                        </label>


                        <select
                            name="status_pesanan"
                            required
                        >

                            <option
                                value="menunggu"
                                {{ $item->status_pesanan == 'menunggu' ? 'selected' : '' }}
                            >
                                Menunggu
                            </option>

                            <option
                                value="diproses"
                                {{ $item->status_pesanan == 'diproses' ? 'selected' : '' }}
                            >
                                Diproses
                            </option>

                            <option
                                value="selesai"
                                {{ $item->status_pesanan == 'selesai' ? 'selected' : '' }}
                            >
                                Selesai
                            </option>

                            <option
                                value="dibatalkan"
                                {{ $item->status_pesanan == 'dibatalkan' ? 'selected' : '' }}
                            >
                                Dibatalkan
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="btn-simpan-status"
                        >
                            Simpan Status
                        </button>

                    </form>


                    <button
                        type="button"
                        class="btn-tutup-modal"
                        data-bs-dismiss="modal"
                    >
                        Tutup
                    </button>

                </div>

            </div>

        </div>

    </div>

@endforeach

@endsection