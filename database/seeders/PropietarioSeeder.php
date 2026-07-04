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
            'nombres' => 'Juan',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Gomez',
            'carnet' => '12345678',
            'direccion' => 'Calle Falsa 123',
            'celular' => '555-1234',
            'correo' => 'juan.perez@example.com',
            'edificio_id' => 1,
        ]);

        Propietario::create([
            'nombres' => 'Maria',
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Diaz',
            'carnet' => '87654321',
            'direccion' => 'Avenida Siempre Viva 456',
            'celular' => '555-5678',
            'correo' => 'maria.lopez@example.com',
            'edificio_id' => 1,
        ]);

        Propietario::create([
            'nombres' => 'Carlos',
            'apellido_paterno' => 'Sanchez',
            'apellido_materno' => 'Gonzalez',
            'carnet' => '11223344',
            'direccion' => 'Boulevard Central 789',
            'celular' => '555-9012',
            'correo' => 'carlos.sanchez@example.com',
            'edificio_id' => 2,
        ]);

        Propietario::create([
            'nombres' => 'Ana',
            'apellido_paterno' => 'Torres',
            'apellido_materno' => 'Garcia',
            'carnet' => '44332211',
            'direccion' => 'Calle del Sol 321',
            'celular' => '555-3456',
            'correo' => 'ana.torres@example.com',
            'edificio_id' => 2,
        ]);

        Propietario::create([
            'nombres' => 'Luis',
            'apellido_paterno' => 'Ramirez',
            'apellido_materno' => 'Fernandez',
            'carnet' => '55667788',
            'direccion' => 'Avenida de la Luna 654',
            'celular' => '555-7890',
            'correo' => 'luis.ramirez@example.com',
            'edificio_id' => 1,
        ]);


    }
}