<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'jenis_produk_id',
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke jenis produk
    public function jenisProduk()
    {
        return $this->belongsTo(JenisProduk::class, 'jenis_produk_id');
    }

    // Relasi ke item penjualan
    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}