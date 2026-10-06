@extends('layouts.admin')

@section('title', 'Promosi')

@section('content')

<style>
    /* =========================================
       HEADER
    ========================================= */

    .promosi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .promosi-header h1 {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #222;
    }

    .promosi-header p {
        margin: 6px 0 0;
        color: #888;
        font-size: 14px;
    }

    .btn-tambah-promosi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 17px;
        background: #f6c344;
        color: #222;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
        box-shadow: 0 3px 8px rgba(246, 195, 68, 0.18);
    }

    .btn-tambah-promosi:hover {
        background: #eab52f;
        color: #222;
        transform: translateY(-1px);
    }


    /* =========================================
       STATISTIK
    ========================================= */

    .promosi-stat-card {
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

    .promosi-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #fff5d8;
        color: #d49e16;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .promosi-stat-icon.aktif {
        background: #eaf8ef;
        color: #208045;
    }

    .promosi-stat-icon.nonaktif {
        background: #f1f1f1;
        color: #777;
    }

    .promosi-stat-label {
        color: #888;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .promosi-stat-value {
        color: #222;
        font-size: 21px;
        font-weight: 700;
    }

    .promosi-stat-value.aktif {
        color: #208045;
    }

    .promosi-stat-value.nonaktif {
        color: #777;
    }


    /* =========================================
       CARD TABEL
    ========================================= */

    .promosi-table-card {
        background: #fff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.025);
    }

    .promosi-table-header {
        padding: 18px 20px;
        border-bottom: 1px solid #eeeeee;
        background: #fff;
    }

    .promosi-table-header h5 {
        margin: 0 0 4px;
        color: #222;
        font-size: 15px;
        font-weight: 700;
    }

    .promosi-table-header p {
        margin: 0;
        color: #999;
        font-size: 12px;
    }


    /* =========================================
       TABLE
    ========================================= */

    .promosi-table-wrapper {
        overflow-x: auto;
    }

    .promosi-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .promosi-table th,
    .promosi-table td {
        padding: 15px 16px;
        border-bottom: 1px solid #eeeeee;
        vertical-align: middle;
        text-align: left;
    }

    .promosi-table th {
        background: #fafafa;
        color: #555;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .promosi-table td {
        color: #555;
        font-size: 13px;
    }

    .promosi-table tbody tr {
        transition: 0.15s ease;
    }

    .promosi-table tbody tr:hover {
        background: #fffdf6;
    }

    .promosi-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================
       PROMOSI INFO
    ========================================= */

    .promosi-info-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 220px;
    }

    .promosi-image {
        width: 62px;
        height: 62px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid #eeeeee;
        background: #f8f8f8;
        flex-shrink: 0;
    }

    .promosi-no-image {
        width: 62px;
        height: 62px;
        border-radius: 9px;
        border: 1px solid #eeeeee;
        background: #f7f7f7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-size: 11px;
        flex-shrink: 0;
    }

    .promosi-name {
        color: #222;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 3px;
    }

    .promosi-id {
        color: #999;
        font-size: 11px;
    }


    /* =========================================
       DISKON
    ========================================= */

    .diskon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 7px;
        background: #fff7df;
        border: 1px solid #f0d78b;
        color: #a77908;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================
       PERIODE
    ========================================= */

    .periode-mulai {
        color: #444;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .periode-selesai {
        color: #999;
        font-size: 11px;
        margin-top: 3px;
        white-space: nowrap;
    }


    /* =========================================
       PRODUK PROMO
    ========================================= */

    .produk-promo-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .produk-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 9px;
        border-radius: 7px;
        background: #f5f5f5;
        border: 1px solid #e1e1e1;
        color: #555;
        font-size: 11px;
        font-weight: 700;
    }

    .btn-lihat-produk {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 7px;
        border: 1px solid #d8d8d8;
        background: #fff;
        color: #555;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-lihat-produk:hover {
        background: #f6c344;
        color: #222;
        border-color: #f6c344;
    }


    /* =========================================
       STATUS
    ========================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-aktif {
        background: #eaf8ef;
        color: #208045;
        border: 1px solid #ccebd8;
    }

    .status-nonaktif {
        background: #f1f1f1;
        color: #777;
        border: 1px solid #dedede;
    }


    /* =========================================
       AKSI
    ========================================= */

    .aksi-promosi {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        white-space: nowrap;
    }

    .btn-edit-promosi,
    .btn-hapus-promosi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 34px;
        padding: 0 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-edit-promosi {
        background: #fff7df;
        color: #a77908;
        border: 1px solid #f0d78b;
    }

    .btn-edit-promosi:hover {
        background: #f6c344;
        color: #222;
        border-color: #f6c344;
    }

    .btn-hapus-promosi {
        background: #fff0f0;
        color: #bd3939;
        border: 1px solid #f0cccc;
    }

    .btn-hapus-promosi:hover {
        background: #e85c5c;
        color: #fff;
        border-color: #e85c5c;
    }


    /* =========================================
       EMPTY STATE
    ========================================= */

    .promosi-empty {
        text-align: center;
        padding: 55px 20px;
    }

    .promosi-empty-icon {
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
    }

    .promosi-empty h6 {
        margin: 0 0 5px;
        color: #444;
        font-weight: 700;
    }

    .promosi-empty p {
        margin: 0;
        color: #999;
        font-size: 13px;
    }


    /* =========================================
       MODAL
    ========================================= */

    .promosi-modal .modal-content {
        border: none;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
    }

    .promosi-modal .modal-header {
        padding: 18px 22px;
        border-bottom: 1px solid #eeeeee;
        background: #fff;
    }

    .promosi-modal .modal-title {
        color: #222;
        font-size: 17px;
        font-weight: 700;
    }

    .promosi-modal-subtitle {
        display: block;
        margin-top: 3px;
        color: #999;
        font-size: 11px;
    }

    .promosi-modal .modal-body {
        padding: 22px;
    }

    .promosi-modal .modal-footer {
        padding: 15px 22px;
        border-top: 1px solid #eeeeee;
        background: #fafafa;
    }

    .promosi-modal .form-label {
        color: #444;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .promosi-modal .form-control,
    .promosi-modal .form-select {
        border-color: #dcdcdc;
        border-radius: 8px;
        font-size: 13px;
        padding: 10px 12px;
        transition: 0.2s ease;
    }

    .promosi-modal .form-control:focus,
    .promosi-modal .form-select:focus {
        border-color: #f0c23e;
        box-shadow: 0 0 0 3px rgba(246, 195, 68, 0.13);
    }

    .promosi-modal textarea {
        resize: vertical;
    }

    .promosi-modal .form-text {
        color: #999;
        font-size: 11px;
        margin-top: 5px;
    }


    /* =========================================
       PRODUK CHECKBOX
    ========================================= */

    .produk-checkbox-wrapper {
        border: 1px solid #eeeeee;
        background: #fafafa;
        border-radius: 9px;
        padding: 13px;
        max-height: 220px;
        overflow-y: auto;
    }

    .produk-checkbox-item {
        padding: 8px 9px;
        border-radius: 7px;
        transition: 0.15s ease;
    }

    .produk-checkbox-item:hover {
        background: #fff7df;
    }

    .produk-checkbox-item .form-check {
        margin: 0;
    }

    .produk-checkbox-item .form-check-label {
        color: #444;
        font-size: 12px;
        cursor: pointer;
    }

    .produk-checkbox-item .form-check-input {
        cursor: pointer;
    }

    .produk-checkbox-item .form-check-input:checked {
        background-color: #f6c344;
        border-color: #f6c344;
    }

    .produk-checkbox-id {
        color: #999;
        font-size: 10px;
    }


    /* =========================================
       MODAL PRODUK
    ========================================= */

    .modal-produk-item {
        padding: 10px;
        border: 1px solid #eeeeee;
        border-radius: 9px;
        background: #fff;
        transition: 0.15s ease;
    }

    .modal-produk-item:hover {
        background: #fffdf6;
    }

    .modal-produk-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #eeeeee;
        flex-shrink: 0;
    }

    .modal-produk-no-image {
        width: 60px;
        height: 60px;
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

    .modal-produk-name {
        color: #333;
        font-size: 13px;
        font-weight: 700;
    }

    .modal-produk-id,
    .modal-produk-satuan {
        color: #999;
        font-size: 11px;
    }


    /* =========================================
       MODAL BUTTON
    ========================================= */

    .btn-modal-batal {
        padding: 9px 15px;
        border: 1px solid #d8d8d8;
        background: #fff;
        color: #555;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .btn-modal-batal:hover {
        background: #f2f2f2;
    }

    .btn-modal-simpan {
        padding: 9px 16px;
        border: none;
        background: #f6c344;
        color: #222;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .btn-modal-simpan:hover {
        background: #eab52f;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 768px) {

        .promosi-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .btn-tambah-promosi {
            width: 100%;
        }

        .promosi-modal .modal-body {
            padding: 18px;
        }

        .promosi-modal .modal-footer {
            flex-direction: column-reverse;
            gap: 8px;
        }

        .btn-modal-batal,
        .btn-modal-simpan {
            width: 100%;
        }
    }
</style>


<div class="container-fluid px-0">


    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="promosi-header">

        <div>

            <h1>
                Data Promosi
            </h1>

            <p>
                Kelola promosi dan produk yang mendapatkan promo.
            </p>

        </div>


        <button
            type="button"
            class="btn-tambah-promosi"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPromosi"
        >
            <span>+</span>
            <span>Tambah Promosi</span>
        </button>

    </div>


    {{-- =========================================================
         STATISTIK
    ========================================================= --}}

    <div class="row g-3 mb-4">


        {{-- TOTAL PROMOSI --}}

        <div class="col-md-4">

            <div class="promosi-stat-card">

                <div class="promosi-stat-icon">
                    %
                </div>

                <div>

                    <div class="promosi-stat-label">
                        Total Promosi
                    </div>

                    <div class="promosi-stat-value">
                        {{ $promosi->count() }}
                    </div>

                </div>

            </div>

        </div>


        {{-- PROMOSI AKTIF --}}

        <div class="col-md-4">

            <div class="promosi-stat-card">

                <div class="promosi-stat-icon aktif">
                    ✓
                </div>

                <div>

                    <div class="promosi-stat-label">
                        Promosi Aktif
                    </div>

                    <div class="promosi-stat-value aktif">
                        {{ $promosi->where('status', 'aktif')->count() }}
                    </div>

                </div>

            </div>

        </div>


        {{-- PROMOSI NONAKTIF --}}

        <div class="col-md-4">

            <div class="promosi-stat-card">

                <div class="promosi-stat-icon nonaktif">
                    —
                </div>

                <div>

                    <div class="promosi-stat-label">
                        Promosi Nonaktif
                    </div>

                    <div class="promosi-stat-value nonaktif">
                        {{ $promosi->where('status', 'nonaktif')->count() }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TABEL PROMOSI
    ========================================================= --}}

    <div class="promosi-table-card">


        <div class="promosi-table-header">

            <h5>
                Daftar Promosi
            </h5>

            <p>
                Data promosi toko bangunan
            </p>

        </div>


        @if ($promosi->count() == 0)

            {{-- DATA KOSONG --}}

            <div class="promosi-empty">

                <div class="promosi-empty-icon">
                    %
                </div>

                <h6>
                    Belum ada data promosi
                </h6>

                <p>
                    Silakan tambahkan promosi baru.
                </p>

            </div>

        @else

            <div class="promosi-table-wrapper">

                <table class="promosi-table">

                    <thead>

                        <tr>

                            <th>
                                Promosi
                            </th>

                            <th>
                                Diskon
                            </th>

                            <th>
                                Periode
                            </th>

                            <th>
                                Produk
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

                        @foreach ($promosi as $item)

                            <tr>


                                {{-- =================================================
                                     PROMOSI
                                ================================================= --}}

                                <td>

                                    <div class="promosi-info-wrapper">

                                        @if ($item->gambar)

                                            <img
                                                src="{{ asset('storage/' . $item->gambar) }}"
                                                alt="{{ $item->nama_promosi }}"
                                                class="promosi-image"
                                            >

                                        @else

                                            <div class="promosi-no-image">
                                                Tidak ada
                                            </div>

                                        @endif


                                        <div>

                                            <div class="promosi-name">
                                                {{ $item->nama_promosi }}
                                            </div>

                                            <div class="promosi-id">
                                                {{ $item->id_promosi }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- =================================================
                                     DISKON
                                ================================================= --}}

                                <td>

                                    @if ($item->jenis_diskon == 'persen')

                                        <span class="diskon-badge">

                                            {{ number_format($item->nilai_diskon, 0, ',', '.') }}%

                                        </span>

                                    @else

                                        <span class="diskon-badge">

                                            Rp {{ number_format($item->nilai_diskon, 0, ',', '.') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     PERIODE
                                ================================================= --}}

                                <td>

                                    <div class="periode-mulai">

                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}

                                    </div>

                                    <div class="periode-selesai">

                                        sampai
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}

                                    </div>

                                </td>


                                {{-- =================================================
                                     PRODUK
                                ================================================= --}}

                                <td>

                                    @if ($item->produk->count() > 0)

                                        <div class="produk-promo-wrapper">

                                            <span class="produk-count">

                                                {{ $item->produk->count() }}
                                                Produk

                                            </span>


                                            <button
                                                type="button"
                                                class="btn-lihat-produk"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalProduk{{ $item->id_promosi }}"
                                            >
                                                Lihat
                                            </button>

                                        </div>

                                    @else

                                        <span class="text-muted small">
                                            Belum ada produk
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     STATUS
                                ================================================= --}}

                                <td>

                                    @if ($item->status == 'aktif')

                                        <span class="status-badge status-aktif">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="status-badge status-nonaktif">
                                            Nonaktif
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     AKSI
                                ================================================= --}}

                                <td>

                                    <div class="aksi-promosi">


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn-edit-promosi"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPromosi{{ $item->id_promosi }}"
                                        >
                                            Edit
                                        </button>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('admin.promosi.destroy', $item->id_promosi) }}"
                                            method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus promosi ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-hapus-promosi"
                                            >
                                                Hapus
                                            </button>

                                        </form>

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
     MODAL LIHAT PRODUK
============================================================= --}}

@foreach ($promosi as $item)

    @if ($item->produk->count() > 0)

        <div
            class="modal fade promosi-modal"
            id="modalProduk{{ $item->id_promosi }}"
            tabindex="-1"
            aria-labelledby="modalProdukLabel{{ $item->id_promosi }}"
            aria-hidden="true"
        >

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">


                    {{-- HEADER --}}

                    <div class="modal-header">

                        <div>

                            <h5
                                class="modal-title"
                                id="modalProdukLabel{{ $item->id_promosi }}"
                            >
                                Produk dalam Promosi
                            </h5>

                            <span class="promosi-modal-subtitle">
                                {{ $item->nama_promosi }}
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

                        <div class="d-flex flex-column gap-2">

                            @foreach ($item->produk as $produkItem)

                                <div class="modal-produk-item">

                                    <div class="d-flex align-items-center">


                                        {{-- GAMBAR PRODUK --}}

                                        @if ($produkItem->gambar)

                                            <img
                                                src="{{ asset('storage/' . $produkItem->gambar) }}"
                                                alt="{{ $produkItem->nama_produk }}"
                                                class="modal-produk-image me-3"
                                            >

                                        @else

                                            <div class="modal-produk-no-image me-3">
                                                Tidak ada
                                            </div>

                                        @endif


                                        {{-- INFORMASI PRODUK --}}

                                        <div class="flex-grow-1">

                                            <div class="modal-produk-name">

                                                {{ $produkItem->nama_produk }}

                                            </div>

                                            <div class="modal-produk-id">

                                                {{ $produkItem->id_produk }}

                                            </div>

                                            <div class="modal-produk-satuan mt-1">

                                                {{ $produkItem->satuan }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal"
                        >
                            Tutup
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif

@endforeach



{{-- =============================================================
     MODAL TAMBAH PROMOSI
============================================================= --}}

<div
    class="modal fade promosi-modal"
    id="modalTambahPromosi"
    tabindex="-1"
    aria-labelledby="modalTambahPromosiLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title"
                        id="modalTambahPromosiLabel"
                    >
                        Tambah Promosi
                    </h5>

                    <span class="promosi-modal-subtitle">
                        Tambahkan promosi baru untuk produk toko.
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


            {{-- FORM --}}

            <form
                action="{{ route('admin.promosi.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="modal-body">


                    {{-- NAMA PROMOSI --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Nama Promosi
                        </label>

                        <input
                            type="text"
                            name="nama_promosi"
                            class="form-control"
                            placeholder="Contoh: Promo Akhir Bulan"
                            value="{{ old('nama_promosi') }}"
                            required
                        >

                    </div>


                    {{-- DESKRIPSI --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan deskripsi promosi"
                            required
                        >{{ old('deskripsi') }}</textarea>

                    </div>


                    {{-- JENIS & NILAI DISKON --}}

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Jenis Diskon
                            </label>

                            <select
                                name="jenis_diskon"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    -- Pilih Jenis Diskon --
                                </option>

                                <option value="persen">
                                    Persen (%)
                                </option>

                                <option value="nominal">
                                    Nominal (Rp)
                                </option>

                            </select>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Nilai Diskon
                            </label>

                            <input
                                type="number"
                                name="nilai_diskon"
                                class="form-control"
                                min="0"
                                step="0.01"
                                placeholder="Contoh: 10"
                                required
                            >

                        </div>

                    </div>


                    {{-- TANGGAL --}}

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control"
                                required
                            >

                        </div>

                    </div>


                    {{-- GAMBAR --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Gambar Promosi
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept="image/*"
                            required
                        >

                        <div class="form-text">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option value="aktif">
                                Aktif
                            </option>

                            <option value="nonaktif">
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    {{-- PRODUK --}}

                    <div class="mb-2">

                        <label class="form-label fw-semibold">
                            Produk yang Mendapatkan Promosi
                        </label>


                        <div class="produk-checkbox-wrapper">

                            @if ($produk->count() > 0)

                                <div class="row">

                                    @foreach ($produk as $produkItem)

                                        <div class="col-md-6 mb-1">

                                            <div class="produk-checkbox-item">

                                                <div class="form-check">

                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="produk[]"
                                                        value="{{ $produkItem->id_produk }}"
                                                        id="produk_tambah_{{ $produkItem->id_produk }}"
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="produk_tambah_{{ $produkItem->id_produk }}"
                                                    >

                                                        {{ $produkItem->nama_produk }}

                                                        <span class="produk-checkbox-id">
                                                            ({{ $produkItem->id_produk }})
                                                        </span>

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="text-center py-3">

                                    <small class="text-muted">
                                        Belum ada produk yang tersedia.
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-modal-batal"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-modal-simpan"
                    >
                        Simpan Promosi
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =============================================================
     MODAL EDIT PROMOSI
============================================================= --}}

@foreach ($promosi as $item)

    <div
        class="modal fade promosi-modal"
        id="modalEditPromosi{{ $item->id_promosi }}"
        tabindex="-1"
        aria-labelledby="modalEditPromosiLabel{{ $item->id_promosi }}"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="modalEditPromosiLabel{{ $item->id_promosi }}"
                        >
                            Edit Promosi
                        </h5>

                        <span class="promosi-modal-subtitle">
                            {{ $item->id_promosi }}
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


                {{-- FORM --}}

                <form
                    action="{{ route('admin.promosi.update', $item->id_promosi) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">


                        {{-- NAMA PROMOSI --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Nama Promosi
                            </label>

                            <input
                                type="text"
                                name="nama_promosi"
                                class="form-control"
                                value="{{ $item->nama_promosi }}"
                                required
                            >

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="3"
                                required
                            >{{ $item->deskripsi }}</textarea>

                        </div>


                        {{-- JENIS & NILAI DISKON --}}

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Jenis Diskon
                                </label>

                                <select
                                    name="jenis_diskon"
                                    class="form-select"
                                    required
                                >

                                    <option
                                        value="persen"
                                        {{ $item->jenis_diskon == 'persen' ? 'selected' : '' }}
                                    >
                                        Persen (%)
                                    </option>

                                    <option
                                        value="nominal"
                                        {{ $item->jenis_diskon == 'nominal' ? 'selected' : '' }}
                                    >
                                        Nominal (Rp)
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Nilai Diskon
                                </label>

                                <input
                                    type="number"
                                    name="nilai_diskon"
                                    class="form-control"
                                    value="{{ $item->nilai_diskon }}"
                                    min="0"
                                    step="0.01"
                                    required
                                >

                            </div>

                        </div>


                        {{-- TANGGAL --}}

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Mulai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    class="form-control"
                                    value="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    class="form-control"
                                    value="{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Gambar Promosi
                            </label>


                            @if ($item->gambar)

                                <div class="mb-2">

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama_promosi }}"
                                        class="rounded border"
                                        style="
                                            width: 120px;
                                            height: 80px;
                                            object-fit: cover;
                                        "
                                    >

                                </div>

                            @endif


                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept="image/*"
                            >

                            <div class="form-text">
                                Kosongkan jika tidak ingin mengganti gambar.
                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="aktif"
                                    {{ $item->status == 'aktif' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="nonaktif"
                                    {{ $item->status == 'nonaktif' ? 'selected' : '' }}
                                >
                                    Nonaktif
                                </option>

                            </select>

                        </div>


                        {{-- PRODUK --}}

                        <div class="mb-2">

                            <label class="form-label fw-semibold">
                                Produk yang Mendapatkan Promosi
                            </label>


                            <div class="produk-checkbox-wrapper">

                                @if ($produk->count() > 0)

                                    <div class="row">

                                        @foreach ($produk as $produkItem)

                                            <div class="col-md-6 mb-1">

                                                <div class="produk-checkbox-item">

                                                    <div class="form-check">

                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="produk[]"
                                                            value="{{ $produkItem->id_produk }}"
                                                            id="produk_edit_{{ $item->id_promosi }}_{{ $produkItem->id_produk }}"
                                                            {{ $item->produk->contains('id_produk', $produkItem->id_produk) ? 'checked' : '' }}
                                                        >

                                                        <label
                                                            class="form-check-label"
                                                            for="produk_edit_{{ $item->id_promosi }}_{{ $produkItem->id_produk }}"
                                                        >

                                                            {{ $produkItem->nama_produk }}

                                                            <span class="produk-checkbox-id">
                                                                ({{ $produkItem->id_produk }})
                                                            </span>

                                                        </label>

                                                    </div>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <div class="text-center py-3">

                                        <small class="text-muted">
                                            Belum ada produk yang tersedia.
                                        </small>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="btn-modal-simpan"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endforeach

@endsection