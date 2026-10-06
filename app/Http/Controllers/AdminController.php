<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Promosi;
use App\Models\Pesanan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahProduk = Produk::count();
        $jumlahKategori = Kategori::count();
        $jumlahPromosi = Promosi::count();
        $jumlahPesanan = Pesanan::count();

        $pesananMenunggu = Pesanan::where('status_pesanan', 'menunggu')->count();
        $pesananDiproses = Pesanan::where('status_pesanan', 'diproses')->count();
        $pesananSelesai = Pesanan::where('status_pesanan', 'selesai')->count();
        $pesananDibatalkan = Pesanan::where('status_pesanan', 'dibatalkan')->count();

        return view('admin.dashboard', compact(
            'jumlahProduk',
            'jumlahKategori',
            'jumlahPromosi',
            'jumlahPesanan',
            'pesananMenunggu',
            'pesananDiproses',
            'pesananSelesai',
            'pesananDibatalkan'
        ));
    }
}