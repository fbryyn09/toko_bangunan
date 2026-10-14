<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;


// =====================================================
// AUTHENTICATION
// =====================================================

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');


// Register Pelanggan
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');


// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// =====================================================
// HALAMAN AWAL
// =====================================================

// Website harus login terlebih dahulu
Route::get('/', function () {
    return redirect()->route('login');
});


// =====================================================
// ADMIN
// =====================================================

// -----------------------------------------------------
// DASHBOARD ADMIN
// -----------------------------------------------------

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');


// -----------------------------------------------------
// KATEGORI
// -----------------------------------------------------

Route::get('/admin/kategori', [KategoriController::class, 'index'])
    ->middleware('auth')
    ->name('admin.kategori.index');

Route::get('/admin/kategori/create', [KategoriController::class, 'create'])
    ->middleware('auth')
    ->name('admin.kategori.create');

Route::post('/admin/kategori', [KategoriController::class, 'store'])
    ->middleware('auth')
    ->name('admin.kategori.store');

Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.kategori.edit');

Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])
    ->middleware('auth')
    ->name('admin.kategori.update');

Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.kategori.destroy');


// -----------------------------------------------------
// PRODUK
// -----------------------------------------------------

Route::get('/admin/produk', [ProdukController::class, 'index'])
    ->middleware('auth')
    ->name('admin.produk.index');

Route::get('/admin/produk/create', [ProdukController::class, 'create'])
    ->middleware('auth')
    ->name('admin.produk.create');

Route::post('/admin/produk', [ProdukController::class, 'store'])
    ->middleware('auth')
    ->name('admin.produk.store');

Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.produk.edit');

Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])
    ->middleware('auth')
    ->name('admin.produk.update');

Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.produk.destroy');


// -----------------------------------------------------
// PROMOSI
// -----------------------------------------------------

Route::get('/admin/promosi', [PromosiController::class, 'index'])
    ->middleware('auth')
    ->name('admin.promosi.index');

Route::get('/admin/promosi/create', [PromosiController::class, 'create'])
    ->middleware('auth')
    ->name('admin.promosi.create');

Route::post('/admin/promosi', [PromosiController::class, 'store'])
    ->middleware('auth')
    ->name('admin.promosi.store');

Route::get('/admin/promosi/{id}/edit', [PromosiController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.promosi.edit');

Route::put('/admin/promosi/{id}', [PromosiController::class, 'update'])
    ->middleware('auth')
    ->name('admin.promosi.update');

Route::delete('/admin/promosi/{id}', [PromosiController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.promosi.destroy');


// -----------------------------------------------------
// PESANAN
// -----------------------------------------------------

Route::get('/admin/pesanan', [PesananController::class, 'index'])
    ->middleware('auth')
    ->name('admin.pesanan.index');

Route::put('/admin/pesanan/{id}', [PesananController::class, 'update'])
    ->middleware('auth')
    ->name('admin.pesanan.update');


// =====================================================
// PELANGGAN
// =====================================================

// -----------------------------------------------------
// BERANDA PELANGGAN
// -----------------------------------------------------

Route::get('/pelanggan/beranda', [CustomerController::class, 'beranda'])
    ->middleware('auth')
    ->name('pelanggan.beranda');


// -----------------------------------------------------
// PRODUK
// -----------------------------------------------------

Route::get('/pelanggan/produk', [CustomerController::class, 'produk'])
    ->middleware('auth')
    ->name('pelanggan.produk');

// Detail Produk
Route::get('/pelanggan/produk/{id}', [CustomerController::class, 'detailProduk'])
    ->middleware('auth')
    ->name('pelanggan.detail-produk');

// -----------------------------------------------------
// CHECKOUT
// -----------------------------------------------------

Route::get('/pelanggan/checkout/{id}', [CustomerController::class, 'checkout'])
    ->middleware('auth')
    ->name('pelanggan.checkout');

// -----------------------------------------------------
// PEMBAYARAN
// -----------------------------------------------------

Route::post('/pelanggan/pembayaran', [CustomerController::class, 'pembayaran'])
    ->middleware('auth')
    ->name('pelanggan.pembayaran');

// -----------------------------------------------------
// PESANAN PELANGGAN
// -----------------------------------------------------

Route::post('/pelanggan/pesanan', [PesananController::class, 'store'])
    ->middleware('auth')
    ->name('pelanggan.pesanan.store');

Route::get('/pelanggan/pesanan/berhasil', function () {
    return view('pelanggan.pesanan-berhasil');
})
    ->middleware('auth')
    ->name('pelanggan.pesanan.berhasil');


// -----------------------------------------------------
// KATEGORI
// -----------------------------------------------------

Route::get('/pelanggan/kategori', [CustomerController::class, 'kategori'])
    ->middleware('auth')
    ->name('pelanggan.kategori');


// -----------------------------------------------------
// PROMO
// -----------------------------------------------------

Route::get('/pelanggan/promo', [CustomerController::class, 'promo'])
    ->middleware('auth')
    ->name('pelanggan.promo');


// -----------------------------------------------------
// TENTANG TOKO
// -----------------------------------------------------

Route::get('/pelanggan/tentang-toko', [CustomerController::class, 'tentang'])
    ->middleware('auth')
    ->name('pelanggan.tentang');


// -----------------------------------------------------
// PROFIL PELANGGAN
// -----------------------------------------------------

Route::get('/pelanggan/profil', [CustomerController::class, 'profil'])
    ->middleware('auth')
    ->name('pelanggan.profil');


Route::put('/pelanggan/profil', [AuthController::class, 'updateProfile'])->middleware('auth')->name('pelanggan.profil.update');

// -----------------------------------------------------
// RIWAYAT PESANAN
// -----------------------------------------------------

Route::get('/pelanggan/riwayat-pesanan', [CustomerController::class, 'riwayatPesanan'])
    ->middleware('auth')
    ->name('pelanggan.riwayat-pesanan');

// -----------------------------------------------------
// DETAIL PESANAN
// -----------------------------------------------------

Route::get('/pelanggan/riwayat-pesanan/{id}', [CustomerController::class, 'detailPesanan'])
    ->middleware('auth')
    ->name('pelanggan.detail-pesanan');

// -----------------------------------------------------
// STRUK PESANAN PELANGGAN
// -----------------------------------------------------

Route::get('/pelanggan/riwayat-pesanan/{id}/struk', [
    CustomerController::class,
    'strukPesanan'
])
    ->middleware('auth')
    ->name('pelanggan.struk-pesanan');

Route::get('/pelanggan/riwayat-pesanan/{id}/struk/pdf', [
    CustomerController::class,
    'downloadStrukPdf'
])
    ->middleware('auth')
    ->name('pelanggan.struk-pesanan.pdf');

// -----------------------------------------------------
// LAPORAN PENJUALAN
// -----------------------------------------------------

Route::get('/admin/laporan', [LaporanController::class, 'index'])
    ->middleware('auth')
    ->name('admin.laporan.index');

Route::get('/admin/laporan/pdf', [LaporanController::class, 'pdf'])
    ->middleware('auth')
    ->name('admin.laporan.pdf');
