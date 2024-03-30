<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

// login request
Route::post('login-request', [AuthController::class, 'login'])->name('request-login');

// Route Hanya bisa diakses apabila sudah login
Route::group(['middleware' => ['auth', 'statusAkun']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    });
    Route::group(['prefix' => 'produk'], function () {
        // Route Kategori
        Route::controller(KategoriController::class)->group(function (){
            // index
            Route::get('kategori', 'index')->name('kategori');
            // cari
            Route::get('kategori/search', 'search')->name('cari-kategori');
            // tampilan tambah
            Route::get('kategori/tambah', 'create')->name('tambah-kategori');
            // simpan tambah
            Route::post('kategori/tambah/simpan', 'store')->name('simpan-kategori');
            // tampilan edit
            Route::get('kategori/edit/{id}', 'edit')->name('edit-kategori');
            // simpan edit
            Route::post('kategori/edit/{id}/update', 'update')->name('update-kategori');
            // hapus
            Route::delete('kategori/hapus/{id}', 'destroy')->name('hapus-kategori');
        });
        // Route Satuan
        Route::controller(SatuanController::class)->group(function (){
            // index
            Route::get('satuan', 'index')->name('satuan');
            // cari
            Route::get('satuan/search', 'search')->name('cari-satuan');
            // tampilan tambah
            Route::get('satuan/tambah', 'create')->name('tambah-satuan');
            // simpan tambah
            Route::post('satuan/tambah/simpan', 'store')->name('simpan-satuan');
            // tampilan edit
            Route::get('satuan/edit/{id}', 'edit')->name('edit-satuan');
            // simpan edit
            Route::post('satuan/edit/{id}/update', 'update')->name('update-satuan');
            // hapus
            Route::delete('satuan/hapus/{id}', 'destroy')->name('hapus-satuan');
        });
        // Route Barang
        Route::controller(BarangController::class)->group(function (){
            // index
            Route::get('barang', 'index')->name('barang');
            // cari
            Route::get('barang/search', 'search')->name('cari-barang');
            // tampilan tambah
            Route::get('barang/tambah', 'create')->name('tambah-barang');
            // // simpan tambah
            Route::post('barang/tambah/simpan', 'store')->name('simpan-barang');
            // // tampilan edit
            Route::get('barang/edit/{id}', 'edit')->name('edit-barang');
            // // simpan edit
            Route::post('barang/edit/{id}/update', 'update')->name('update-barang');
            // // hapus
            Route::delete('barang/hapus/{id}', 'destroy')->name('hapus-barang');
        });
        // Route harga
        Route::controller(HargaController::class)->group(function (){
            // index
            Route::get('harga', 'index')->name('harga');
            // cari
            Route::get('harga/search', 'search')->name('cari-harga');
            // // tampilan edit
            Route::get('harga/edit/{id}', 'edit')->name('edit-harga');
            // // simpan edit
            Route::post('harga/edit/{id}/update', 'update')->name('update-harga');
        });
    });
    Route::group(['prefix' => 'transaksi'], function () {
         // Route Barang Masuk
         Route::controller(BarangMasukController::class)->group(function (){
            // index
            Route::get('barang-masuk', 'index')->name('barang-masuk');
            // cari
            Route::get('barang-masuk/search', 'search')->name('cari-barang-masuk');
            // tampilan tambah
            Route::get('barang-masuk/tambah', 'create')->name('tambah-barang-masuk');
            // simpan tambah
            Route::post('barang-masuk/store', 'store')->name('simpan-barang-masuk');
            // detail
            Route::get('barang-masuk/detail/{id}', 'show')->name('detail-barang-masuk');
            // hapus
            Route::delete('barang-masuk/hapus/{id}', 'destroy')->name('hapus-barang-masuk');
        });
         // Route Barang Keluar
         Route::controller(BarangKeluarController::class)->group(function (){
            // index
            Route::get('barang-keluar', 'index')->name('barang-keluar');
            // cari
            Route::get('barang-keluar/search', 'search')->name('cari-barang-keluar');
            // tampilan tambah
            Route::get('barang-keluar/tambah', 'create')->name('tambah-barang-keluar');
            // simpan tambah
            Route::post('barang-keluar/store', 'store')->name('simpan-barang-keluar');
            // detail
            Route::get('barang-keluar/detail/{id}', 'show')->name('detail-barang-keluar');
            // hapus
            Route::delete('barang-keluar/hapus/{id}', 'destroy')->name('hapus-barang-keluar');
        });
    });
    // Route Supplier
    Route::controller(SupplierController::class)->group(function (){
        // index
        Route::get('penyuplai', 'index')->name('penyuplai');
        // cari
        Route::get('penyuplai/search', 'search')->name('cari-penyuplai');
        // tampilan tambah
        Route::get('penyuplai/tambah', 'create')->name('tambah-penyuplai');
        // simpan tambah
        Route::post('penyuplai/tambah/simpan', 'store')->name('simpan-penyuplai');
        // tampilan edit
        Route::get('penyuplai/edit/{id}', 'edit')->name('edit-penyuplai');
        // simpan edit
        Route::post('penyuplai/edit/{id}/update', 'update')->name('update-penyuplai');
        // hapus
        Route::delete('penyuplai/hapus/{id}', 'destroy')->name('hapus-penyuplai');
    });
    // Route Pelanggan
    Route::controller(PelangganController::class)->group(function (){
        // index
        Route::get('pelanggan', 'index')->name('pelanggan');
        // cari
        Route::get('pelanggan/search', 'search')->name('cari-pelanggan');
        // tampilan tambah
        Route::get('pelanggan/tambah', 'create')->name('tambah-pelanggan');
        // simpan tambah
        Route::post('pelanggan/tambah/simpan', 'store')->name('simpan-pelanggan');
        // tampilan edit
        Route::get('pelanggan/edit/{id}', 'edit')->name('edit-pelanggan');
        // simpan edit
        Route::post('pelanggan/edit/{id}/update', 'update')->name('update-pelanggan');
        // hapus
        Route::delete('pelanggan/hapus/{id}', 'destroy')->name('hapus-pelanggan');
    });
    // Route Pengguna
    Route::controller(PenggunaController::class)->group(function (){
        // index
        Route::get('pengguna', 'index')->name('pengguna');
        // cari
        Route::get('pengguna/search', 'search')->name('cari-pengguna');
        // tampilan tambah
        Route::get('pengguna/tambah', 'create')->name('tambah-pengguna');
        // simpan tambah
        Route::post('pengguna/tambah/simpan', 'store')->name('simpan-pengguna');
        // tampilan edit
        Route::get('pengguna/edit/{id}', 'edit')->name('edit-pengguna');
        // simpan edit
        Route::post('pengguna/edit/{id}/update', 'update')->name('update-pengguna');
        Route::post('pengguna/status/{id}/update', 'updateStatus')->name('status-pengguna');
        Route::get('pengguna/password/{id}', 'changePass')->name('ganti.password-pengguna');
        Route::post('pengguna/password/{id}/update', 'updatePass')->name('password-pengguna');
        // hapus
        Route::delete('pengguna/hapus/{id}', 'destroy')->name('hapus-pengguna');
    });
    // logout request
    Route::post('logout-request', [AuthController::class, 'logout'])->name('request-logout');
});

Route::get('barang-masuk/tambah/cari',[BarangMasukController::class, 'searchBarang'])->name('tambah-barang-masuk.cari');
