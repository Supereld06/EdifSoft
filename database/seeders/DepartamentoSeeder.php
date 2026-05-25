<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departamento::create([
            'tipo_departamento' => 'Monoambiente',
            'numero_departamento' => '101',
            'piso' => '1',
            'co_propietario' => '',
            'observaciones' => 'Departamento con vista al parque',
            'propietario_id' => 1,
            'edificio_id' => 1,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Monoambiente',
            'numero_departamento' => '202',
            'piso' => '2',
            'co_propietario' => '',
            'observaciones' => 'Departamento con terraza',
            'propietario_id' => 2,
            'edificio_id' => 1,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Departamento',
            'numero_departamento' => '303',
            'piso' => '3',
            'co_propietario' => '',
            'observaciones' => 'Departamento con vista panorámica',
            'propietario_id' => 3,
            'edificio_id' => 1,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Dos Dormitorios',
            'numero_departamento' => '404',
            'piso' => '4',
            'co_propietario' => 'Juan Perez',
            'observaciones' => 'Departamento con balcón',
            'propietario_id' => 1,
            'edificio_id' => 1,
        ]);
    }
}
