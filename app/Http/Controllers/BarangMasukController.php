<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangInOut;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        $data = BarangInOut::with(['barang', 'penyuplai', 'user'])->where('keterangan', 'masuk')->latest()->paginate(10);

        // Alert Konfirmasi
        $title = 'Hapus Barang Masuk!';
        $text = "Apakah Kamu Yakin, data barang masuk berelasi dengan data lain?";
        confirmDelete($title, $text);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.barangMasuk.index', compact('data'));
    }

    
    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        
        $data = BarangInOut::with(['barang', 'penyuplai', 'user'])->where('keterangan', 'masuk')
        ->where(function ($query) use ($param) {
            $query->where('tanggal', 'LIKE', '%' . $param . '%')
            ->orWhere('kuantiti', 'LIKE', '%' . $param . '%')
            ->orWhereHas('barang', function ($query) use ($param) {
                $query->where('nama', 'LIKE', '%' . $param . '%');
            });
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.barangMasuk.index', compact('data'));

    }

    /**
     * Tambah.
     */
    public function create()
    {
        $barang = Barang::paginate(10);
        $penyuplai = Supplier::get();
        return view('dashboard.halaman.barangMasuk.create', compact(['barang', 'penyuplai']));
    }

    public function searchBarang(Request $request)
    {
        $keyword = $request->input('param');
        $barang = Barang::where('nama', 'LIKE', "%$keyword%")->paginate(10);
        return view('dashboard.halaman.barangMasuk.barang-list', compact('barang'));
    }

    /**
     * Simpan Data.
     */
    // public function store(KategoriRequest $request)
    // {
    //     // Periksa Semua Data Inputan
    //     $data = $request->validated();

    //     // membuat data supplier
    //     $simpan = Kategori::create([
    //         'nama' => $data['nama'],
    //     ]);

    //     // cek kondisi simpan berhasil
    //     if ($simpan instanceof Model) {
    //         // pesan
    //         toastr()->success('Berhasil Menambahkan Data');
    //         // redirect kehalaman
    //         return redirect()->route('kategori');
    //     }

    //     // pesan gagal
    //     toastr()->error('Gagal');
    //     // redirect kembali
    //     return back();

    // }
}
