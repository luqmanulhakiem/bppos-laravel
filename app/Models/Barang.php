<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'nama', 'jenis', 'stok', 'id_kategori', 'id_satuan', 'id_harga'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->kode = IdGenerator::generate(['table' => 'barangs','field' => 'kode', 'length' => 8, 'prefix' =>'BPB-']);
        });
    }

}
