<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Harga;
use App\Models\Kategori;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan Data Keseluruhan.
     */
    public function index()
    {
        // mengambil semua data supplier dengan membaginya per 10 list data
        $data = Barang::with('kategori')->with('satuan')->with('harga')->latest()->paginate(10);

        
        // Alert Konfirmasi
        $title = 'Hapus Barang!';
        $text = "Apakah Kamu Yakin, data barang ini memiliki data harga?";
        confirmDelete($title, $text);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.barang.index', compact('data'));
    }

    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        
        $data = Barang::with('kategori')
        ->with('satuan')
        ->with('harga')
        ->where(function ($query) use ($param) {
            $query->where('nama', 'LIKE', '%' . $param . '%')
            ->orWhere('jenis', 'LIKE', '%' . $param . '%')
            ->orWhere('kode', 'LIKE', '%' . $param . '%')
            ->orWhereHas('satuan', function ($query) use ($param) {
                $query->where('nama', 'LIKE', '%' . $param . '%');
            })
            ->orWhereHas('kategori', function ($query) use ($param) {
                $query->where('nama', 'LIKE', '%' . $param . '%');
            });
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.barang.index', compact('data'));

    }

    /**
     * Tambah Supplier.
     */
    public function create()
    {
        $kategori = Kategori::get();
        $satuan = Unit::get();
        return view('dashboard.halaman.barang.create', compact(['kategori', 'satuan']));
    }

    /**
     * Simpan Data.
     */
    public function store(BarangRequest $request)
    {
        // Periksa Semua Data Inputan
        $data = $request->validated();

        $harga = Harga::create([]);
        if ($data['id_satuan'] == 3) {
            $data['jenis'] = 1;
        }else{
            $data['jenis'] = 2;
        }

        // membuat data supplier
        $simpan = Barang::create([
            'nama' => $data['nama'],
            'id_kategori' => $data['id_kategori'],
            'id_satuan' => $data['id_satuan'],
            'id_harga' => $harga->id,
            'jenis' => $data['jenis'],
            'stok' => $data['stok']
        ]);

        // cek kondisi simpan berhasil
        if ($simpan instanceof Model) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman barang
            return redirect()->route('barang');
        }

        // pesan gagal
        toastr()->error('Gagal');
        // redirect kembali
        return back();
    }

    // /**
    //  * Halaman Edit.
    //  */
    public function edit(string $id)
    {
        $kategori = Kategori::get();
        $satuan = Unit::get();

        // ambil data berdasarkan id
        $data = Barang::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.barang.edit', compact('data', 'kategori', 'satuan'));
    }
    public function editStok(string $id)
    {
        $kategori = Kategori::get();
        $satuan = Unit::get();

        // ambil data berdasarkan id
        $data = Barang::findorfail($id);
        // diarahkan ke halaman edit
        return view('dashboard.halaman.barang.edit-stok', compact('data', 'kategori', 'satuan'));
    }

    // /**
    //  * Simpan Hasil Edit.
    //  */
    public function update(BarangRequest $request, string $id)
    {
        // ambil data input
        $data = $request->validated();

        // cari data yang akan di edit berdasarkan id
        $find = Barang::where('id', $id)->first();

        if ($data['id_satuan'] == 3) {
            $data['jenis'] = 1;
        }else{
            $data['jenis'] = 2;
        }

        if ($find) {
            // List Perubahan Data
            $dt = [
                'nama' => $data['nama'],
                'id_kategori' => $data['id_kategori'],
                'id_satuan' => $data['id_satuan'],
                'jenis' => $data['jenis'],
                'stok' => $data['stok'],
            ];

            // Simpan Perubahan Data
            $update = $find->update($dt);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman barang
                return redirect()->route('barang');
            }

            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return back();
        }

    }
    public function updateStok(Request $request, string $id)
    {
        // ambil data input
        $stok = $request->stok;

        // cari data yang akan di edit berdasarkan id
        $find = Barang::where('id', $id)->first();

        if ($find) {
            // List Perubahan Data
            $dt = [
                'stok' => $stok,
            ];
            
            // Simpan Perubahan Data
            $update = $find->update($dt);

            if ($update) {
                // pesan sukses
                toastr()->success('Berhasil Mengubah Data');
                // redirect kehalaman barang
                return redirect()->route('barang');
            }

            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return back();
        }

    }

    // /**
    //  * Hapus Data.
    //  */
    public function destroy(string $id)
    {
        // cari data berdasarkan id
        $data = Barang::findorfail($id);
        // cari harga dan hapus
        Harga::findorfail($data->id_harga)->delete();

        // hapus data
        $data->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}

