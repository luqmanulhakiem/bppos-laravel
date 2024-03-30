<?php

namespace App\Http\Controllers;

use App\Http\Requests\AkunRequest;
use App\Http\Requests\FotoProfilRequest;
use App\Http\Requests\ProfilRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class ProfilController extends Controller
{
    public function index() {
        $data = User::where('id', auth()->user()->id)->first();

        return view('dashboard.halaman.profil.index', compact('data'));
    }

    public function updateProfil(ProfilRequest $request) {
        $data = $request->validated();

        $dt = [
            'name' => $data['name'],
            'telp' => $data['telp']
        ];

        $user =  User::where('id', auth()->user()->id)->first();

        $update = $user->update($dt);

        if ($update) {
            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('profile');
        }

        toastr()->error('Gagal');
        return redirect()->back();
    }
    public function updateAkun(AkunRequest $request) {
        $data = $request->validated();

        if ($data) {
            $dt = [
                'username' => $data['username'],
                'password' => Hash::make($data['newPassword'])
            ];
    
            $user =  User::where('id', auth()->user()->id)->first();
    
            $update = $user->update($dt);
    
            if ($update) {
                toastr()->success('Berhasil Mengubah Data');            
                return redirect()->route('profile');
            }
        }else {
            toastr()->error('Gagal');
            return redirect()->back();

        }
    }
    public function updateFoto(FotoProfilRequest $request)
    {
        $data = $request->validated();
        
        $auth = User::where('id', auth()->user()->id)->first();

        if (!empty($data['foto'])) {
            if ($auth->user_foto) {
                $oldAvatarPath = public_path('fotoUser/' . $auth->user_foto);
                if (file_exists($oldAvatarPath)) {
                    File::delete(public_path('fotoUser/' . $auth->user_foto));
                    unlink($oldAvatarPath);
                }
            }

            $filename = 'CDN-IMG-FOTO-' . $auth->id . '.' . 'webp';
            $data['foto']->storeAs('public/fotoUser/',$filename);
            $auth->user_foto = $filename;
            $auth->update();

            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('profile');
        }
    }
}
