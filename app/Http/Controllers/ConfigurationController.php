<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $data = Configuration::first();

        return view('dashboard.halaman.konfigurasi.index', compact('data'));
    }
}
