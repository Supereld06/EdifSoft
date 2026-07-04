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
            'propietario_id' => 1,
            'edificio_id' => 1,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Dúplex',
            'numero_departamento' => '102',
            'piso' => '1',
            'propietario_id' => 2,
            'edificio_id' => 1,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Penthouse',
            'numero_departamento' => '201',
            'piso' => '2',
            'propietario_id' => 3,
            'edificio_id' => 2,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Triplex',
            'numero_departamento' => '202',
            'piso' => '2',
            'propietario_id' => 4,
            'edificio_id' => 2,
        ]);

        Departamento::create([
            'tipo_departamento' => 'Monoambiente',
            'numero_departamento' => '301',
            'piso' => '3',
            'propietario_id' => 5,
            'edificio_id' => 1,
        ]);
    }
}
