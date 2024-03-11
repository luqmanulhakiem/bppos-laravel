<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaController;
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
