<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\factories\HasFactory;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    
    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok',
    ];
    
    public function itemPenjual()
    {
        return $this->hasMany(itemPenjualan::class, "produk_id");
    }
}
