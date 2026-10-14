<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $this->validasiFilter($request);

        $laporan = $this->queryLaporan($filter)
            ->with(['pelanggan.user'])
            ->orderBy('tanggal_pesanan', 'asc')
            ->get();

        $totalPesanan = $laporan->count();
        $totalPendapatan = $laporan->sum('total_harga');

        return view('admin.laporan.index', compact(
            'laporan',
            'totalPesanan',
            'totalPendapatan',
            'filter'
        ));
    }

    public function pdf(Request $request)
    {
        $filter = $this->validasiFilter($request);

        $laporan = $this->queryLaporan($filter)
            ->with(['pelanggan.user'])
            ->orderBy('tanggal_pesanan', 'asc')
            ->get();

        $totalPesanan = $laporan->count();
        $totalPendapatan = $laporan->sum('total_harga');

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'laporan',
            'totalPesanan',
            'totalPendapatan',
            'filter'
        ))->setPaper('a4', 'landscape');

        $namaPeriode = $filter['jenis'] === 'bulanan'
            ? $filter['tahun'] . '-' . $filter['bulan']
            : $filter['tahun'];

        return $pdf->download(
            'laporan-penjualan-' . $namaPeriode . '.pdf'
        );
    }

    private function validasiFilter(Request $request): array
    {
        $data = $request->validate([
            'jenis' => 'nullable|in:bulanan,tahunan',
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'nullable|integer|min:2000|max:2100',
        ]);

        return [
            'jenis' => $data['jenis'] ?? 'bulanan',
            'bulan' => (int) ($data['bulan'] ?? now()->month),
            'tahun' => (int) ($data['tahun'] ?? now()->year),
        ];
    }

    private function queryLaporan(array $filter)
    {
        return Pesanan::query()
            ->where('status_pesanan', 'selesai')
            ->when(
                $filter['jenis'] === 'bulanan',
                function ($query) use ($filter) {
                    $query->whereMonth(
                        'tanggal_pesanan',
                        $filter['bulan']
                    )->whereYear(
                        'tanggal_pesanan',
                        $filter['tahun']
                    );
                }
            )
            ->when(
                $filter['jenis'] === 'tahunan',
                function ($query) use ($filter) {
                    $query->whereYear(
                        'tanggal_pesanan',
                        $filter['tahun']
                    );
                }
            );
    }
}