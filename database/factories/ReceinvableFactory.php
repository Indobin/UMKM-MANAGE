<?php

namespace Database\Factories;

use App\Models\receinvable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receinvable>
 */
class ReceinvableFactory extends Factory
{
    protected $model = receinvable::class;

    public function definition()
    {
        return [
            'jumlah' => $this->faker->randomFloat(2, 1000, 5000),
            'tanggal_jatuh_tempo' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Belum Terkumpul', 'Terkumpul']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
