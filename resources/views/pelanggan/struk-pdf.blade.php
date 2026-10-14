<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk {{ $pesanan->id_pesanan }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5c341;
        }

        .logo {
            display: block;
            width: 100px;
            height: auto;
            margin: 0 auto 10px;
        }

        .header h2 {
            margin: 0 0 5px;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            margin: 18px 0 8px;
        }

        .info {
            width: 100%;
            margin-bottom: 15px;
        }

        .info td {
            padding: 5px 0;
            vertical-align: top;
        }

        table.products {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .products th,
        .products td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .products th {
            background-color: #fff7d6;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 15px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>

<body>

    {{-- HEADER TOKO DAN LOGO --}}
    <div class="header">

        <img
            src="{{ public_path('assets/images/logo.png') }}"
            class="logo"
            alt="Logo Toko Bintang Jaya Emas"
        >

        <p>Struk Pemesanan Produk</p>

    </div>

    {{-- INFORMASI PESANAN --}}
    <div class="section-title">Informasi Pesanan</div>

    <table class="info">
        <tr>
            <td width="25%">No. Pesanan</td>
            <td>: {{ $pesanan->id_pesanan }}</td>
        </tr>

        <tr>
            <td>Tanggal Pesanan</td>
            <td>: {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d-m-Y H:i') }}</td>
        </tr>

        <tr>
            <td>Nama Pelanggan</td>
            <td>: {{ optional(optional($pesanan->pelanggan)->user)->nama ?? '-' }}</td>
        </tr>

        <tr>
            <td>Metode Pembayaran</td>
            <td>: {{ strtoupper($pesanan->metode_pembayaran) }}</td>
        </tr>

        <tr>
            <td>Status Pesanan</td>
            <td>: {{ ucfirst($pesanan->status_pesanan) }}</td>
        </tr>
    </table>

    {{-- RINCIAN PRODUK --}}
    <div class="section-title">Rincian Produk</div>

    <table class="products">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pesanan->detailPesanan as $detail)
                <tr>
                    <td>
                        {{ $detail->produk->nama_produk ?? 'Produk tidak tersedia' }}
                    </td>

                    <td>
                        {{ $detail->jumlah }}
                        {{ $detail->produk->satuan ?? '' }}
                    </td>

                    <td>
                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                    </td>

                    <td>
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total">
        Total Pesanan:
        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <p>Terima kasih telah berbelanja di Toko Bangunan Bintang Jaya Emas.</p>
        <p>Simpan struk ini sebagai bukti pemesanan.</p>
    </div>

</body>
</html>