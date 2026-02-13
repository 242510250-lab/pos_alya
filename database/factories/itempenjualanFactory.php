<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\itempenjualan;
use App\models\produk;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\itempenjualan>
 */
class itempenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = itempenjualan::class;

    public function definition(): array
    {
        $produk = produk::inRandomOrder()->first();
        $qty = $this->faker->numberBetween(1, 10);

        return [
            'produk_id' => $produk->id,
            'kuantitas' => $qty,
            'harga_satuan' => $produk->harga_jual,
            'subtotal' => $produk->harga_jual * $qty,
        ];
    }
}
