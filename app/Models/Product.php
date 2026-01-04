<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // SESUAI NAMA TABLE

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'harga',
        'stok',
        'deskripsi',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
