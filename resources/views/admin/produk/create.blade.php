@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')

    <h1>Tambah Produk</h1>

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>

            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>

                @foreach ($kategori as $item)
                    <option value="{{ $item->id_kategori }}">
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" required>
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <textarea name="deskripsi" required></textarea>
        </div>

        <br>

        <div>
            <label>Harga</label>
            <input type="number" name="harga" required>
        </div>

        <br>

        <div>
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <br>

        <div>
            <label>Satuan</label>
            <input type="text" name="satuan" placeholder="Contoh: Sak, Buah, Kg" required>
        </div>

        <br>

        <div>
            <label>Gambar Produk</label>
            <input type="file" name="gambar" accept="image/*" required>
        </div>

        <br>

        <div>
            <label>Status</label>
            <select name="status" required>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
            </select>
        </div>

        <br>

        <button type="submit">Simpan Produk</button>

        <a href="{{ route('admin.produk.index') }}">
            Kembali
        </a>

    </form>

@endsection
