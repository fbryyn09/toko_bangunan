@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

    <h1>Tambah Kategori</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Kategori</label>
            <input
                type="text"
                name="nama_kategori"
                value="{{ old('nama_kategori') }}"
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
        </div>

        <br>

        <button type="submit">Simpan</button>

        <a href="{{ route('admin.kategori.index') }}">
            Kembali
        </a>
    </form>

@endsection