<?php

namespace Database\Factories;

// use App\Models\Debt;
use App\Models\debt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debt>
 */
class DebtFactory extends Factory
{
    protected $model = debt::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement(['Pembayaran Tahu', 'Pembayaran Parkir', 'Pengiriman Tahu', 'Ganti Tahu']) . ' ' . $this->faker->word,
            'jumlah' => $this->faker->randomFloat(2, 1000, 5000),
            'tanggal_jatuh_tempo' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Belum Lunas', 'Lunas']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
