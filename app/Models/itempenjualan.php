<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'item_penjualan';
    
    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'kuantitas',
        'harga_satuan',
        'subtotal',
    ];

    /**
     * Relasi ke model Produk (Setiap item penjualan milik 1 produk)
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Relasi ke model Penjualan (Setiap item penjualan milik 1 transaksi penjualan)
     */
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
}