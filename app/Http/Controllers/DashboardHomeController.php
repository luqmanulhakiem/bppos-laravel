<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardHomeController extends Controller
{
    public function index()
    {
        $barang = Barang::count();
        $pelanggan = Pelanggan::count();
        $penjualan = Penjualan::with('pelanggan')->latest()->take(8)->get();
        // return response()->json($penjualan);
        return view('dashboard.dashboard', compact('barang', 'pelanggan', 'penjualan'));
    }
}
