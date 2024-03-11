<?php

namespace App\Http\Controllers;

use App\Http\Requests\SatuanRequest;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data supplier dengan membaginya per 10 list data
        $data = Unit::paginate(10);

        
        // Alert Konfirmasi
        $title = 'Hapus Satuan!';
        $text = "Apakah Kamu Yakin?";
        confirmDelete($title, $text);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.satuan.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        $data = Unit::where('nama', 'LIKE', '%' . $param . '%')->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.satuan.index', compact('data'));

    }

    /**
     * Tambah Supplier.
     */
    public function create()
    {
        return view('dashboard.halaman.satuan.create');
    }

    /**
     * Simpan Data.
     */
    public function store(SatuanRequest $request)
    {
        // Periksa Semua Data Inputan
        $data = $request->validated();

        // membuat data supplier
        $simpan = Unit::create([
            'nama' => $data['nama'],
        ]);

        // cek kondisi simpan berhasil
        if ($simpan instanceof Model) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman
            return redirect()->route('satuan');
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
        $data = Unit::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.satuan.edit', compact('data'));
    }

    /**
     * Simpan Hasil Edit.
     */
    public function update(SatuanRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = Unit::where('id', $id)->first();

        if ($find) {
      
            // Simpan Perubahan Data
            $update = $find->update(['nama' => $data['nama']]);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman satuan
                return redirect()->route('satuan');
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
        $data = Unit::findorfail($id)->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}

