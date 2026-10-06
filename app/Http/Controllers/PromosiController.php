<?php

namespace App\Http\Controllers;

use App\Models\Promosi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PromosiController extends Controller
{
    public function index()
    {
        $promosi = Promosi::with('produk')->get();
        $produk = Produk::all();

        return view('admin.promosi.index', compact('promosi', 'produk'));
    }

    public function create()
    {
        $produk = Produk::all();

        return view('admin.promosi.create', compact('produk'));
    }

    public function edit($id)
    {
        $promosi = Promosi::with('produk')->findOrFail($id);
        $produk = Produk::all();

        return view('admin.promosi.edit', compact('promosi', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promosi' => 'required|max:150',
            'deskripsi' => 'required',
            'jenis_diskon' => 'required|in:persen,nominal',
            'nilai_diskon' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'produk' => 'nullable|array',
            'produk.*' => 'exists:produk,id_produk',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Membuat ID Promosi
        |--------------------------------------------------------------------------
        */

        $promosiTerakhir = Promosi::where('id_promosi', 'like', 'PRM%')
            ->get()
            ->map(function ($promosi) {
                return (int) substr($promosi->id_promosi, 3);
            })
            ->max();

        $nomor = ($promosiTerakhir ?? 0) + 1;

        $idPromosi = 'PRM' . str_pad(
            $nomor,
            3,
            '0',
            STR_PAD_LEFT
        );

        /*
        |--------------------------------------------------------------------------
        | Upload Gambar
        |--------------------------------------------------------------------------
        */

        $gambar = $request->file('gambar')->store('promosi', 'public');

        /*
        |--------------------------------------------------------------------------
        | Simpan Promosi
        |--------------------------------------------------------------------------
        */

        $promosi = Promosi::create([
            'id_promosi' => $idPromosi,
            'nama_promosi' => $request->nama_promosi,
            'deskripsi' => $request->deskripsi,
            'jenis_diskon' => $request->jenis_diskon,
            'nilai_diskon' => $request->nilai_diskon,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'gambar' => $gambar,
            'status' => $request->status,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Hubungkan Produk dengan Promosi
        |--------------------------------------------------------------------------
        */

        $produkTerpilih = $request->produk ?? [];

        foreach ($produkTerpilih as $idProduk) {

            $idTerakhir = DB::table('produk_promosi')
                ->where('id_produk_promosi', 'like', 'PRP%')
                ->get()
                ->map(function ($item) {
                    return (int) substr($item->id_produk_promosi, 3);
                })
                ->max();

            $nomor = ($idTerakhir ?? 0) + 1;

            $idProdukPromosi = 'PRP' . str_pad(
                $nomor,
                3,
                '0',
                STR_PAD_LEFT
            );

            DB::table('produk_promosi')->insert([
                'id_produk_promosi' => $idProdukPromosi,
                'id_produk' => $idProduk,
                'id_promosi' => $promosi->id_promosi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        return redirect()
            ->route('admin.promosi.index')
            ->with('success', 'Promosi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $promosi = Promosi::findOrFail($id);

        $request->validate([
            'nama_promosi' => 'required|max:150',
            'deskripsi' => 'required',
            'jenis_diskon' => 'required|in:persen,nominal',
            'nilai_diskon' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'produk' => 'nullable|array',
            'produk.*' => 'exists:produk,id_produk',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Data Promosi
        |--------------------------------------------------------------------------
        */

        $promosi->nama_promosi = $request->nama_promosi;
        $promosi->deskripsi = $request->deskripsi;
        $promosi->jenis_diskon = $request->jenis_diskon;
        $promosi->nilai_diskon = $request->nilai_diskon;
        $promosi->tanggal_mulai = $request->tanggal_mulai;
        $promosi->tanggal_selesai = $request->tanggal_selesai;
        $promosi->status = $request->status;

        /*
        |--------------------------------------------------------------------------
        | Ganti Gambar Jika Ada
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

            if (
                $promosi->gambar &&
                Storage::disk('public')->exists($promosi->gambar)
            ) {
                Storage::disk('public')->delete($promosi->gambar);
            }

            $gambar = $request->file('gambar')->store(
                'promosi',
                'public'
            );

            $promosi->gambar = $gambar;
        }

        $promosi->save();

        /*
        |--------------------------------------------------------------------------
        | Update Produk yang Mendapatkan Promosi
        |--------------------------------------------------------------------------
        */

        DB::table('produk_promosi')
            ->where('id_promosi', $promosi->id_promosi)
            ->delete();

        $produkTerpilih = $request->produk ?? [];

        foreach ($produkTerpilih as $idProduk) {

            $idTerakhir = DB::table('produk_promosi')
                ->where('id_produk_promosi', 'like', 'PRP%')
                ->get()
                ->map(function ($item) {
                    return (int) substr($item->id_produk_promosi, 3);
                })
                ->max();

            $nomor = ($idTerakhir ?? 0) + 1;

            $idProdukPromosi = 'PRP' . str_pad(
                $nomor,
                3,
                '0',
                STR_PAD_LEFT
            );

            DB::table('produk_promosi')->insert([
                'id_produk_promosi' => $idProdukPromosi,
                'id_produk' => $idProduk,
                'id_promosi' => $promosi->id_promosi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()
            ->route('admin.promosi.index')
            ->with('success', 'Promosi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $promosi = Promosi::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Hapus Relasi Produk
        |--------------------------------------------------------------------------
        */

        $promosi->produk()->detach();

        /*
        |--------------------------------------------------------------------------
        | Hapus Gambar
        |--------------------------------------------------------------------------
        */

        if (
            $promosi->gambar &&
            Storage::disk('public')->exists($promosi->gambar)
        ) {
            Storage::disk('public')->delete($promosi->gambar);
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus Promosi
        |--------------------------------------------------------------------------
        */

        $promosi->delete();

        return redirect()
            ->route('admin.promosi.index')
            ->with('success', 'Promosi berhasil dihapus.');
    }
}
