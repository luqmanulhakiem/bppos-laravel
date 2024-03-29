<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'telp', 'alamat', 'deskripsi'];

    public function barangInOut(): BelongsTo
    {
        return $this->belongsTo(BarangInOut::class, 'id', 'id_penyuplai');
    }
}
