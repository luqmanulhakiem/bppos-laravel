<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = ['nama','gender','kode', 'telp', 'alamat', 'level'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->kode = IdGenerator::generate(['table' => 'pelanggans','field' => 'kode', 'length' => 20, 'prefix' =>'BPC-']);
        });
    }

}
