<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganRequest;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data pelanggan dengan membaginya per 10 list data
        $data = Pelanggan::paginate(10);

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.pelanggan.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        $data = Pelanggan::where(function ($query) use ($param) {
            $query->where('nama', 'LIKE', '%' . $param . '%')
            ->orWhere('alamat', 'LIKE', '%' . $param . '%')
            ->orWhere('level', 'LIKE', '%' . $param . '%');
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.pelanggan.index', compact('data'));

    }

    /**
     * Tambah pelanggan.
     */
    public function create()
    {
        return view('dashboard.halaman.pelanggan.create');
    }

    /**
     * Simpan Data.
     */
    public function store(PelangganRequest $request)
    {
        // Periksa Semua Data Inputan
        $data = $request->validated();

        // membuat data pelanggan
        $simpan = Pelanggan::create([
            'nama' => $data['nama'],
            'gender' => $data['gender'],
            'telp' => $data['telp'],
            'alamat' => $data['alamat'],
            'level' => $data['level'],
        ]);

        // cek kondisi simpan berhasil
        if ($simpan instanceof Model) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman pelanggan
            return redirect()->route('pelanggan');
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
        $data = Pelanggan::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.pelanggan.edit', compact('data'));
    }

    /**
     * Simpan Hasil Edit.
     */
    public function update(PelangganRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = Pelanggan::where('id', $id)->first();

        if ($find) {
            // List Perubahan Data
            $dt = [
                'nama' => $data['nama'],
                'gender' => $data['gender'],
                'telp' => $data['telp'],
                'alamat' => $data['alamat'],
                'level' => $data['level'],
            ];

            // Simpan Perubahan Data
            $update = $find->update($dt);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman pelanggan
                return redirect()->route('pelanggan');
            }

            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return back();
        }

    }

    /**
     * Modal Delete 
     */
    public function modalDestroy(string $id)
    {
        $data = Pelanggan::findorfail($id);


        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('dashboard.halaman.pelanggan.index', compact('data'));
    }

    /**
     * Hapus Data.
     */
    public function destroy(string $id)
    {
        // cari data berdasarkan id
        $data = Pelanggan::findorfail($id);

        // hapus data
        $data->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}