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
        $data = BarangInOut::with(['barang', 'penyuplai', 'user'])->where('status', 'masuk')->latest()->paginate(10);

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
        
        $data = BarangInOut::with(['barang', 'penyuplai', 'user'])->where('status', 'masuk')
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
    public function store(Request $request)
    {
        // Periksa Semua Data Inputan
        $tanggal = $request->tanggal;
        $id_barang = $request->id_barang;
        $id_penyuplai = $request->id_penyuplai;
        $id_user = auth()->user()->id;
        $ukuran = $request->ukuran;
        $ukuran_p = $request->ukuran_p;
        $ukuran_l = $request->ukuran_l;
        $kuantiti = $request->kuantiti;
        $keterangan = $request->keterangan;
        $jenis = $request->idJenis;
        $barang = Barang::where('id', $id_barang)->first();
        if ($jenis == 1) {
            $simpan = BarangInOut::create([
                'tanggal' => $tanggal,
                'id_barang' => $id_barang,
                'id_penyuplai' => $id_penyuplai,
                'id_user' => $id_user,
                'ukuran' => $ukuran,
                'kuantiti' => $kuantiti,
                'status' => 'masuk',
                'keterangan' => $keterangan,
            ]);

            $dt = [
                'stok' => $barang->stok + $kuantiti
            ];
            $barang->update($dt);
        } else {
            $simpan = BarangInOut::create([
                'tanggal' => $tanggal,
                'id_barang' => $id_barang,
                'id_penyuplai' => $id_penyuplai,
                'id_user' => $id_user,
                'ukuran_p' => $ukuran_p,
                'ukuran_l' => $ukuran_l,
                'kuantiti' => $kuantiti,
                'status' => 'masuk',
                'keterangan' => $keterangan,
            ]);
            $dt = [
                'stok_p' => $barang->stok_p + $ukuran_p,
                'stok_l' => $barang->stok_p + $ukuran_l,
            ];
            $barang->update($dt);
            
        }

        // cek kondisi simpan berhasil
        if ($simpan) {
            // pesan
            toastr()->success('Berhasil Menambahkan Data');
            // redirect kehalaman
            return redirect()->route('barang-masuk');
        }else {
            // pesan gagal
            toastr()->error('Gagal');
            // redirect kembali
            return redirect('/dashboard');
        }
    }

    public function show(string $id)
    {
        $detail = BarangInOut::with(['barang', 'penyuplai', 'user'])->where('id', $id)->where('status', 'masuk')->first();
        
        return response()->json($detail);
        // return view

    }

    public function destroy(string $id)
    {
        // cari barang dan hapus
        BarangInOut::findorfail($id)->delete();

        // pesan
        toastr()->warning('Berhasil Menghapus Data');

        // redirect ke halaman awal
        return back();
    }
}
