<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propietario;

class PropietarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Propietario::create([
            'nombres' => 'Juan Perez',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Gomez',
            'carnet' => '12345678',
            'direccion' => 'Calle Falsa 123',
            'celular' => '78945612',
            'correo' => 'juan.perez@example.com',
            'edificio_id' => 1,
        ]);

        Propietario::create([
            'nombres' => 'Maria Gomez',
            'apellido_paterno' => 'Gomez',
            'apellido_materno' => 'Perez',
            'carnet' => '87654321',
            'direccion' => 'Calle Falsa 456',
            'celular' => '78945613',
            'correo' => 'maria.gomez@example.com',
            'edificio_id' => 1,
        ]);

        Propietario::create([
            'nombres' => 'Carlos Sanchez',
            'apellido_paterno' => 'Sanchez',
            'apellido_materno' => 'Perez',
            'carnet' => '11223344',
            'direccion' => 'Calle Falsa 789',
            'celular' => '78945614',
            'correo' => 'carlos.sanchez@example.com',
            'edificio_id' => 1,
        ]);
    }
}