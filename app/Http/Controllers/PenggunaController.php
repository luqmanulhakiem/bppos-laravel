<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data pengguna dengan membaginya per 10 list data
        $data = User::paginate(10);

        // Alert Konfirmasi
        $title = 'Hapus Pengguna!';
        $text = "Apakah Kamu Yakin?";
        confirmDelete($title, $text);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.pengguna.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        $data = User::where(function ($query) use ($param) {
            $query->where('username', 'LIKE', '%' . $param . '%')
            ->orWhere('name', 'LIKE', '%' . $param . '%')
            ->orWhere('telp', 'LIKE', '%' . $param . '%')
            ->orWhere('level', 'LIKE', '%' . $param . '%')
            ->orWhere('status', 'LIKE', '%' . $param . '%');
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.pengguna.index', compact('data'));

    }

    /**
     * Tambah pengguna.
     */
    public function create()
    {
        return view('dashboard.halaman.pengguna.create');
    }

    /**
     * Simpan Data.
     */
    public function store(PenggunaRequest $request)
    {
        // Periksa Semua Data Inputan
        $data = $request->validated();

        // membuat data
        $simpan = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        // cek kondisi simpan berhasil
        if ($simpan instanceof Model) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman
            return redirect()->route('pengguna');
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
        $data = User::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.pengguna.edit', compact('data'));
    }

    /**
     * Simpan Hasil Edit.
     */
    public function update(PenggunaRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = User::where('id', $id)->first();

        if ($find) {
            // List Perubahan Data
            $dt = [
                'username' => $data['username'],
                'name' => $data['name'],
                'telp' => $data['telp'],
                'level' => $data['level'],
            ];

            // Simpan Perubahan Data
            $update = $find->update($dt);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman
                return redirect()->route('pengguna');
            }

            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return back();
        }

    }
    /**
     * Update Status
     */
    public function updateStatus(Request $request, string $id)
    {
        // request
        $status = $request->status;

        // cari data yang akan di edit berdasarkan id
        $find = User::where('id', $id)->first();

        // perubahan status
        $dt = [
            'status' => $status
        ];

        // update status
        $find->update($dt);

        // notifikasi
        toastr()->success('Berhasil Mengubah Status');

        // kembali
        return redirect()->back();
    }

    /**
     * Hapus Data.
     */
    public function destroy(string $id)
    {
        // cari data dan hapus berdasarkan id
        User::findorfail($id)->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}
