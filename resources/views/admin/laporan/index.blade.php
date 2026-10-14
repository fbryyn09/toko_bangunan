@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
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
@endphp

<style>
    .laporan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .laporan-header h1 {
        font-size: 26px;
        font-weight: 750;
        color: #222;
        margin-bottom: 6px;
    }

    .laporan-muted {
        color: #888;
        font-size: 13px;
        margin-bottom: 0;
    }

    .laporan-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 22px;
    }

    .laporan-card-title {
        font-weight: 700;
        margin-bottom: 18px;
        color: #292929;
    }

    .laporan-label {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
        color: #555;
    }

    .laporan-control {
        width: 100%;
        min-height: 42px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 8px 11px;
        background: #fff;
    }

    .laporan-control:focus {
        border-color: #f6c344;
        outline: 2px solid #fff0c2;
    }

    .laporan-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 10px 16px;
        border: 0;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .laporan-btn-filter {
        background: #f6c344;
        color: #222;
    }

    .laporan-btn-filter:hover {
        background: #eab52f;
        color: #222;
    }

    .laporan-btn-pdf {
        background: #292929;
        color: #fff;
    }

    .laporan-btn-pdf:hover {
        background: #444;
        color: #fff;
    }

    .laporan-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 22px;
    }

    .laporan-summary-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 22px;
        border-left: 4px solid #f6c344;
    }

    .laporan-summary-label {
        font-size: 13px;
        color: #888;
        margin-bottom: 10px;
    }

    .laporan-summary-value {
        font-size: 25px;
        font-weight: 750;
        color: #222;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .laporan-table-wrap {
        overflow-x: auto;
    }

    .laporan-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .laporan-table th {
        padding: 14px 12px;
        text-align: left;
        background: #faf9f5;
        color: #666;
        font-size: 12px;
        white-space: nowrap;
        border-bottom: 1px solid #eee;
    }

    .laporan-table td {
        padding: 14px 12px;
        font-size: 13px;
        color: #444;
        border-bottom: 1px solid #f0f0f0;
    }

    .laporan-table tbody tr:hover {
        background: #fffdf6;
    }

    .laporan-status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #e5f5e9;
        color: #24753b;
        font-size: 11px;
        font-weight: 700;
    }

    .laporan-empty {
        text-align: center;
        padding: 36px 15px !important;
        color: #888 !important;
    }

    @media (max-width: 600px) {
        .laporan-summary {
            grid-template-columns: 1fr;
        }

        .laporan-header h1 {
            font-size: 22px;
        }

        .laporan-card {
            padding: 16px;
        }
    }

    @media print {
        .laporan-header-actions,
        .laporan-filter-card {
            display: none !important;
        }
    }
</style>

<div class="laporan-header">
    <div>
        <h1>Laporan Penjualan</h1>
        <p class="laporan-muted">
            Rekapitulasi penjualan Toko Bangunan Bintang Emas Mandiri.
        </p>
    </div>

    <div class="laporan-header-actions">
        <a
            href="{{ route('admin.laporan.pdf', [
                'jenis' => $filter['jenis'],
                'bulan' => $filter['bulan'],
                'tahun' => $filter['tahun'],
            ]) }}"
            class="laporan-btn laporan-btn-pdf"
        >
            <i class="bi bi-file-earmark-pdf"></i>
            Cetak Laporan
        </a>
    </div>
</div>

<div class="laporan-card laporan-filter-card">
    <h5 class="laporan-card-title">Filter Periode Laporan</h5>

    <form action="{{ route('admin.laporan.index') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="jenis" class="laporan-label">
                    Jenis Laporan
                </label>
                <select
                    name="jenis"
                    id="jenis"
                    class="laporan-control"
                    onchange="toggleBulan()"
                >
                    <option
                        value="bulanan"
                        {{ $filter['jenis'] === 'bulanan' ? 'selected' : '' }}
                    >
                        Bulanan
                    </option>
                    <option
                        value="tahunan"
                        {{ $filter['jenis'] === 'tahunan' ? 'selected' : '' }}
                    >
                        Tahunan
                    </option>
                </select>
            </div>

            <div class="col-md-4" id="kolomBulan">
                <label for="bulan" class="laporan-label">Bulan</label>
                <select
                    name="bulan"
                    id="bulan"
                    class="laporan-control"
                >
                    @foreach ($namaBulan as $nomor => $nama)
                        <option
                            value="{{ $nomor }}"
                            {{ (int) $filter['bulan'] === $nomor ? 'selected' : '' }}
                        >
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="tahun" class="laporan-label">Tahun</label>
                <select
                    name="tahun"
                    id="tahun"
                    class="laporan-control"
                >
                    @for ($tahun = now()->year; $tahun >= now()->year - 10; $tahun--)
                        <option
                            value="{{ $tahun }}"
                            {{ (int) $filter['tahun'] === $tahun ? 'selected' : '' }}
                        >
                            {{ $tahun }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="laporan-btn laporan-btn-filter">
                    <i class="bi bi-search"></i>
                    Tampilkan Laporan
                </button>
            </div>
        </div>
    </form>
</div>

<div class="laporan-summary">
    <div class="laporan-summary-card">
        <div class="laporan-summary-label">
            Total Pesanan Selesai
        </div>
        <p class="laporan-summary-value">
            {{ number_format($totalPesanan, 0, ',', '.') }}
            <span style="font-size: 13px; font-weight: 500;">pesanan</span>
        </p>
    </div>

    <div class="laporan-summary-card">
        <div class="laporan-summary-label">
            Total Pendapatan
        </div>
        <p class="laporan-summary-value">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </p>
    </div>
</div>

<div class="laporan-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h5 class="laporan-card-title mb-1">
                Rincian Penjualan
            </h5>

            <p class="laporan-muted">
                Periode:
                <strong>
                    @if ($filter['jenis'] === 'bulanan')
                        {{ $namaBulan[$filter['bulan']] }}
                    @else
                        Tahunan
                    @endif
                    {{ $filter['tahun'] }}
                </strong>
            </p>
        </div>

        <span class="laporan-muted">
            {{ $totalPesanan }} transaksi selesai
        </span>
    </div>

    <div class="laporan-table-wrap">
        <table class="laporan-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Pesanan</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Penjualan</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->id_pesanan }}</strong></td>
                        <td>
                            {{ $item->tanggal_pesanan
                                ? $item->tanggal_pesanan->format('d-m-Y H:i')
                                : '-' }}
                        </td>
                        <td>
                            {{ optional(optional($item->pelanggan)->user)->nama
                                ?? 'Pelanggan tidak tersedia' }}
                        </td>
                        <td>{{ strtoupper($item->metode_pembayaran) }}</td>
                        <td>
                            <strong>
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td>
                            <span class="laporan-status">Selesai</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="laporan-empty">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Tidak ada penjualan selesai pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            @if ($totalPesanan > 0)
                <tfoot>
                    <tr style="background: #fff8e6;">
                        <td colspan="5" style="text-align: right; font-weight: 700;">
                            Total Pendapatan
                        </td>
                        <td colspan="2" style="font-weight: 750; color: #805c00;">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>

<script>
    function toggleBulan() {
        const jenis = document.getElementById('jenis').value;
        const kolomBulan = document.getElementById('kolomBulan');
        const bulan = document.getElementById('bulan');

        kolomBulan.style.display = jenis === 'bulanan' ? '' : 'none';
        bulan.disabled = jenis !== 'bulanan';
    }

    document.addEventListener('DOMContentLoaded', toggleBulan);
</script>
@endsection