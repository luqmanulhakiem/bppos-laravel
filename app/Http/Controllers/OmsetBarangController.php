<?php

namespace App\Http\Controllers;

use App\Models\OmsetBarang;
use Illuminate\Http\Request;

class OmsetBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tanggal)
    {
        $data = OmsetBarang::whereDate('created_at', $tanggal)->paginate(50);

        return view('dashboard.halaman.omset.index', compact('data', 'tanggal'));
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
    public function show(OmsetBarang $omsetBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OmsetBarang $omsetBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OmsetBarang $omsetBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OmsetBarang $omsetBarang)
    {
        //
    }
}
