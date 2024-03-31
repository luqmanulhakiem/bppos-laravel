<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyLogoNotaRequest;
use App\Http\Requests\CompanyLogoRequest;
use App\Http\Requests\CompanyMemberCardRequest;
use App\Http\Requests\CompanyProfileRequest;
use App\Http\Requests\CompanyRekeningRequest;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfigurationController extends Controller
{
    public function index()
    {
        $data = Configuration::first();

        return view('dashboard.halaman.konfigurasi.index', compact('data'));
    }

    public function updateCompanyProfile(CompanyProfileRequest $request)
    {
        $data = $request->validated();

        $dt = [
            'nama_lengkap' => $data['nama_lengkap'],
            'nama_singkat' => $data['nama_singkat'],
            'kabupaten' => $data['kabupaten'],
            'telp' => $data['telp'],
            'whatsapp' => $data['whatsapp'],
            'email' => $data['email'],
        ];

        $konf = Configuration::first();
        $update = $konf->update($dt);
        if ($update) {
            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('konfigurasi');
        }
    }


    public function updateCompanyRekening(CompanyRekeningRequest $request)
    {
        $data = $request->validated();

        $dt = [
            'rekening_nama' => $data['rekening_nama'],
            'rekening_nomer' => $data['rekening_nomer'],
            'rekening_an' => $data['rekening_an'],
        ];

        $konf = Configuration::first();
        $update = $konf->update($dt);
        if ($update) {
            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('konfigurasi');
        }
    }

    public function updateLogoPT(CompanyLogoRequest $request) {
        $data = $request->validated();

        
        $konf = Configuration::where('id',1)->first();

        if (!empty($data['logo'])) {
            if ($konf->logo) {
                $oldAvatarPath = public_path('konfig/' . $konf->logo);
                if (file_exists($oldAvatarPath)) {
                    File::delete(public_path('konfig/' . $konf->logo));
                    unlink($oldAvatarPath);
                }
            }

            $data['logo']->storeAs('public/konfig/',$konf->logo);
            $konf->update();

            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('konfigurasi');
        }
    }


    public function updateMemberCard(CompanyMemberCardRequest $request) {
        $data = $request->validated();

        
        $konf = Configuration::where('id',1)->first();

        if (!empty($data['member_card'])) {
            if ($konf->member_card) {
                $oldAvatarPath = public_path('konfig/' . $konf->member_card);
                if (file_exists($oldAvatarPath)) {
                    File::delete(public_path('konfig/' . $konf->member_card));
                    unlink($oldAvatarPath);
                }
            }

            $data['member_card']->storeAs('public/konfig/',$konf->member_card);
            $konf->update();

            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('konfigurasi');
        }
    }

    public function updateLogoNota(CompanyLogoNotaRequest $request) {
        $data = $request->validated();

        
        $konf = Configuration::where('id',1)->first();

        if (!empty($data['logo_nota'])) {
            if ($konf->logo_nota) {
                $oldAvatarPath = public_path('konfig/' . $konf->logo_nota);
                if (file_exists($oldAvatarPath)) {
                    File::delete(public_path('konfig/' . $konf->logo_nota));
                    unlink($oldAvatarPath);
                }
            }

            $data['logo_nota']->storeAs('public/konfig/',$konf->logo_nota);
            $konf->update();

            toastr()->success('Berhasil Mengubah Data');            
            return redirect()->route('konfigurasi');
        }
    }

}
