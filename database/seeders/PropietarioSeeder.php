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
            'nombres'=>'Juan Elder',
            'apellido_paterno'=>'Condorcet',
            'apellido_materno'=>'Gomez',
            'carnet'=>'7379171',
            'direccion'=>'Tomas Barron',
            'correo'=>'econdorce@gmail.com',
            'celular'=>'7874784',
            'edificio_id'=>1,
        ]);

        Propietario::create([
            'nombres'=>'Levi',
            'apellido_paterno'=>'Cabezas',
            'apellido_materno'=>'Gomez',
            'carnet'=>'78478747',
            'direccion'=>'Tomas Barron',
            'correo'=>'levi@gmail.com',
            'celular'=>'78784',
            'edificio_id'=>1,
        ]);

        Propietario::create([
            'nombres'=>'Juan Elder',
            'apellido_paterno'=>'Condorcet',
            'apellido_materno'=>'Gomez',
            'carnet'=>'7379171',
            'direccion'=>'Tomas Barron',
            'correo'=>'econd@gmail.com',
            'celular'=>'7874784',
            'edificio_id'=>2,
        ]);


    }
}