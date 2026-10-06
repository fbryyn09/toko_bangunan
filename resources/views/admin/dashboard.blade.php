@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>

    /* =====================================================
       DASHBOARD
    ===================================================== */

    .dashboard-header {
        margin-bottom: 28px;
    }

    .dashboard-header h1 {
        color: #222;
        font-size: 27px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .dashboard-header p {
        color: #888;
        font-size: 13px;
    }


    /* =====================================================
       STATISTIC CARD
    ===================================================== */

    .stat-card {
        position: relative;
        height: 100%;

        background: #ffffff;

        border: 1px solid #eeeeee;
        border-radius: 13px;

        padding: 20px;

        overflow: hidden;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-color 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);

        border-color: #f1d27c;

        box-shadow:
            0 8px 22px rgba(0, 0, 0, 0.07);
    }


    /* AKSEN GOLD */

    .stat-card::before {
        content: "";

        position: absolute;

        top: 0;
        left: 0;

        width: 100%;
        height: 3px;

        background: #f6c344;
    }


    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 18px;
    }


    .stat-title {
        color: #888;
        font-size: 12px;
        font-weight: 600;
    }


    .stat-icon {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #fff5d8;
        color: #a87808;

        font-size: 17px;
        font-weight: 700;
    }


    .stat-number {
        color: #222;

        font-size: 30px;
        line-height: 1;

        font-weight: 800;

        margin-bottom: 17px;
    }


    /* =====================================================
       BUTTON LIHAT
    ===================================================== */

    .btn-stat {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;

        min-width: 72px;
        height: 32px;

        padding: 0 12px;

        background: #fff;

        border: 1px solid #e4e4e4;
        border-radius: 7px;

        color: #666;

        font-size: 11px;
        font-weight: 700;

        text-decoration: none;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease;
    }

    .btn-stat:hover {
        background: #f6c344;
        border-color: #f6c344;
        color: #222;
    }


    /* =====================================================
       STATUS PESANAN
    ===================================================== */

    .status-card {
        margin-top: 25px;

        background: #ffffff;

        border: 1px solid #eeeeee;
        border-radius: 13px;

        overflow: hidden;

        box-shadow:
            0 3px 12px rgba(0, 0, 0, 0.04);
    }


    .status-header {
        padding: 20px 22px;

        border-bottom: 1px solid #eeeeee;
    }

    .status-header h5 {
        color: #222;

        font-size: 16px;
        font-weight: 700;

        margin-bottom: 4px;
    }

    .status-header small {
        color: #999;
        font-size: 12px;
    }


    .status-body {
        padding: 20px 22px;
    }


    .status-item {
        position: relative;

        background: #fafafa;

        border: 1px solid #eeeeee;
        border-radius: 10px;

        padding: 17px;

        transition:
            transform 0.2s ease,
            background 0.2s ease;
    }

    .status-item:hover {
        transform: translateY(-2px);
        background: #ffffff;
    }


    .status-label {
        color: #888;

        font-size: 12px;
        font-weight: 600;

        margin-bottom: 7px;
    }


    .status-number {
        font-size: 25px;
        font-weight: 800;
        line-height: 1;
    }


    /* STATUS COLORS */

    .status-menunggu {
        color: #c18b00;
    }

    .status-diproses {
        color: #3d78b8;
    }

    .status-selesai {
        color: #3f8a61;
    }

    .status-dibatalkan {
        color: #c45c5c;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 576px) {

        .dashboard-header h1 {
            font-size: 23px;
        }

        .stat-card {
            padding: 18px;
        }

        .status-header,
        .status-body {
            padding: 17px;
        }

    }

</style>


<div class="container-fluid px-0">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="dashboard-header">

        <h1>
            Dashboard Admin
        </h1>

        <p class="mb-0">
            Selamat datang, {{ Auth::user()->nama }}
        </p>

    </div>


    {{-- =====================================================
         STATISTIK UTAMA
    ====================================================== --}}

    <div class="row g-3">


        {{-- =================================================
             PRODUK
        ================================================== --}}

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-title">
                        Total Produk
                    </div>

                    <div class="stat-icon">
                        ◈
                    </div>

                </div>


                <div class="stat-number">
                    {{ $jumlahProduk }}
                </div>


                <a
                    href="{{ route('admin.produk.index') }}"
                    class="btn-stat"
                >
                    Lihat
                    <span>→</span>
                </a>

            </div>

        </div>


        {{-- =================================================
             KATEGORI
        ================================================== --}}

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-title">
                        Total Kategori
                    </div>

                    <div class="stat-icon">
                        ▤
                    </div>

                </div>


                <div class="stat-number">
                    {{ $jumlahKategori }}
                </div>


                <a
                    href="{{ route('admin.kategori.index') }}"
                    class="btn-stat"
                >
                    Lihat
                    <span>→</span>
                </a>

            </div>

        </div>


        {{-- =================================================
             PROMOSI
        ================================================== --}}

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-title">
                        Total Promosi
                    </div>

                    <div class="stat-icon">
                        %
                    </div>

                </div>


                <div class="stat-number">
                    {{ $jumlahPromosi }}
                </div>


                <a
                    href="{{ route('admin.promosi.index') }}"
                    class="btn-stat"
                >
                    Lihat
                    <span>→</span>
                </a>

            </div>

        </div>


        {{-- =================================================
             PESANAN
        ================================================== --}}

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-title">
                        Total Pesanan
                    </div>

                    <div class="stat-icon">
                        🧾
                    </div>

                </div>


                <div class="stat-number">
                    {{ $jumlahPesanan }}
                </div>


                <a
                    href="{{ route('admin.pesanan.index') }}"
                    class="btn-stat"
                >
                    Lihat
                    <span>→</span>
                </a>

            </div>

        </div>

    </div>


    {{-- =====================================================
         STATUS PESANAN
    ====================================================== --}}

    <div class="status-card">


        {{-- HEADER --}}

        <div class="status-header">

            <h5>
                Status Pesanan
            </h5>

            <small>
                Ringkasan status pesanan pelanggan
            </small>

        </div>


        {{-- BODY --}}

        <div class="status-body">

            <div class="row g-3">


                {{-- =================================================
                     MENUNGGU
                ================================================== --}}

                <div class="col-md-6 col-xl-3">

                    <div class="status-item">

                        <div class="status-label">
                            Menunggu
                        </div>

                        <div class="status-number status-menunggu">
                            {{ $pesananMenunggu }}
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DIPROSES
                ================================================== --}}

                <div class="col-md-6 col-xl-3">

                    <div class="status-item">

                        <div class="status-label">
                            Diproses
                        </div>

                        <div class="status-number status-diproses">
                            {{ $pesananDiproses }}
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SELESAI
                ================================================== --}}

                <div class="col-md-6 col-xl-3">

                    <div class="status-item">

                        <div class="status-label">
                            Selesai
                        </div>

                        <div class="status-number status-selesai">
                            {{ $pesananSelesai }}
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DIBATALKAN
                ================================================== --}}

                <div class="col-md-6 col-xl-3">

                    <div class="status-item">

                        <div class="status-label">
                            Dibatalkan
                        </div>

                        <div class="status-number status-dibatalkan">
                            {{ $pesananDibatalkan }}
                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>


</div>

@endsection