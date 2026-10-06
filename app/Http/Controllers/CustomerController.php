<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Promosi;
use App\Models\Pesanan;

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

        if ($request->jumlah > $produk->stok) {
            return back()->withErrors([
                'jumlah' => 'Jumlah pesanan melebihi stok yang tersedia.'
            ]);
        }

        $subtotal = $produk->harga * $request->jumlah;

        return view('pelanggan.pembayaran', [
            'produk' => $produk,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'metodePembayaran' => $request->metode_pembayaran,
        ]);
    }

    public function kategori()
    {
        $kategori = Kategori::with('produk')->get();

        return view('pelanggan.kategori', compact('kategori'));
    }

    public function promo()
    {
        $promosi = Promosi::with('produk')
            ->where('status', 'aktif')
            ->get();

        return view('pelanggan.promo', compact('promosi'));
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
}
