<?php

namespace Database\Seeders;
use App\Models;
use App\Models\Transaction;
use App\Models\categorie;
use App\Models\debt;
use App\Models\receinvable;
use App\Models\Financial_Report;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(CategorieSeeder::class);

        // Seed transactions, debts, receivables, and financial reports
        // Transaction::factory(20)->create([
        //     'idkategori' => categorie::inRandomOrder()->first()->id
        // ]);
        // debt::factory(10)->create();
        // receinvable::factory(10)->create();
        Financial_Report::factory(12)->create();
    }
}
