<?php

namespace App\Http\Controllers;

use App\Models\BarangInOut;
use Illuminate\Http\Request;

class BarangInOutController extends Controller
{
    public function index()
    {
        $data = BarangInOut::with(['barang', 'penyuplai', 'user'])->latest()->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.barangLaporan.index', compact('data'));
    }
    
    /**
    * Menampilkan data berdasarkan pencarian
    **/
    public function search(Request $request)
    {
        $param = $request->param;
        // cari data berdasarkan param
        
        $data = BarangInOut::with(['barang', 'penyuplai', 'user'])
        ->where(function ($query) use ($param) {
            $query->where('tanggal', 'LIKE', '%' . $param . '%')
            ->orWhere('kuantiti', 'LIKE', '%' . $param . '%')
            ->orWhereHas('barang', function ($query) use ($param) {
                $query->where('nama', 'LIKE', '%' . $param . '%');
            });
        })->paginate(10);

        // menampilkan data yang sudah diambil ke tampilan
        return view('dashboard.halaman.barangLaporan.index', compact('data'));
    }

    public function show(string $id)
    {
        $detail = BarangInOut::with(['barang', 'penyuplai', 'user'])->where('id', $id)->first();
        
        return response()->json($detail);
    }
}
