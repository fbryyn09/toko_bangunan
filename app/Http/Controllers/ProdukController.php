<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $kategori = Kategori::all();

        return view('admin.produk.index', compact('produk', 'kategori'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('admin.produk.create', compact('kategori'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();

        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required|max:100',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|max:30',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tersedia,habis',
        ]);

        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->satuan = $request->satuan;
        $produk->status = $request->status;

        if ($request->hasFile('gambar')) {

            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $gambar = $request->file('gambar')->store('produk', 'public');

            $produk->gambar = $gambar;
        }

        $produk->save();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required|max:100',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|max:30',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tersedia,habis',
        ]);


        $produkTerakhir = Produk::where('id_produk', 'like', 'PRD%')
            ->get()
            ->map(function ($produk) {
                return (int) substr($produk->id_produk, 3);
            })
            ->max();

        $nomor = ($produkTerakhir ?? 0) + 1;

        $idProduk = 'PRD' . str_pad($nomor, 3, '0', STR_PAD_LEFT);

        $gambar = $request->file('gambar')->store('produk', 'public');

        Produk::create([
            'id_produk' => $idProduk,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'gambar' => $gambar,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }
}
