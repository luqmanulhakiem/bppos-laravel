<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    /**
     * Fungsi login.
     */
    public function login(Login $request)
    {
        // check username dan password apakah sudah diinput
        $data = $request->validated();

        if ($data) {
            // cari user pada tabel berdasarkan username
            $find = User::where('username', $data['username'])->first();
            // kondisi apabila user ditemukan
            if (!empty($find)) {
                // check password apakah sama dengan yang tersimpan
                if (Hash::check($data['password'], $find->password)) {
                    if ($find->status == 'enable') {
                        // lakukan login
                        Auth::attempt(['username' => $data['username'], 'password' => $data['password']]);
                        // pesan
                        toastr()->success('Berhasil Login');
                        // diarahkan ke dashboard
                        return redirect('/dashboard');
                    }
                    // pesan
                    toastr()->error('Gagal Login');

                    // diarahkan ke dashboard
                    return back()->withErrors(['message' => 'Akun Anda DiBlokir Silahkan Hubungi Admin']);
                }
                // apabila password tidak sama
                else{
                    // kirim pesan
                    return redirect()->back()->withInput()->withErrors(['message' => 'password anda salah']);
                }
            }
            // kondisi apabila user tidak ditemukan
            else {
                // kirim pesan
                return redirect()->back()->withInput()->withErrors(['message' => 'username tidak ditemukan']);
            }
        }

    }

    /**
     * Fungsi logout.
     */
    public function logout(Request $request)
    {
        // logout
        Auth::logout();
        // pesan
        toastr()->success('Berhasil Logout');
        // diarahkan ke halaman login
        return redirect('/');
    }
}
