<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\factories\HasFactory;

class penjualan extends Model
{
   use HasFactory;

   protected $table = 'penjualan';
   
   protected $fillable = [
    'user_id',
    'total_pembayaran',
    'metode_pembayaran',
    'status'
   ];

   public function itemPenjualan()
   {
    return $this->hasMany(itemPenjualan::class, 'penjualan_id');
   }
}
