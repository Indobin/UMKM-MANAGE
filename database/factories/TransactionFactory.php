<?php

namespace Database\Factories;

use App\Models\categorie;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement(['Pembayaran Tahu', 'Pembayaran Parkir', 'Pengiriman Tahu', 'Ganti Tahu']) . ' ' . $this->faker->word,
            'foto' => 'https://source.unsplash.com/random/640x480',
            'tanggal' => $this->faker->date(),
            'jumlah' => $this->faker->randomFloat(2, 100, 1000),
            'jenis' => $this->faker->randomElement(['pemasukan', 'pengeluaran']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
