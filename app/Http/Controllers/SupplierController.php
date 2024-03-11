<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSupplierRequest;
use App\Http\Requests\SimpanSupplierRequest;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data supplier dengan membaginya per 10 list data
        $data = Supplier::paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.penyuplai.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        $data = Supplier::where(function ($query) use ($param) {
            $query->where('nama', 'LIKE', '%' . $param . '%')
            ->orWhere('alamat', 'LIKE', '%' . $param . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $param . '%');
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.penyuplai.index', compact('data'));

    }

    /**
     * Tambah Supplier.
     */
    public function create()
    {
        return view('dashboard.halaman.penyuplai.create');
    }

    /**
     * Simpan Data.
     */
    public function store(SimpanSupplierRequest $request)
    {
        // Periksa Semua Data Inputan
        $data = $request->validated();

        // membuat data supplier
        $simpan = Supplier::create([
            'nama' => $data['nama'],
            'telp' => $data['telp'],
            'alamat' => $data['alamat'],
            'deskripsi' => $data['deskripsi'],
        ]);

        // cek kondisi simpan berhasil
        if ($simpan instanceof Model) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman penyuplai
            return redirect()->route('penyuplai');
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
        $data = Supplier::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.penyuplai.edit', compact('data'));
    }

    /**
     * Simpan Hasil Edit.
     */
    public function update(SimpanSupplierRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = Supplier::where('id', $id)->first();

        if ($find) {
            // List Perubahan Data
            $dt = [
                'nama' => $data['nama'],
                'telp' => $data['telp'],
                'alamat' => $data['alamat'],
                'deskripsi' => $data['deskripsi'],
            ];

            // Simpan Perubahan Data
            $update = $find->update($dt);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman penyuplai
                return redirect()->route('penyuplai');
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
        // cari data berdasarkan id
        $data = Supplier::findorfail($id);

        // hapus data
        $data->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}
