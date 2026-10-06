<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Halaman tambah kategori
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Menyimpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Membuat ID kategori otomatis
        $kategoriTerakhir = Kategori::orderBy('id_kategori', 'desc')->first();

        if ($kategoriTerakhir) {
            $nomorTerakhir = (int) substr($kategoriTerakhir->id_kategori, 3);
            $nomorBaru = $nomorTerakhir + 1;
        } else {
            $nomorBaru = 1;
        }

        $idKategoriBaru = 'KAT' . str_pad(
            $nomorBaru,
            3,
            '0',
            STR_PAD_LEFT
        );

        // Upload gambar jika ada
        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store(
                'kategori',
                'public'
            );
        }

        // Simpan kategori
        Kategori::create([
            'id_kategori' => $idKategoriBaru,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman edit kategori
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Memperbarui kategori
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $kategori = Kategori::findOrFail($id);

        // Data yang akan diperbarui
        $data = [
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika user memilih gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if (
                $kategori->gambar &&
                Storage::disk('public')->exists($kategori->gambar)
            ) {
                Storage::disk('public')->delete($kategori->gambar);
            }

            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store(
                'kategori',
                'public'
            );
        }

        // Update kategori
        $kategori->update($data);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Hapus file gambar dari storage
        if (
            $kategori->gambar &&
            Storage::disk('public')->exists($kategori->gambar)
        ) {
            Storage::disk('public')->delete($kategori->gambar);
        }

        // Hapus data kategori
        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}