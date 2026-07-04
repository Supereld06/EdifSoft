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
        'nombre' => 'Edificio "AVE PARAISO"',
        'direccion' => 'Av. J. Ballivian N-688',
        'numero_departamentos' => '142',
        'pais' => 'Bolivia',
        'ciudad' => 'Cocahamba',
        'zona' => 'Zona Central',
        ]);

        Edificio::create([
        'nombre' => 'Edificio "Residencial Los Pinos"',
        'direccion' => 'Av. Los Pinos N-123',
        'numero_departamentos' => '10',
        'pais' => 'Bolivia',
        'ciudad' => 'Cocahamba',
        'zona' => 'Zona Norte',
        ]);
    }

}
