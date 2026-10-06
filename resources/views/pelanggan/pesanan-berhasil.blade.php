@extends('layouts.pelanggan')

@section('title', 'Pesanan Berhasil')

@section('content')

<style>
    /* =====================================================
       PESANAN BERHASIL
    ===================================================== */

    .success-page {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 55px 20px 70px;
    }

    .success-card {
        background: #fff;
        border: 1px solid #eeeeee;
        border-radius: 16px;
        padding: 45px 35px;
        text-align: center;
    }

    /* =====================================================
       ICON
    ===================================================== */

    .success-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 22px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #fff8df;
        border: 1px solid #f1d47b;
        border-radius: 50%;

        color: #d39b18;
        font-size: 30px;
        font-weight: 700;
    }

    /* =====================================================
       TEXT
    ===================================================== */

    .success-title {
        margin: 0 0 10px;
        color: #222;
        font-size: 27px;
        font-weight: 750;
    }

    .success-description {
        max-width: 520px;
        margin: 0 auto;
        color: #888;
        font-size: 13px;
        line-height: 1.7;
    }

    /* =====================================================
       SUCCESS MESSAGE
    ===================================================== */

    .success-message {
        max-width: 600px;
        margin: 25px auto 28px;
        padding: 14px 18px;

        background: #fafafa;
        border: 1px solid #eeeeee;
        border-radius: 9px;

        color: #555;
        font-size: 12px;
        line-height: 1.6;
    }

    /* =====================================================
       ACTION
    ===================================================== */

    .success-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .success-button {
        min-width: 165px;
        height: 44px;
        padding: 10px 20px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #f6c344;
        border-radius: 8px;

        background: #f6c344;
        color: #222;

        font-size: 13px;
        font-weight: 700;
        text-decoration: none;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .success-button:hover {
        background: #eab52f;
        border-color: #eab52f;
        color: #222;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.09);
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 600px) {

        .success-page {
            padding: 30px 15px 50px;
        }

        .success-card {
            padding: 35px 20px;
        }

        .success-icon {
            width: 64px;
            height: 64px;
            font-size: 26px;
        }

        .success-title {
            font-size: 23px;
        }

        .success-description {
            font-size: 12px;
        }

        .success-button {
            width: 100%;
        }
    }
</style>


<div class="success-page">

    <div class="success-card">

        {{-- ICON --}}
        <div class="success-icon">
            ✓
        </div>


        {{-- TITLE --}}
        <h1 class="success-title">
            Pesanan Berhasil
        </h1>


        {{-- DESCRIPTION --}}
        <p class="success-description">
            Pesanan Anda berhasil dibuat dan sedang menunggu
            diproses oleh admin.
        </p>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="success-message">

                {{ session('success') }}

            </div>

        @endif


        {{-- ACTION --}}
        <div class="success-action">

            <a
                href="{{ route('pelanggan.produk') }}"
                class="success-button"
            >
                Kembali ke Produk
            </a>

        </div>

    </div>

</div>

@endsection