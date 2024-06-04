<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $tanggal)
    {
        $find = Saldo::whereDate('created_at', $tanggal)->first();
        if (empty($find)) {
            $data = Saldo::create([]);
            return view('dashboard.halaman.rekap.saldo', compact('data', 'tanggal'));
        } else {
            $data = $find;
            return view('dashboard.halaman.rekap.saldo', compact('data', 'tanggal'));
        }
    }
    public function pengeluaran(string $tanggal)
    {
        $find = Saldo::whereDate('created_at', $tanggal)->first();
        if (empty($find)) {
            $data = Saldo::create([]);
            return view('dashboard.halaman.rekap.pengeluaran', compact('data', 'tanggal'));
        } else {
            $data = $find;
            return view('dashboard.halaman.rekap.pengeluaran', compact('data', 'tanggal'));
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $tanggal)
    {
        $awal = $request->awal;

        $find = Saldo::whereDate('created_at', $tanggal)->first();
        if ($find->awal == 0) {
            $find->update([
                'awal' => $awal,
            ]);
        }else{
            $find->update([
                'awal' => $awal + $find->awal,
                'akhir' => $find->akhir + $awal,
            ]);
        };

        return redirect()->route('laporan.harian', ['tanggal' => $tanggal]);
    }
    public function updatePengeluaran(Request $request, string $tanggal)
    {
        $pengeluaran = $request->pengeluaran;

        LaporanPenjualan::create([
            'keterangan' => $request->keterangan,
            'no_nota' => ' ',
            'keluar' => $pengeluaran,
            'id_admin' => Auth::user()->id,
        ]);

        $find = Saldo::whereDate('created_at', $tanggal)->first();

        if ($find->pengeluaran == 0) {
            $find->update([
                'pengeluaran' => $pengeluaran,
                'akhir' => $find->akhir - $pengeluaran,
            ]);
        }else{
            $find->update([
                'pengeluaran' => $find->pengeluaran + $pengeluaran,
                'akhir' => $find->akhir - ($find->pengeluaran + $pengeluaran),
            ]);
        }
       

        return redirect()->route('laporan.harian', ['tanggal' => $tanggal]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        //
    }
}
