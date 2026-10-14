<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #c99a20;
            padding-bottom: 12px;
        }

        .header h2 {
            margin: 0 0 6px;
            font-size: 17px;
        }

        .header p {
            margin: 3px 0;
            color: #555;
        }

        .summary {
            width: 100%;
            margin-bottom: 18px;
        }

        .summary td {
            border: 1px solid #ddd;
            padding: 10px;
            width: 50%;
        }

        .summary-label {
            color: #666;
            font-size: 9px;
        }

        .summary-value {
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th {
            background: #f6c344;
            color: #222;
            padding: 9px 6px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table.data td {
            padding: 8px 6px;
            border: 1px solid #ddd;
        }

        .total-row {
            background: #fff5d8;
            font-weight: bold;
        }

        .footer {
            margin-top: 22px;
            text-align: right;
            color: #666;
            font-size: 9px;
        }
    </style>
</head>

<body>

    @php
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $periode =
            $filter['jenis'] === 'bulanan'
                ? $namaBulan[$filter['bulan']] . ' ' . $filter['tahun']
                : 'Tahun ' . $filter['tahun'];
    @endphp

    <div class="header">
        <h2>TOKO BANGUNAN BINTANG EMAS MANDIRI</h2>
        <p>LAPORAN PENJUALAN</p>
        <p>Periode: {{ $periode }}</p>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="summary-label">Total Pesanan Selesai</div>
                <div class="summary-value">
                    {{ number_format($totalPesanan, 0, ',', '.') }} pesanan
                </div>
            </td>
            <td>
                <div class="summary-label">Total Pendapatan</div>
                <div class="summary-value">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Pesanan</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Pembayaran</th>
                <th>Total Penjualan</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_pesanan }}</td>
                    <td>
                        {{ $item->tanggal_pesanan ? $item->tanggal_pesanan->format('d-m-Y H:i') : '-' }}
                    </td>
                    <td>
                        {{ optional(optional($item->pelanggan)->user)->nama ?? 'Pelanggan tidak tersedia' }}
                    </td>
                    <td>{{ strtoupper($item->metode_pembayaran) }}</td>
                    <td>
                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                    </td>
                    <td>Selesai</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">
                        Tidak ada penjualan selesai pada periode ini.
                    </td>
                </tr>
            @endforelse

            @if ($totalPesanan > 0)
                <tr class="total-row">
                    <td colspan="5" style="text-align: right;">
                        TOTAL PENDAPATAN
                    </td>
                    <td colspan="2">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>

</body>

</html>
