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
        $pelanggan = $user->pelanggan;

        if (!$pelanggan) {
            return back()->withErrors([
                'pesanan' => 'Data pelanggan tidak ditemukan.'
            ]);
        }

        // Ambil produk dan pastikan tersedia.
        $produk = Produk::findOrFail($request->id_produk);

        if ($produk->status !== 'tersedia') {
            return back()->withErrors([
                'pesanan' => 'Produk sedang tidak tersedia.'
            ]);
        }

        if ($request->jumlah > $produk->stok) {
            return back()->withErrors([
                'jumlah' => 'Jumlah pesanan melebihi stok yang tersedia.'
            ]);
        }

        // Cari promosi yang berlaku untuk produk ini.
        $hariIni = now()->toDateString();

        $promoAktif = $produk->promosi()
            ->where('promosi.status', 'aktif')
            ->whereDate('promosi.tanggal_mulai', '<=', $hariIni)
            ->whereDate('promosi.tanggal_selesai', '>=', $hariIni)
            ->orderBy('promosi.tanggal_selesai', 'asc')
            ->first();

        // Hitung harga satuan setelah diskon.
        $hargaAsli = (float) $produk->harga;
        $hargaDiskon = $hargaAsli;
        $nilaiDiskon = 0;

        if ($promoAktif) {
            if (in_array($promoAktif->jenis_diskon, ['persen', 'persentase'])) {
                $nilaiDiskon = $hargaAsli
                    * ((float) $promoAktif->nilai_diskon / 100);
            } else {
                // Jenis diskon selain persen dianggap nominal.
                $nilaiDiskon = (float) $promoAktif->nilai_diskon;
            }

            // Pastikan diskon tidak negatif atau melebihi harga asli.
            $nilaiDiskon = min($hargaAsli, max(0, $nilaiDiskon));
            $hargaDiskon = $hargaAsli - $nilaiDiskon;
        }

        // Total pesanan menggunakan harga setelah diskon.
        $jumlah = (int) $request->jumlah;
        $totalHarga = $hargaDiskon * $jumlah;

        DB::transaction(function () use (
            $request,
            $pelanggan,
            $produk,
            $jumlah,
            $hargaDiskon,
            $totalHarga
        ) {
            // Buat ID pesanan berikutnya.
            $pesananTerakhir = Pesanan::where(
                'id_pesanan',
                'like',
                'PSN%'
            )
                ->get()
                ->map(function ($pesanan) {
                    return (int) substr($pesanan->id_pesanan, 3);
                })
                ->max();

            $nomorPesanan = ($pesananTerakhir ?? 0) + 1;

            $idPesanan = 'PSN' . str_pad(
                $nomorPesanan,
                3,
                '0',
                STR_PAD_LEFT
            );

            // Simpan pesanan dengan total setelah diskon.
            $pesanan = Pesanan::create([
                'id_pesanan' => $idPesanan,
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'tanggal_pesanan' => now(),
                'total_harga' => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pesanan' => 'menunggu',
                'catatan' => '',
            ]);

            // Buat ID detail pesanan berikutnya.
            $detailTerakhir = DetailPesanan::where(
                'id_detail',
                'like',
                'DTL%'
            )
                ->get()
                ->map(function ($detail) {
                    return (int) substr($detail->id_detail, 3);
                })
                ->max();

            $nomorDetail = ($detailTerakhir ?? 0) + 1;

            $idDetail = 'DTL' . str_pad(
                $nomorDetail,
                3,
                '0',
                STR_PAD_LEFT
            );

            // Simpan harga satuan dan subtotal setelah diskon.
            DetailPesanan::create([
                'id_detail' => $idDetail,
                'id_pesanan' => $pesanan->id_pesanan,
                'id_produk' => $produk->id_produk,
                'jumlah' => $jumlah,
                'harga' => $hargaDiskon,
                'subtotal' => $totalHarga,
            ]);

            // Kurangi stok produk.
            $produk->stok = max(0, $produk->stok - $jumlah);

            if ($produk->stok <= 0) {
                $produk->status = 'habis';
            }

            $produk->save();
        });

        return redirect()
            ->route('pelanggan.pesanan.berhasil')
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}
