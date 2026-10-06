@extends('layouts.pelanggan')

@section('title', 'Kategori')

@section('content')

<style>
    .kategori-page {
        padding: 10px 5px 40px;
    }

    .kategori-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 28px;
        color: #222;
    }

    .kategori-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 30px;
        max-width: 900px;
    }

    .kategori-card {
        background: #f5f5f5;
        border: 2px solid #aaa;
        border-radius: 5px;
        height: 145px;
        text-decoration: none;
        color: #222;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .kategori-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }

    .kategori-image {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #f8f8f8;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
        border: 1px solid #ddd;
    }

    .kategori-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .kategori-placeholder {
        font-size: 32px;
    }

    .kategori-name {
        font-size: 15px;
        font-weight: 600;
        text-align: center;
    }

    @media (max-width: 1100px) {
        .kategori-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 800px) {
        .kategori-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 550px) {
        .kategori-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
    }
</style>

<div class="kategori-page">

    <h1 class="kategori-title">
        Kategori Bahan Bangunan Pilihan
    </h1>

    <div class="kategori-grid">

        @foreach ($kategori as $item)

            <a
                href="{{ route('pelanggan.produk') }}?kategori={{ $item->id_kategori }}"
                class="kategori-card"
            >

                <div class="kategori-image">

                    @if ($item->gambar)

                        <img
                            src="{{ asset('storage/' . $item->gambar) }}"
                            alt="{{ $item->nama_kategori }}"
                        >

                    @else

                        <span class="kategori-placeholder">
                            🧱
                        </span>

                    @endif

                </div>

                <div class="kategori-name">
                    {{ $item->nama_kategori }}
                </div>

            </a>

        @endforeach

    </div>

</div>

@endsection