<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangInOutController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanLaporanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SaldoController;
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
    Route::get('dashboard', [DashboardHomeController::class, 'index']);
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
            Route::get('barang/{id}/{status}', 'status')->name('barang.status');
            // cari
            Route::get('barang/search', 'search')->name('cari-barang');
            // tampilan tambah
            Route::get('barang/tambah', 'create')->name('tambah-barang');
            // // simpan tambah
            Route::post('barang/tambah/simpan', 'store')->name('simpan-barang');
            // // tampilan edit
            Route::get('barang/edit/{id}', 'edit')->name('edit-barang');
            Route::get('barang/edit-stok/{id}', 'editStok')->name('edit-barang.stok');
            // // simpan edit
            Route::post('barang/edit/{id}/update', 'update')->name('update-barang');
            Route::post('barang/edit-stok/{id}/update', 'updateStok')->name('update-barang.stok');
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
         // Route Penjualan
         Route::controller(PenjualanController::class)->group(function (){
            // index
            Route::get('penjualan', 'index')->name('penjualan');
            Route::get('penjualan/bayar/{id}', 'penjualanBayar')->name('penjualan.bayar');
            Route::get('penjualan/bayar-sukses/{id}', 'penjualanSukses')->name('penjualan.sukses');
            // edit 
            Route::get('penjualan/edit/{id}', 'edit')->name('penjualan.edit');
            // cetak
            Route::get('penjualan-struk/{id}', 'cetak')->name('penjualan.cetak');
            // edit tambah barang
            Route::post('penjualan/edit/tambah-barang', 'tambahItemAntrian')->name('penjualan.edit.add');
            // edit hapus barang
            Route::post('penjualan/edit/hapus', 'hapusItemAntrian')->name('penjualan.edit.delete');
            // check keranjang
            Route::post('penjualan/cart-check', 'checkKeranjang')->name('penjualan.cart-check');
            // tambah keranjang
            Route::post('penjualan/cart', 'tambahKeranjang')->name('penjualan.cart');
            // hapus keranjang
            Route::post('penjualan/cart-hapus', 'hapusKeranjang')->name('penjualan.cart-hapus');
            // simpan penjualan
            Route::post('penjualan/store', 'simpanKeranjang')->name('penjualan.store');
            // simpan ke laporan penjualan
            Route::post('penjualan/store/{id}', 'saveToLaporan2')->name('penjualan.store-selesai.p');
            Route::post('penjualan/edit/bayar/{id}', 'bayarOnline')->name('penjualan.store-selesai.online');


            Route::get('penjualan/store/{id}', 'saveToLaporan')->name('penjualan.store-selesai');
            // request
            Route::get('penjualan/cari-pelanggan', 'cariPelanggan')->name('penjualan.cari-pelanggan');
        });
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
     Route::group(['prefix' => 'laporan'], function () {
         // Route Barang Keluar
         Route::controller(BarangInOutController::class)->group(function (){
            // index
            Route::get('barang-in-out', 'index')->name('barang-in-out');
            // cari
            Route::get('barang-in-out/search', 'search')->name('cari-barang-in-out');
            // detail
            Route::get('barang-in-out/detail/{id}', 'show')->name('detail-barang-in-out');
        });
         // Route Laporan Penjualan
         Route::controller(PenjualanLaporanController::class)->group(function (){
            // index
            Route::get('penjualan', 'index')->name('laporan-penjualan');
            Route::get('penjualan/{tglawal}/{tglakhir}', 'indexDate')->name('laporan-penjualan.range');
            Route::get('penjualan-cetak/{tglawal}/{tglakhir}', 'cetak')->name('laporan-penjualan.cetak');
            Route::get('penjualan-cetak//', 'cetak2')->name('laporan-penjualan.cetak2');
            Route::get('penjualan/{id}', 'show')->name('laporan-penjualan.show');
            // cari
            // Route::get('barang-in-out/search', 'search')->name('cari-barang-in-out');
            // detail
            // Route::get('barang-in-out/detail/{id}', 'show')->name('detail-barang-in-out');
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
    Route::controller(LaporanController::class)->group(function (){
        // index harian
        Route::get('rekap-laporan-harian/{tanggal}', 'indexHarian')->name('laporan.harian');
        Route::get('rekap-laporan-bulanan/{bulan}/{tahun}', 'indexBulanan')->name('laporan.bulanan');
    });
    Route::controller(SaldoController::class)->group(function (){
        Route::get('saldo/{tanggal}', 'edit')->name('saldo.harian');
        Route::post('saldo-update/{tanggal}', 'update')->name('saldo.harian.update');
        Route::get('saldo-pengeluaran/{tanggal}', 'pengeluaran')->name('saldo.harian.pengeluaran');
        Route::post('saldo-pengeluaran-update/{tanggal}', 'updatePengeluaran')->name('saldo.harian.update.pengeluaran');
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
    // Route Profil
    Route::controller(ProfilController::class)->group(function (){
        // index
        Route::get('profile', 'index')->name('profile');
        // update profil
        Route::post('profile/update', 'updateProfil')->name('profile.update');
        // update akun
        Route::post('profile/update-akun', 'updateAkun')->name('profile.update-akun');
        // update foto
        Route::post('profile/update-foto', 'updateFoto')->name('profile.update-foto');
    });
    Route::controller(ConfigurationController::class)->group(function (){
        // index
        Route::get('konfigurasi', 'index')->name('konfigurasi');
        // // update profil
        Route::post('konfigurasi/update', 'updateCompanyProfile')->name('konfigurasi.update');
        // // update rekening
        Route::post('konfigurasi/update-rekening', 'updateCompanyRekening')->name('konfigurasi.update-rekening');
        // update logo
        Route::post('konfigurasi/update-logo', 'updateLogoPT')->name('konfigurasi.update-logo');
        // update member card
        Route::post('konfigurasi/update-member-card', 'updateMemberCard')->name('konfigurasi.update-member-card');
        // update logo nota
        Route::post('konfigurasi/update-logo-nota', 'updateLogoNota')->name('konfigurasi.update-logo-nota');
    });
    // logout request
    Route::post('logout-request', [AuthController::class, 'logout'])->name('request-logout');
});

Route::get('barang-masuk/tambah/cari',[BarangMasukController::class, 'searchBarang'])->name('tambah-barang-masuk.cari');
Route::get('penjualan/cari/barang',[PenjualanController::class, 'cariBarang'])->name('penjualan.cari-barang');
Route::get('penjualan/list/barang2',[PenjualanController::class, 'listBarang'])->name('penjualan.list-barang');
