<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // =====================================================
    // PESANAN ADMIN
    // =====================================================

    public function index()
    {
        $pesanan = Pesanan::with([
            'pelanggan.user',
            'detailPesanan.produk'
        ])
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }


    // =====================================================
    // UPDATE STATUS PESANAN ADMIN
    // =====================================================

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pesanan' => 'required|in:menunggu,diproses,selesai,dibatalkan',
        ]);

        DB::transaction(function () use ($request, $id) {

            $pesanan = Pesanan::with('detailPesanan.produk')
                ->findOrFail($id);

            $statusLama = $pesanan->status_pesanan;
            $statusBaru = $request->status_pesanan;


            // =================================================
            // JIKA PESANAN DIBATALKAN
            // =================================================

            if (
                $statusBaru === 'dibatalkan' &&
                $statusLama !== 'dibatalkan'
            ) {

                foreach ($pesanan->detailPesanan as $detail) {

                    $produk = $detail->produk;

                    if ($produk) {

                        // Kembalikan stok
                        $produk->stok += $detail->jumlah;

                        // Jika sebelumnya stok habis,
                        // ubah kembali menjadi tersedia
                        if ($produk->stok > 0) {
                            $produk->status = 'tersedia';
                        }

                        $produk->save();
                    }
                }
            }


            // =================================================
            // SIMPAN STATUS PESANAN
            // =================================================

            $pesanan->status_pesanan = $statusBaru;

            $pesanan->save();
        });


        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }


    // =====================================================
    // SIMPAN PESANAN PELANGGAN
    // =====================================================

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:cod,qris',
        ]);


        $user = Auth::user();


        // Ambil data pelanggan berdasarkan user yang sedang login
        $pelanggan = $user->pelanggan;

        if (!$pelanggan) {

            return back()->withErrors([
                'pesanan' => 'Data pelanggan tidak ditemukan.'
            ]);
        }


        // Ambil produk
        $produk = Produk::findOrFail($request->id_produk);


        // =====================================================
        // CEK STOK
        // =====================================================

        if ($request->jumlah > $produk->stok) {

            return back()->withErrors([
                'jumlah' => 'Jumlah pesanan melebihi stok yang tersedia.'
            ]);
        }


        // =====================================================
        // HITUNG TOTAL
        // =====================================================

        $totalHarga = $produk->harga * $request->jumlah;


        DB::transaction(function () use (
            $request,
            $pelanggan,
            $produk,
            $totalHarga
        ) {

            // =================================================
            // MEMBUAT ID PESANAN
            // =================================================

            $pesananTerakhir = Pesanan::where(
                'id_pesanan',
                'like',
                'PSN%'
            )
                ->get()
                ->map(function ($pesanan) {

                    return (int) substr(
                        $pesanan->id_pesanan,
                        3
                    );
                })
                ->max();


            $nomorPesanan = ($pesananTerakhir ?? 0) + 1;


            $idPesanan = 'PSN' . str_pad(
                $nomorPesanan,
                3,
                '0',
                STR_PAD_LEFT
            );


            // =================================================
            // SIMPAN PESANAN
            // =================================================

            $pesanan = Pesanan::create([
                'id_pesanan' => $idPesanan,
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'tanggal_pesanan' => now(),
                'total_harga' => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pesanan' => 'menunggu',
                'catatan' => '',
            ]);


            // =================================================
            // MEMBUAT ID DETAIL PESANAN
            // =================================================

            $detailTerakhir = DetailPesanan::where(
                'id_detail',
                'like',
                'DTL%'
            )
                ->get()
                ->map(function ($detail) {

                    return (int) substr(
                        $detail->id_detail,
                        3
                    );
                })
                ->max();


            $nomorDetail = ($detailTerakhir ?? 0) + 1;


            $idDetail = 'DTL' . str_pad(
                $nomorDetail,
                3,
                '0',
                STR_PAD_LEFT
            );


            // =================================================
            // SIMPAN DETAIL PESANAN
            // =================================================

            DetailPesanan::create([
                'id_detail' => $idDetail,
                'id_pesanan' => $pesanan->id_pesanan,
                'id_produk' => $produk->id_produk,
                'jumlah' => $request->jumlah,
                'harga' => $produk->harga,
                'subtotal' => $totalHarga,
            ]);


            // =================================================
            // KURANGI STOK PRODUK
            // =================================================

            $produk->stok = $produk->stok - $request->jumlah;


            // Jika stok habis, ubah status menjadi habis
            if ($produk->stok <= 0) {

                $produk->stok = 0;
                $produk->status = 'habis';
            }


            $produk->save();
        });


        // =====================================================
        // REDIRECT
        // =====================================================

        return redirect()
            ->route('pelanggan.pesanan.berhasil')
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}
