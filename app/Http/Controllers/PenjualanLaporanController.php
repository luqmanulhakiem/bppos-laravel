<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PenjualanLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Penjualan::with('pelanggan')->where('status', 'selesai')->latest()->paginate(10);
        return view('dashboard.halaman.penjualanLaporan.index', compact('data'));
    }

    public function indexDate(string $tglawal, string $tglakhir)
    {
        $data = Penjualan::with('pelanggan')->where('status', 'selesai')->whereBetween('tgl_penjualan', [$tglawal, $tglakhir])->latest()->paginate(30); 
        return view('dashboard.halaman.penjualanLaporan.index', compact('data'));
    }

    public function cetak(string $tglawal, string $tglakhir)
    {
        if ($tglawal == null) {
            $carbon = Carbon::now();
            $tglawal = $carbon->format('Y-m-d');
            $tglakhir = $carbon->format('Y-m-d');
        }
        $data = Penjualan::with('pelanggan')->where('status', 'selesai')->whereBetween('tgl_penjualan', [$tglawal, $tglakhir])->latest()->get();  //Barryvdh\DomPDF\PDF::loadView(): Argument #2 ($data) must be of type array, Illuminate\Database\Eloquent\Collection given, 

        $pdf = Pdf::loadView('dashboard.halaman.penjualanLaporan.cetak', ['data' => $data]);
        $nama = 'laporan-penjualan ' . $tglawal . '-' . $tglakhir . '.pdf';
        return $pdf->download($nama);
    }
    public function cetak2()
    {
            $carbon = Carbon::now();
            $tglawal = $carbon->format('Y-m-d');
            $tglakhir = $carbon->format('Y-m-d');
        $data = Penjualan::with('pelanggan')->where('status', 'selesai')->whereBetween('tgl_penjualan', [$tglawal, $tglakhir])->latest()->get();  //Barryvdh\DomPDF\PDF::loadView(): Argument #2 ($data) must be of type array, Illuminate\Database\Eloquent\Collection given, 

        $pdf = Pdf::loadView('dashboard.halaman.penjualanLaporan.cetak', ['data' => $data]);
        $nama = 'laporan-penjualan ' . $tglawal . '-' . $tglakhir . '.pdf';
        return $pdf->download($nama);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Penjualan::with(['pelanggan'])->where('id', $id)->first();
        $item = DB::table('penjualan_items as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_penjualan', '=', $data->id)
        ->get();
        // return response()->json($item);
        return view('dashboard.halaman.penjualanLaporan.show', compact('data', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
