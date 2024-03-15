<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_kategori', 'id');
    }
}
