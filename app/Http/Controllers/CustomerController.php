<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Promosi;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function beranda()
    {
        $produk = Produk::with('kategori')
            ->where('status', 'tersedia')
            ->latest()
            ->take(8)
            ->get();

        $kategori = Kategori::all();

        return view('pelanggan.beranda', compact('produk', 'kategori'));
    }

    public function produk(Request $request)
    {
        $query = Produk::with('kategori');

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        // Pencarian berdasarkan nama produk atau kategori
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($kategori) use ($search) {
                        $kategori->where(
                            'nama_kategori',
                            'like',
                            '%' . $search . '%'
                        );
                    });
            });
        }

        $produk = $query->latest()->get();
        $kategori = Kategori::all();

        return view('pelanggan.produk', compact(
            'produk',
            'kategori'
        ));
    }

    public function detailProduk($id)
    {
        // Ambil produk yang sedang dilihat
        $produk = Produk::with('kategori')
            ->findOrFail($id);

        // Ambil produk lain yang masih dalam kategori yang sama
        $produkLainnya = Produk::with('kategori')
            ->where('id_kategori', $produk->id_kategori)
            ->where('id_produk', '!=', $produk->id_produk)
            ->where('status', 'tersedia')
            ->latest()
            ->get();

        return view('pelanggan.detail-produk', compact(
            'produk',
            'produkLainnya'
        ));
    }

    public function checkout($id)
    {
        $produk = Produk::with('kategori')
            ->findOrFail($id);

        return view('pelanggan.checkout', compact('produk'));
    }


    public function pembayaran(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:cod,qris',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        if ($produk->status !== 'tersedia') {
            return back()->withErrors([
                'jumlah' => 'Produk sedang tidak tersedia.'
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

        // Harga asli tetap diambil dari database.
        $hargaAsli = (float) $produk->harga;
        $nilaiDiskon = 0;
        $hargaDiskon = $hargaAsli;

        if ($promoAktif) {
            if (in_array($promoAktif->jenis_diskon, ['persen', 'persentase'])) {
                $nilaiDiskon = $hargaAsli
                    * ((float) $promoAktif->nilai_diskon / 100);
            } else {
                $nilaiDiskon = (float) $promoAktif->nilai_diskon;
            }

            // Diskon tidak boleh negatif atau melebihi harga produk.
            $nilaiDiskon = min($hargaAsli, max(0, $nilaiDiskon));
            $hargaDiskon = $hargaAsli - $nilaiDiskon;
        }

        // Total dihitung dari harga setelah diskon.
        $subtotal = $hargaDiskon * (int) $request->jumlah;

        return view('pelanggan.pembayaran', [
            'produk' => $produk,
            'jumlah' => (int) $request->jumlah,
            'subtotal' => $subtotal,
            'metodePembayaran' => $request->metode_pembayaran,
            'promoAktif' => $promoAktif,
            'hargaAsli' => $hargaAsli,
            'hargaDiskon' => $hargaDiskon,
            'nilaiDiskon' => $nilaiDiskon,
        ]);
    }


    public function kategori()
    {
        $kategori = Kategori::with('produk')->get();

        return view('pelanggan.kategori', compact('kategori'));
    }


    public function promo()
    {
        $hariIni = now()->toDateString();

        $promosi = Promosi::with([
            'produk' => function ($query) {
                $query->where('status', 'tersedia');
            }
        ])
            ->where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', $hariIni)
            ->whereDate('tanggal_selesai', '>=', $hariIni)
            ->orderBy('tanggal_selesai', 'asc')
            ->get();

        return view('pelanggan.promo', compact('promosi'));
    }


    public function detailPromo($id)
    {
        $hariIni = now()->toDateString();

        $promosi = Promosi::with([
            'produk' => function ($query) {
                $query->where('produk.status', 'tersedia');
            }
        ])
            ->where('id_promosi', $id)
            ->where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', $hariIni)
            ->whereDate('tanggal_selesai', '>=', $hariIni)
            ->firstOrFail();

        // Sisakan produk yang benar-benar mendapat potongan harga.
        $produkPromo = $promosi->produk
            ->map(function ($produk) use ($promosi) {
                $hargaAsli = (float) $produk->harga;

                if (in_array($promosi->jenis_diskon, ['persen', 'persentase'])) {
                    $diskon = $hargaAsli
                        * ((float) $promosi->nilai_diskon / 100);
                } else {
                    $diskon = (float) $promosi->nilai_diskon;
                }

                $diskon = min($hargaAsli, max(0, $diskon));

                $produk->harga_asli = $hargaAsli;
                $produk->nilai_diskon = $diskon;
                $produk->harga_setelah_diskon = $hargaAsli - $diskon;

                return $produk;
            })
            ->filter(function ($produk) {
                return $produk->nilai_diskon > 0
                    && $produk->harga_setelah_diskon < $produk->harga_asli;
            })
            ->values();

        return view('pelanggan.detail-promo', [
            'promosi' => $promosi,
            'produkPromo' => $produkPromo,
        ]);
    }


    public function tentang()
    {
        return view('pelanggan.tentang');
    }

    public function profil()
    {
        return view('pelanggan.profil');
    }

    public function riwayatPesanan()
    {
        $pelanggan = Auth::user()->pelanggan;

        if (!$pelanggan) {
            return view('pelanggan.riwayat-pesanan', [
                'pesanan' => collect()
            ]);
        }

        $pesanan = Pesanan::with('detailPesanan.produk')
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('pelanggan.riwayat-pesanan', compact('pesanan'));
    }

    public function detailPesanan($id)
    {
        $pelanggan = Auth::user()->pelanggan;

        if (!$pelanggan) {
            abort(404);
        }

        $pesanan = Pesanan::with('detailPesanan.produk')
            ->where('id_pesanan', $id)
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->firstOrFail();

        return view('pelanggan.detail-pesanan', compact('pesanan'));
    }

    public function strukPesanan($id)
    {
        $pelanggan = Auth::user()->pelanggan;

        if (!$pelanggan) {
            abort(404);
        }

        $pesanan = Pesanan::with([
            'pelanggan.user',
            'detailPesanan.produk',
        ])
            ->where('id_pesanan', $id)
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->firstOrFail();

        return view('pelanggan.struk-pesanan', compact('pesanan'));
    }

    public function downloadStrukPdf($id)
    {
        $pelanggan = Auth::user()->pelanggan;

        if (!$pelanggan) {
            abort(404);
        }

        $pesanan = Pesanan::with([
            'pelanggan.user',
            'detailPesanan.produk',
        ])
            ->where('id_pesanan', $id)
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->firstOrFail();

        $pdf = Pdf::loadView(
            'pelanggan.struk-pdf',
            compact('pesanan')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'struk-' . $pesanan->id_pesanan . '.pdf'
        );
    }
}
