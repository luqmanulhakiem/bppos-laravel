<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'nama', 'jenis', 'stok', 'id_kategori', 'id_satuan', 'id_harga'];

    public function kategori(): HasOne
    {
        return $this->hasOne(Kategori::class,'id', 'id_kategori', 'id');
    }
    public function satuan(): HasOne
    {
        return $this->hasOne(Unit::class,'id', 'id_satuan', 'id');
    }
    public function harga(): HasOne
    {
        return $this->hasOne(Harga::class,'id', 'id_harga', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->kode = IdGenerator::generate(['table' => 'barangs','field' => 'kode', 'length' => 8, 'prefix' =>'BPB-']);
        });
    }

}
