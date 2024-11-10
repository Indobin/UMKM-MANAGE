<?php

namespace Database\Factories;

use App\Models\Financial_Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Financial_Report>
 */
class Financial_ReportFactory extends Factory
{
    protected $model = Financial_Report::class;

    public function definition()
    {
        return [
            'bulan' => $this->faker->numberBetween(1, 12),
            'tahun' => $this->faker->year(),
            'total_pemasukan' => $this->faker->randomFloat(2, 10000, 50000),
            'total_pengeluaran' => $this->faker->randomFloat(2, 5000, 30000),
            'laba' => $this->faker->randomFloat(2, 1000, 20000),
        ];
    }
}