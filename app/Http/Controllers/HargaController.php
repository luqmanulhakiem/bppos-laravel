<?php

namespace App\Http\Controllers;

use App\Http\Requests\HargaRequest;
use App\Models\Barang;
use App\Models\Harga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data supplier dengan membaginya per 10 list data
        $data = Barang::with('harga')->with('kategori')->latest()->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.harga.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        $data = Barang::with('harga')->with('kategori')
        ->where(function ($query) use ($param) {
            $query->where('nama', 'LIKE', '%' . $param . '%')
            ->orWhereHas('kategori', function ($query) use ($param) {
                $query->where('nama', 'LIKE', '%' . $param . '%');
            })
            ->orWhereHas('harga', function ($query) use ($param) {
                $query->where('umum', 'LIKE', '%' . $param . '%')
                ->orWhere('reseller1', 'LIKE', '%' . $param . '%')
                ->orWhere('reseller2', 'LIKE', '%' . $param . '%')
                ->orWhere('reseller3', 'LIKE', '%' . $param . '%')
                ->orWhere('reseller4', 'LIKE', '%' . $param . '%');
            });
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.harga.index', compact('data'));

    }

    // /**
    //  * Halaman Edit.
    //  */
    public function edit(string $id)
    {
        // ambil data berdasarkan id
        $data = Barang::with('harga')->with('kategori')->where('id_harga', $id)->first();
        // diarahkan ke halaman edit
        return view('dashboard.halaman.harga.edit', compact('data'));
    }

    /**
     * Simpan Hasil Edit.
     */
    public function update(HargaRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = Harga::where('id', $id)->first();

        if ($find) {
            // List Perubahan Data
            $dt = [
                'umum' => $data['umum'],
                'reseller1' => $data['reseller1'],
                'reseller2' => $data['reseller2'],
                'reseller3' => $data['reseller3'],
                'reseller4' => $data['reseller4'],
            ];

            // Simpan Perubahan Data
            $update = $find->update($dt);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman harga
                return redirect()->route('harga');
            }

            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return back();
        }
    }
}
