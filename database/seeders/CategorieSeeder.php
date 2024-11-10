<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('categories')->insert([
            [
                'kategori' => 'Elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Alat Masak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
  
        ]);
    }
}
