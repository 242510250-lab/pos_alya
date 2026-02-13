<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\penjualan;
use App\models\user;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penjualan>
 */
class PenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = penjualan::class;

    public function definition(): array
    {
        return [
            'user_id' => user::inRandomOrder()->value('id'),
            'total_pembayaran' => 0, //akan diupdate di seeder
            'metode_pembayaran' => $this->faker->randomElement([
                'CASH', 'TRANSFEER', 'QRIS'
            ]),
            'status' => $this->faker->randomElement(['OPEN', 'COMPLETED']),
        ];
    }
}
