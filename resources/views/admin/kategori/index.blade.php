@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')

<style>

    /* =====================================================
       HEADER
    ===================================================== */

    .page-header {
        margin-bottom: 25px;
    }

    .page-title {
        color: #222;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #888;
        font-size: 13px;
    }


    /* =====================================================
       BUTTON TAMBAH
    ===================================================== */

    .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        height: 40px;
        padding: 0 17px;

        background: #f6c344;
        border: 1px solid #f6c344;
        border-radius: 8px;

        color: #222;
        font-size: 12px;
        font-weight: 700;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-add:hover {
        background: #eab52f;
        border-color: #eab52f;
        color: #222;
        transform: translateY(-1px);
    }


    /* =====================================================
       STATISTIK
    ===================================================== */

    .category-stat {
        width: 220px;

        background: #ffffff;

        border: 1px solid #eeeeee;
        border-radius: 11px;

        padding: 17px 19px;

        margin-bottom: 22px;

        box-shadow:
            0 3px 12px rgba(0, 0, 0, 0.04);
    }

    .category-stat-label {
        color: #888;
        font-size: 11px;
        font-weight: 600;

        margin-bottom: 5px;
    }

    .category-stat-number {
        color: #222;
        font-size: 26px;
        font-weight: 800;
        line-height: 1;
    }


    /* =====================================================
       TABLE CARD
    ===================================================== */

    .category-table-card {
        background: #ffffff;

        border: 1px solid #eeeeee;
        border-radius: 12px;

        overflow: hidden;

        box-shadow:
            0 3px 12px rgba(0, 0, 0, 0.04);
    }


    .category-table {
        margin-bottom: 0;
    }

    .category-table thead th {
        background: #fafafa;

        color: #777;

        border-bottom: 1px solid #eeeeee;

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 0.3px;

        white-space: nowrap;
    }

    .category-table tbody td {
        color: #444;

        border-color: #f0f0f0;

        font-size: 13px;

        padding-top: 13px;
        padding-bottom: 13px;
    }

    .category-table tbody tr {
        transition: background 0.2s ease;
    }

    .category-table tbody tr:hover {
        background: #fffdf7;
    }


    /* =====================================================
       ID KATEGORI
    ===================================================== */

    .category-id {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 5px 9px;

        background: #fff5d8;

        border-radius: 6px;

        color: #9b710e;

        font-size: 11px;
        font-weight: 700;
    }


    /* =====================================================
       GAMBAR
    ===================================================== */

    .category-image {
        width: 55px;
        height: 55px;

        object-fit: cover;

        border-radius: 9px;

        border: 1px solid #e8e8e8;

        display: block;
    }

    .category-no-image {
        width: 55px;
        height: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f6f6f6;

        border: 1px solid #e8e8e8;
        border-radius: 9px;

        color: #aaa;

        font-size: 9px;
        text-align: center;
    }


    /* =====================================================
       NAMA & DESKRIPSI
    ===================================================== */

    .category-name {
        color: #333;
        font-weight: 700;
    }

    .category-description {
        display: block;

        max-width: 320px;

        color: #888;

        font-size: 12px;
        line-height: 1.5;
    }


    /* =====================================================
       ACTION BUTTON
    ===================================================== */

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action {
        min-width: 58px;
        height: 31px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 700;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease;
    }

    .btn-edit {
        background: #ffffff;
        border: 1px solid #dddddd;
        color: #666;
    }

    .btn-edit:hover {
        background: #fff5d8;
        border-color: #f1cf70;
        color: #9b710e;
    }

    .btn-delete {
        background: #ffffff;
        border: 1px solid #ead0d0;
        color: #b85d5d;
    }

    .btn-delete:hover {
        background: #fff2f2;
        border-color: #dca8a8;
        color: #a64040;
    }


    /* =====================================================
       EMPTY STATE
    ===================================================== */

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 14px;

        background: #fff5d8;

        border-radius: 12px;

        color: #a87808;

        font-size: 20px;
        font-weight: 700;
    }

    .empty-title {
        color: #444;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .empty-text {
        color: #999;
        font-size: 12px;
        margin-bottom: 16px;
    }


    /* =====================================================
       MODAL
    ===================================================== */

    .modal-content {
        border-radius: 13px !important;
        overflow: hidden;
    }

    .modal-header {
        padding: 18px 20px;

        border-bottom: 1px solid #eeeeee;
    }

    .modal-title {
        color: #222;
        font-size: 16px;
    }

    .modal-header small {
        color: #999;
        font-size: 11px;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 15px 20px;

        border-top: 1px solid #eeeeee;
    }


    /* =====================================================
       FORM
    ===================================================== */

    .form-label {
        color: #444;
        font-size: 12px;
    }

    .form-control {
        min-height: 40px;

        border-color: #dddddd;
        border-radius: 8px;

        font-size: 12px;
        box-shadow: none !important;
    }

    .form-control:focus {
        border-color: #f0c34d;

        box-shadow:
            0 0 0 3px rgba(246, 195, 68, 0.12) !important;
    }

    textarea.form-control {
        min-height: auto;
    }

    .form-text-custom {
        color: #999;
        font-size: 10px;
        margin-top: 5px;
    }


    /* =====================================================
       MODAL BUTTON
    ===================================================== */

    .btn-modal-cancel {
        min-height: 37px;

        padding: 0 15px;

        background: #f5f5f5;

        border: 1px solid #e5e5e5;
        border-radius: 7px;

        color: #666;

        font-size: 11px;
        font-weight: 700;
    }

    .btn-modal-cancel:hover {
        background: #eeeeee;
        color: #444;
    }

    .btn-modal-save {
        min-height: 37px;

        padding: 0 16px;

        background: #f6c344;

        border: 1px solid #f6c344;
        border-radius: 7px;

        color: #222;

        font-size: 11px;
        font-weight: 700;
    }

    .btn-modal-save:hover {
        background: #eab52f;
        border-color: #eab52f;
        color: #222;
    }


    /* =====================================================
       ERROR
    ===================================================== */

    .category-error {
        border: 1px solid #f0cccc;
        background: #fff7f7;

        color: #a54848;

        border-radius: 9px;

        font-size: 12px;
    }


    /* =====================================================
       PREVIEW GAMBAR
    ===================================================== */

    .preview-image {
        width: 90px;
        height: 90px;

        object-fit: cover;

        border-radius: 9px;

        border: 1px solid #dddddd;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 700px) {

        .page-header {
            align-items: flex-start !important;
            gap: 15px;
            flex-direction: column;
        }

        .category-stat {
            width: 100%;
        }

    }

</style>


<div class="container-fluid px-0">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="page-header d-flex justify-content-between align-items-center">

        <div>

            <h1 class="page-title">
                Data Kategori
            </h1>

            <p class="page-subtitle mb-0">
                Kelola kategori produk toko bangunan.
            </p>

        </div>


        <button
            type="button"
            class="btn-add"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah"
        >
            <span>+</span>
            <span>Tambah Kategori</span>
        </button>

    </div>


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="category-stat">

        <div class="category-stat-label">
            Total Kategori
        </div>

        <div class="category-stat-number">
            {{ $kategori->count() }}
        </div>

    </div>


    {{-- =====================================================
         PESAN ERROR
    ====================================================== --}}

    @if ($errors->any())

        <div
            class="alert category-error alert-dismissible fade show"
            role="alert"
        >

            <strong>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            >
            </button>

        </div>

    @endif


    {{-- =====================================================
         DATA KATEGORI
    ====================================================== --}}

    <div class="category-table-card">


        @if ($kategori->count() == 0)


            {{-- EMPTY STATE --}}

            <div class="empty-state">

                <div class="empty-icon">
                    ▤
                </div>

                <div class="empty-title">
                    Belum ada data kategori
                </div>

                <div class="empty-text">
                    Tambahkan kategori untuk mulai mengelola produk.
                </div>

                <button
                    type="button"
                    class="btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                >
                    <span>+</span>
                    <span>Tambah Kategori</span>
                </button>

            </div>


        @else


            {{-- TABLE --}}

            <div class="table-responsive">

                <table class="table category-table table-hover align-middle">


                    <thead>

                        <tr>

                            <th class="px-4 py-3">
                                ID Kategori
                            </th>

                            <th class="py-3">
                                Gambar
                            </th>

                            <th class="py-3">
                                Nama Kategori
                            </th>

                            <th class="py-3">
                                Deskripsi
                            </th>

                            <th class="py-3 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @foreach ($kategori as $item)

                            <tr>


                                {{-- ID --}}

                                <td class="px-4">

                                    <span class="category-id">
                                        {{ $item->id_kategori }}
                                    </span>

                                </td>


                                {{-- GAMBAR --}}

                                <td>

                                    @if ($item->gambar)

                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->nama_kategori }}"
                                            class="category-image"
                                        >

                                    @else

                                        <div class="category-no-image">
                                            Tidak ada
                                        </div>

                                    @endif

                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <span class="category-name">
                                        {{ $item->nama_kategori }}
                                    </span>

                                </td>


                                {{-- DESKRIPSI --}}

                                <td>

                                    <span class="category-description">

                                        {{ $item->deskripsi }}

                                    </span>

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="action-buttons">


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn-action btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit"
                                            data-id="{{ $item->id_kategori }}"
                                            data-nama="{{ $item->nama_kategori }}"
                                            data-deskripsi="{{ $item->deskripsi }}"
                                            data-gambar="{{ $item->gambar }}"
                                        >
                                            Edit
                                        </button>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('admin.kategori.destroy', $item->id_kategori) }}"
                                            method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-action btn-delete"
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




{{-- =====================================================
     MODAL TAMBAH KATEGORI
====================================================== --}}

<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
    aria-labelledby="modalTambahLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title fw-bold"
                        id="modalTambahLabel"
                    >
                        Tambah Kategori
                    </h5>

                    <small>
                        Tambahkan kategori baru.
                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                >
                </button>

            </div>


            <form
                action="{{ route('admin.kategori.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="modal-body">


                    {{-- NAMA --}}

                    <div class="mb-3">

                        <label
                            for="nama_kategori"
                            class="form-label fw-semibold"
                        >
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nama_kategori"
                            name="nama_kategori"
                            placeholder="Contoh: Semen, Cat, Besi"
                            value="{{ old('nama_kategori') }}"
                            required
                        >

                    </div>


                    {{-- GAMBAR --}}

                    <div class="mb-3">

                        <label
                            for="gambar"
                            class="form-label fw-semibold"
                        >
                            Gambar Kategori
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="gambar"
                            name="gambar"
                            accept="image/*"
                        >

                        <div class="form-text-custom">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </div>

                    </div>


                    {{-- DESKRIPSI --}}

                    <div class="mb-3">

                        <label
                            for="deskripsi"
                            class="form-label fw-semibold"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            class="form-control"
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            placeholder="Masukkan deskripsi kategori..."
                        >{{ old('deskripsi') }}</textarea>

                    </div>


                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-modal-save"
                    >
                        Simpan Kategori
                    </button>

                </div>


            </form>

        </div>

    </div>

</div>




{{-- =====================================================
     MODAL EDIT KATEGORI
====================================================== --}}

<div
    class="modal fade"
    id="modalEdit"
    tabindex="-1"
    aria-labelledby="modalEditLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title fw-bold"
                        id="modalEditLabel"
                    >
                        Edit Kategori
                    </h5>

                    <small>
                        Perbarui informasi kategori.
                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                >
                </button>

            </div>


            <form
                id="formEdit"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <div class="modal-body">


                    {{-- NAMA --}}

                    <div class="mb-3">

                        <label
                            for="edit_nama_kategori"
                            class="form-label fw-semibold"
                        >
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="edit_nama_kategori"
                            name="nama_kategori"
                            required
                        >

                    </div>


                    {{-- GAMBAR --}}

                    <div class="mb-3">

                        <label
                            for="edit_gambar"
                            class="form-label fw-semibold"
                        >
                            Gambar Kategori
                        </label>


                        <div
                            id="previewGambar"
                            class="mb-2"
                        >
                        </div>


                        <input
                            type="file"
                            class="form-control"
                            id="edit_gambar"
                            name="gambar"
                            accept="image/*"
                        >


                        <div class="form-text-custom">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </div>

                    </div>


                    {{-- DESKRIPSI --}}

                    <div class="mb-3">

                        <label
                            for="edit_deskripsi"
                            class="form-label fw-semibold"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            class="form-control"
                            id="edit_deskripsi"
                            name="deskripsi"
                            rows="4"
                            required
                        ></textarea>

                    </div>


                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-modal-save"
                    >
                        Simpan Perubahan
                    </button>

                </div>


            </form>


        </div>

    </div>

</div>




{{-- =====================================================
     JAVASCRIPT MODAL EDIT
====================================================== --}}

<script>

    const modalEdit =
        document.getElementById('modalEdit');


    modalEdit.addEventListener(
        'show.bs.modal',
        function (event) {

            const button =
                event.relatedTarget;

            const id =
                button.getAttribute('data-id');

            const nama =
                button.getAttribute('data-nama');

            const deskripsi =
                button.getAttribute('data-deskripsi');

            const gambar =
                button.getAttribute('data-gambar');


            document.getElementById(
                'edit_nama_kategori'
            ).value = nama;


            document.getElementById(
                'edit_deskripsi'
            ).value = deskripsi;


            document.getElementById(
                'formEdit'
            ).action =
                '/admin/kategori/' + id;


            const preview =
                document.getElementById(
                    'previewGambar'
                );


            if (gambar) {

                preview.innerHTML = `

                    <img
                        src="/storage/${gambar}"
                        alt="Gambar kategori"
                        class="preview-image"
                    >

                `;

            } else {

                preview.innerHTML = `

                    <div class="text-secondary small">
                        Belum ada gambar.
                    </div>

                `;

            }

        }

    );

</script>

@endsection