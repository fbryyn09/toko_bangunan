@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

    <h1>Edit Produk</h1>

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>

            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form
        action="{{ route('admin.produk.update', $produk->id_produk) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div>
            <label>ID Produk</label>
            <input
                type="text"
                value="{{ $produk->id_produk }}"
                disabled
            >
        </div>

        <br>

        <div>
            <label>Kategori</label>

            <select name="id_kategori" required>

                @foreach ($kategori as $item)

                    <option
                        value="{{ $item->id_kategori }}"
                        {{ $produk->id_kategori == $item->id_kategori ? 'selected' : '' }}
                    >
                        {{ $item->nama_kategori }}
                    </option>

                @endforeach

            </select>
        </div>

        <br>

        <div>
            <label>Nama Produk</label>

            <input
                type="text"
                name="nama_produk"
                value="{{ $produk->nama_produk }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                required
            >{{ $produk->deskripsi }}</textarea>
        </div>

        <br>

        <div>
            <label>Harga</label>

            <input
                type="number"
                name="harga"
                value="{{ $produk->harga }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Stok</label>

            <input
                type="number"
                name="stok"
                value="{{ $produk->stok }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Satuan</label>

            <input
                type="text"
                name="satuan"
                value="{{ $produk->satuan }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Gambar Saat Ini</label>

            <br>

            <img
                src="{{ asset('storage/' . $produk->gambar) }}"
                alt="{{ $produk->nama_produk }}"
                width="150"
            >
        </div>

        <br>

        <div>
            <label>Ganti Gambar</label>

            <input
                type="file"
                name="gambar"
                accept="image/*"
            >

            <small>
                Kosongkan jika tidak ingin mengganti gambar.
            </small>
        </div>

        <br>

        <div>
            <label>Status</label>

            <select name="status" required>

                <option
                    value="tersedia"
                    {{ $produk->status == 'tersedia' ? 'selected' : '' }}
                >
                    Tersedia
                </option>

                <option
                    value="habis"
                    {{ $produk->status == 'habis' ? 'selected' : '' }}
                >
                    Habis
                </option>

            </select>
        </div>

        <br>

        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.produk.index') }}">
            Kembali
        </a>

    </form>

@endsection