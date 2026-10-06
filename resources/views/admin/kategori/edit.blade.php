@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

    <h1>Edit Kategori</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form
        action="{{ route('admin.kategori.update', $kategori->id_kategori) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div>
            <label>Nama Kategori</label>

            <input
                type="text"
                name="nama_kategori"
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label>

            <textarea name="deskripsi">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        <br>

        <button type="submit">Simpan Perubahan</button>

        <a href="{{ route('admin.kategori.index') }}">
            Kembali
        </a>
    </form>

@endsection