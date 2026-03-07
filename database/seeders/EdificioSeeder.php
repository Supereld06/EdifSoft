<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Edificio;

class EdificioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Edificio::create([
        'nombre' => 'Torre Central',
        'direccion' => 'Calle Principal 123',
        'numero_departamentos' => '20'
        ]);
    
        Edificio::create([
        'nombre' => 'Torre Congo',
        'direccion' => 'Calle Auxiliar 456',
        'numero_departamentos' => '20'
        ]);



    }

}
