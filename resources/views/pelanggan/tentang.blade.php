@extends('layouts.pelanggan')

@section('title', 'Tentang Toko')

@section('content')

    {{-- HEADER --}}
    <div class="mb-4">

        <h1 class="fw-bold mb-2">
            Tentang Toko
        </h1>

        <p class="text-muted mb-0">
            Kenali lebih dekat Toko Bintang Emas Mandiri.
        </p>

    </div>


    {{-- PROFIL TOKO --}}
    <div class="card border-0 shadow-sm overflow-hidden">

        <div class="row g-0">

            {{-- GAMBAR TOKO --}}
            <div class="col-md-5">

                <img
                    src="{{ asset('assets/images/toko.jpg') }}"
                    alt="Toko Bintang Emas Mandiri"
                    class="w-100 h-100"
                    style="min-height: 380px; object-fit: cover;"
                >

            </div>


            {{-- INFORMASI TOKO --}}
            <div class="col-md-7">

                <div class="card-body p-4 p-lg-5">

                    <h2 class="fw-bold mb-3">
                        Toko Bintang Emas Mandiri
                    </h2>


                    <p class="text-muted">
                        Toko Bangunan Bintang Emas Mandiri merupakan toko
                        yang menyediakan berbagai kebutuhan material dan
                        perlengkapan bangunan untuk masyarakat di wilayah
                        Kota Palu.
                    </p>

                    <p class="text-muted">
                        Kami menyediakan berbagai produk bangunan dengan
                        informasi nama produk, harga, foto, deskripsi, dan
                        status ketersediaan, sehingga pelanggan dapat melihat
                        barang yang tersedia sebelum menghubungi toko.
                    </p>

                    <p class="text-muted mb-4">
                        Melalui website ini, pelanggan dapat dengan mudah
                        mencari produk berdasarkan nama atau kategori,
                        melihat informasi promo, serta menghubungi admin
                        untuk melakukan pemesanan dan mendapatkan informasi
                        lebih lanjut.
                    </p>


                    <hr class="my-4">


                    {{-- ALAMAT --}}
                    <div class="d-flex align-items-start mb-3">

                        <div
                            class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                            style="width: 42px; height: 42px; flex-shrink: 0;"
                        >
                            <span>📍</span>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Alamat
                            </div>

                            <div class="text-muted">
                                Jl. Berdikari, Sunju, Kec. Marawola
                            </div>

                        </div>

                    </div>


                    {{-- JAM OPERASIONAL --}}
                    <div class="d-flex align-items-start">

                        <div
                            class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                            style="width: 42px; height: 42px; flex-shrink: 0;"
                        >
                            <span>🕐</span>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Jam Operasional
                            </div>

                            <div class="text-muted">
                                08.00 - 17.00
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection