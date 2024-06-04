<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function indexHarian(string $tanggal){
        $data = DB::table('laporan_penjualans as lp')
        ->join('users as u','u.id','=', 'lp.id_admin')
        ->whereDate('lp.created_at','=', $tanggal)
        ->orderBy('lp.created_at', 'desc')
        ->select('lp.*', 'u.username')
        ->latest()
        ->paginate(50);
        // $data = LaporanPenjualan::whereDate('created_at', $tanggal)->orderBy('created_at', 'desc')->latest()->paginate(50);
        return view('dashboard.halaman.rekap.index', compact('data', 'tanggal'));
    }

    public function indexBulanan(string $bulan, string $tahun){
        $data = DB::table('laporan_penjualans as lp')
        ->join('users as u','u.id','=', 'lp.id_admin')
        ->whereMonth('lp.created_at','=', $bulan)
        ->whereYear('lp.created_at','=', $tahun)
        ->orderBy('lp.created_at', 'desc')
        ->select('lp.*', 'u.username')
        ->latest()
        ->paginate(50);
        return view('dashboard.halaman.rekap.index', compact('data', 'bulan', 'tahun'));
    }

    // public function delete(string $id){
    //     $find = LaporanPenjualan::findorfail($id);
    //     $find->delete();

    //     return redirect()->route()
    // }

}
