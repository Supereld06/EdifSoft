<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EdificioSeeder::class,
            PropietarioSeeder::class, 
            DepartamentoSeeder::class,
            AperturaExpensaSeeder::class,
        ]);
    }
}