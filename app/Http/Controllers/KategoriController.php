<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data supplier dengan membaginya per 10 list data
        $data = Kategori::paginate(10);

        
        // Alert Konfirmasi
        $title = 'Hapus Kategori!';
        $text = "Apakah Kamu Yakin?";
        confirmDelete($title, $text);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.kategori.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        $data = Kategori::where('nama', 'LIKE', '%' . $param . '%')->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.kategori.index', compact('data'));

    }

    /**
     * Tambah Supplier.
     */
    public function create()
    {
        return view('dashboard.halaman.kategori.create');
    }

    /**
     * Simpan Data.
     */
    public function store(KategoriRequest $request)
    {
        // Periksa Semua Data Inputan
        $data = $request->validated();

        // membuat data supplier
        $simpan = Kategori::create([
            'nama' => $data['nama'],
        ]);

        // cek kondisi simpan berhasil
        if ($simpan instanceof Model) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman
            return redirect()->route('kategori');
        }

        // pesan gagal
        toastr()->error('Gagal');
        // redirect kembali
        return back();

    }

    /**
     * Halaman Edit.
     */
    public function edit(string $id)
    {
        // ambil data berdasarkan id
        $data = Kategori::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.kategori.edit', compact('data'));
    }

    /**
     * Simpan Hasil Edit.
     */
    public function update(KategoriRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = Kategori::where('id', $id)->first();

        if ($find) {
      
            // Simpan Perubahan Data
            $update = $find->update(['nama' => $data['nama']]);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman kategori
                return redirect()->route('kategori');
            }

            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return back();
        }

    }

    /**
     * Hapus Data.
     */
    public function destroy(string $id)
    {
        // cari data berdasarkan id lalu hapus
        $data = Kategori::findorfail($id)->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}
