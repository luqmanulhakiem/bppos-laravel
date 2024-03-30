<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index() {
        $data = User::where('id', auth()->user()->id)->first();

        return view('dashboard.halaman.profil.index', compact('data'));
    }
}
