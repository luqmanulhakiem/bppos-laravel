<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nama_singkat',
        'kabupaten',
        'telp',
        'whatsapp',
        'email',
        'rekening_nama',
        'rekening_nomer',
        'rekening_an',
        'logo',
        'logo_nota',
        'member_card',
    ];
}
