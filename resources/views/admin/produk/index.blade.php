@extends('layouts.admin')

@section('title', 'Produk')

@section('content')

<style>
    /* =========================================
       HEADER
    ========================================= */

    .produk-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .produk-header h1 {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #222;
    }

    .produk-header p {
        margin: 6px 0 0;
        color: #888;
        font-size: 14px;
    }

    .btn-tambah {
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
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
        box-shadow: 0 3px 8px rgba(246, 195, 68, 0.18);
    }

    .btn-tambah:hover {
        background: #eab52f;
        color: #222;
        transform: translateY(-1px);
    }


    /* =========================================
       ALERT
    ========================================= */

    .alert-success {
        padding: 12px 16px;
        margin-bottom: 20px;
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        font-size: 14px;
    }


    /* =========================================
       STATISTIK
    ========================================= */

    .produk-stat {
        background: #fff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.025);
    }

    .produk-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #fff5d8;
        color: #d49e16;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        font-weight: 700;
    }

    .produk-stat-label {
        color: #888;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .produk-stat-value {
        color: #222;
        font-size: 20px;
        font-weight: 700;
    }


    /* =========================================
       TABLE
    ========================================= */

    .table-container {
        overflow-x: auto;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eeeeee;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.025);
    }

    .produk-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .produk-table th,
    .produk-table td {
        padding: 15px 16px;
        text-align: left;
        border-bottom: 1px solid #eeeeee;
        vertical-align: middle;
    }

    .produk-table th {
        background: #fafafa;
        color: #555;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .produk-table td {
        color: #555;
        font-size: 13px;
    }

    .produk-table tbody tr {
        transition: 0.15s ease;
    }

    .produk-table tbody tr:hover {
        background: #fffdf6;
    }

    .produk-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================
       PRODUK
    ========================================= */

    .produk-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 220px;
    }

    .produk-image {
        width: 62px;
        height: 62px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid #eeeeee;
        background: #f8f8f8;
        flex-shrink: 0;
    }

    .produk-info {
        min-width: 0;
    }

    .produk-name {
        color: #222;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 3px;
    }

    .produk-id {
        color: #999;
        font-size: 11px;
    }


    /* =========================================
       KATEGORI
    ========================================= */

    .kategori-name {
        color: #444;
        font-weight: 600;
        white-space: nowrap;
    }


    /* =========================================
       DESKRIPSI
    ========================================= */

    .deskripsi-produk {
        max-width: 230px;
        color: #777;
        line-height: 1.5;
    }


    /* =========================================
       HARGA
    ========================================= */

    .harga {
        color: #222 !important;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================
       STOK
    ========================================= */

    .stok {
        font-weight: 600;
        color: #444;
    }


    /* =========================================
       BADGE
    ========================================= */

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-tersedia {
        background: #eaf8ef;
        color: #208045;
        border: 1px solid #ccebd8;
    }

    .badge-habis {
        background: #fff0f0;
        color: #c13a3a;
        border: 1px solid #f3cccc;
    }


    /* =========================================
       AKSI
    ========================================= */

    .aksi {
        display: flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
    }

    .btn-edit,
    .btn-hapus {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 34px;
        padding: 0 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        box-sizing: border-box;
        transition: 0.2s ease;
    }

    .btn-edit {
        background: #fff7df;
        color: #a77908;
        border: 1px solid #f0d78b;
        cursor: pointer;
    }

    .btn-edit:hover {
        background: #f6c344;
        color: #222;
        border-color: #f6c344;
    }

    .btn-hapus {
        background: #fff0f0;
        color: #bd3939;
        border: 1px solid #f0cccc;
        cursor: pointer;
    }

    .btn-hapus:hover {
        background: #e85c5c;
        color: #fff;
        border-color: #e85c5c;
    }

    .form-hapus {
        margin: 0;
        padding: 0;
    }


    /* =========================================
       DATA KOSONG
    ========================================= */

    .kosong {
        text-align: center;
        padding: 55px 20px;
        color: #999;
    }

    .kosong-icon {
        font-size: 35px;
        margin-bottom: 10px;
        opacity: 0.5;
    }

    .kosong p {
        margin: 0;
        font-size: 14px;
    }


    /* =========================================
       MODAL
    ========================================= */

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        background: rgba(20, 20, 20, 0.48);
        padding: 30px 15px;
        overflow-y: auto;
    }

    .modal-content {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background: #fff;
        border-radius: 13px;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
        overflow: hidden;
    }

    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px;
        border-bottom: 1px solid #eeeeee;
        background: #fff;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #222;
    }

    .btn-close {
        border: none;
        background: #f5f5f5;
        width: 32px;
        height: 32px;
        border-radius: 7px;
        font-size: 22px;
        color: #777;
        cursor: pointer;
        line-height: 1;
        transition: 0.2s ease;
    }

    .btn-close:hover {
        background: #fff0f0;
        color: #c13a3a;
    }

    .modal-body {
        padding: 22px;
    }

    .form-group {
        margin-bottom: 17px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        color: #444;
        font-size: 13px;
        font-weight: 700;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #dcdcdc;
        border-radius: 8px;
        font-size: 13px;
        color: #222;
        background: #fff;
        box-sizing: border-box;
        outline: none;
        transition: 0.2s ease;
    }

    .form-control:focus {
        border-color: #f0c23e;
        box-shadow: 0 0 0 3px rgba(246, 195, 68, 0.13);
    }

    textarea.form-control {
        min-height: 90px;
        resize: vertical;
        line-height: 1.5;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 16px 22px;
        border-top: 1px solid #eeeeee;
        background: #fafafa;
    }

    .btn-batal {
        padding: 9px 15px;
        border: 1px solid #d8d8d8;
        background: #fff;
        color: #555;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-batal:hover {
        background: #f2f2f2;
    }

    .btn-simpan {
        padding: 9px 16px;
        border: none;
        background: #f6c344;
        color: #222;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-simpan:hover {
        background: #eab52f;
    }


    /* =========================================
       GAMBAR
    ========================================= */

    .gambar-preview {
        margin-top: 10px;
    }

    .gambar-preview img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 9px;
        border: 1px solid #eeeeee;
    }

    .gambar-info {
        margin-top: 6px;
        font-size: 11px;
        color: #999;
        line-height: 1.5;
    }


    /* =========================================
       ERROR
    ========================================= */

    .error-box {
        margin-bottom: 18px;
        padding: 12px 15px;
        background: #fff4f4;
        color: #991b1b;
        border: 1px solid #f2cccc;
        border-radius: 8px;
        font-size: 12px;
    }

    .error-box p {
        margin: 4px 0;
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 768px) {

        .produk-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .btn-tambah {
            width: 100%;
        }

        .produk-stat {
            padding: 15px;
        }

        .modal {
            padding: 15px;
        }

        .modal-content {
            max-width: 100%;
        }

        .modal-footer {
            flex-direction: column-reverse;
        }

        .btn-batal,
        .btn-simpan {
            width: 100%;
        }
    }
</style>


{{-- =========================================
     HEADER
========================================= --}}

<div class="produk-header">

    <div>
        <h1>Data Produk</h1>

        <p>
            Kelola produk toko bangunan.
        </p>
    </div>

    <button
        type="button"
        class="btn-tambah"
        onclick="bukaModalTambah()"
    >
        <span>+</span>
        <span>Tambah Produk</span>
    </button>

</div>


{{-- =========================================
     ALERT SUCCESS
========================================= --}}

@if (session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- =========================================
     STATISTIK PRODUK
========================================= --}}

<div class="produk-stat">

    <div class="produk-stat-icon">
        📦
    </div>

    <div>
        <div class="produk-stat-label">
            Total Produk
        </div>

        <div class="produk-stat-value">
            {{ $produk->count() }}
        </div>
    </div>

</div>


{{-- =========================================
     DATA PRODUK
========================================= --}}

@if ($produk->count() == 0)

    <div class="table-container kosong">

        <div class="kosong-icon">
            📦
        </div>

        <p>
            Belum ada data produk.
        </p>

    </div>

@else

    <div class="table-container">

        <table class="produk-table">

            <thead>

                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($produk as $item)

                    <tr>

                        {{-- PRODUK --}}

                        <td>

                            <div class="produk-wrapper">

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->nama_produk }}"
                                    class="produk-image"
                                >

                                <div class="produk-info">

                                    <div class="produk-name">
                                        {{ $item->nama_produk }}
                                    </div>

                                    <div class="produk-id">
                                        {{ $item->id_produk }}
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- KATEGORI --}}

                        <td>

                            <span class="kategori-name">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>

                        </td>


                        {{-- DESKRIPSI --}}

                        <td>

                            <div class="deskripsi-produk">
                                {{ $item->deskripsi }}
                            </div>

                        </td>


                        {{-- HARGA --}}

                        <td class="harga">

                            Rp {{ number_format($item->harga, 0, ',', '.') }}

                        </td>


                        {{-- STOK --}}

                        <td>

                            <span class="stok">
                                {{ $item->stok }}
                            </span>

                        </td>


                        {{-- SATUAN --}}

                        <td>
                            {{ $item->satuan }}
                        </td>


                        {{-- STATUS --}}

                        <td>

                            @if ($item->status == 'tersedia')

                                <span class="badge badge-tersedia">
                                    Tersedia
                                </span>

                            @else

                                <span class="badge badge-habis">
                                    Habis
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <div class="aksi">

                                {{-- EDIT --}}

                                <button
                                    type="button"
                                    class="btn-edit"
                                    onclick="bukaModalEdit('{{ $item->id_produk }}')"
                                >
                                    Edit
                                </button>


                                {{-- HAPUS --}}

                                <form
                                    action="{{ route('admin.produk.destroy', $item->id_produk) }}"
                                    method="POST"
                                    class="form-hapus"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-hapus"
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



{{-- =====================================================
     MODAL TAMBAH PRODUK
===================================================== --}}

<div
    id="modalTambah"
    class="modal"
>

    <div class="modal-content">

        <div class="modal-header">

            <h2>
                Tambah Produk
            </h2>

            <button
                type="button"
                class="btn-close"
                onclick="tutupModalTambah()"
            >
                &times;
            </button>

        </div>


        <form
            action="{{ route('admin.produk.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="modal-body">

                {{-- ERROR --}}

                @if ($errors->any())

                    <div class="error-box">

                        <strong>
                            Terjadi kesalahan:
                        </strong>

                        @foreach ($errors->all() as $error)

                            <p>
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                @endif


                {{-- KATEGORI --}}

                <div class="form-group">

                    <label>
                        Kategori
                    </label>

                    <select
                        name="id_kategori"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach ($kategori as $item)

                            <option
                                value="{{ $item->id_kategori }}"
                                {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}
                            >
                                {{ $item->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- NAMA PRODUK --}}

                <div class="form-group">

                    <label>
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama_produk"
                        class="form-control"
                        value="{{ old('nama_produk') }}"
                        required
                    >

                </div>


                {{-- DESKRIPSI --}}

                <div class="form-group">

                    <label>
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        required
                    >{{ old('deskripsi') }}</textarea>

                </div>


                {{-- HARGA --}}

                <div class="form-group">

                    <label>
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="{{ old('harga') }}"
                        min="0"
                        required
                    >

                </div>


                {{-- STOK --}}

                <div class="form-group">

                    <label>
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        class="form-control"
                        value="{{ old('stok') }}"
                        min="0"
                        required
                    >

                </div>


                {{-- SATUAN --}}

                <div class="form-group">

                    <label>
                        Satuan
                    </label>

                    <input
                        type="text"
                        name="satuan"
                        class="form-control"
                        placeholder="Contoh: Sak, Buah, Kg"
                        value="{{ old('satuan') }}"
                        required
                    >

                </div>


                {{-- GAMBAR --}}

                <div class="form-group">

                    <label>
                        Gambar Produk
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        required
                    >

                    <div class="gambar-info">
                        Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.
                    </div>

                </div>


                {{-- STATUS --}}

                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control"
                        required
                    >

                        <option
                            value="tersedia"
                            {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}
                        >
                            Tersedia
                        </option>

                        <option
                            value="habis"
                            {{ old('status') == 'habis' ? 'selected' : '' }}
                        >
                            Habis
                        </option>

                    </select>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-batal"
                    onclick="tutupModalTambah()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn-simpan"
                >
                    Simpan Produk
                </button>

            </div>

        </form>

    </div>

</div>



{{-- =====================================================
     MODAL EDIT PRODUK
===================================================== --}}

@foreach ($produk as $item)

    <div
        id="modalEdit{{ $item->id_produk }}"
        class="modal"
    >

        <div class="modal-content">

            <div class="modal-header">

                <h2>
                    Edit Produk
                </h2>

                <button
                    type="button"
                    class="btn-close"
                    onclick="tutupModalEdit('{{ $item->id_produk }}')"
                >
                    &times;
                </button>

            </div>


            <form
                action="{{ route('admin.produk.update', $item->id_produk) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <div class="modal-body">

                    {{-- ID PRODUK --}}

                    <div class="form-group">

                        <label>
                            ID Produk
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $item->id_produk }}"
                            readonly
                            style="background: #f3f3f3;"
                        >

                    </div>


                    {{-- KATEGORI --}}

                    <div class="form-group">

                        <label>
                            Kategori
                        </label>

                        <select
                            name="id_kategori"
                            class="form-control"
                            required
                        >

                            @foreach ($kategori as $kategoriItem)

                                <option
                                    value="{{ $kategoriItem->id_kategori }}"
                                    {{ $item->id_kategori == $kategoriItem->id_kategori ? 'selected' : '' }}
                                >
                                    {{ $kategoriItem->nama_kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- NAMA PRODUK --}}

                    <div class="form-group">

                        <label>
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            name="nama_produk"
                            class="form-control"
                            value="{{ $item->nama_produk }}"
                            required
                        >

                    </div>


                    {{-- DESKRIPSI --}}

                    <div class="form-group">

                        <label>
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            required
                        >{{ $item->deskripsi }}</textarea>

                    </div>


                    {{-- HARGA --}}

                    <div class="form-group">

                        <label>
                            Harga
                        </label>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            value="{{ $item->harga }}"
                            min="0"
                            required
                        >

                    </div>


                    {{-- STOK --}}

                    <div class="form-group">

                        <label>
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            class="form-control"
                            value="{{ $item->stok }}"
                            min="0"
                            required
                        >

                    </div>


                    {{-- SATUAN --}}

                    <div class="form-group">

                        <label>
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="satuan"
                            class="form-control"
                            value="{{ $item->satuan }}"
                            required
                        >

                    </div>


                    {{-- GAMBAR LAMA --}}

                    <div class="form-group">

                        <label>
                            Gambar Saat Ini
                        </label>

                        <div class="gambar-preview">

                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->nama_produk }}"
                            >

                        </div>

                    </div>


                    {{-- GAMBAR BARU --}}

                    <div class="form-group">

                        <label>
                            Ganti Gambar
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                        >

                        <div class="gambar-info">
                            Kosongkan jika tidak ingin mengganti gambar.
                            Format JPG, JPEG, PNG, WEBP. Maksimal 2MB.
                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-control"
                            required
                        >

                            <option
                                value="tersedia"
                                {{ $item->status == 'tersedia' ? 'selected' : '' }}
                            >
                                Tersedia
                            </option>

                            <option
                                value="habis"
                                {{ $item->status == 'habis' ? 'selected' : '' }}
                            >
                                Habis
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal"
                        onclick="tutupModalEdit('{{ $item->id_produk }}')"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-simpan"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endforeach



{{-- =====================================================
     JAVASCRIPT MODAL
===================================================== --}}

<script>

    function bukaModalTambah() {

        document.getElementById('modalTambah').style.display = 'block';

    }


    function tutupModalTambah() {

        document.getElementById('modalTambah').style.display = 'none';

    }


    function bukaModalEdit(id) {

        const modal = document.getElementById('modalEdit' + id);

        if (modal) {

            modal.style.display = 'block';

        }

    }


    function tutupModalEdit(id) {

        const modal = document.getElementById('modalEdit' + id);

        if (modal) {

            modal.style.display = 'none';

        }

    }


    // Klik area luar modal untuk menutup

    window.onclick = function(event) {

        if (event.target.classList.contains('modal')) {

            event.target.style.display = 'none';

        }

    };


    // Tombol ESC untuk menutup modal

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            document.querySelectorAll('.modal').forEach(function(modal) {

                modal.style.display = 'none';

            });

        }

    });

</script>

@endsection