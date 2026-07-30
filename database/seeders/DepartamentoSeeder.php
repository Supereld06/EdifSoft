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
            'tipo_departamento'=>'Monoambiente',
            'numero_departamento'=>'101',
            'piso'=>1,
            'propietario_id'=>1,
            'edificio_id'=>1,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Departamento 2D',
            'numero_departamento'=>'102',
            'piso'=>1,
            'propietario_id'=>2,
            'edificio_id'=>1,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Departamento 3D',
            'numero_departamento'=>'111',
            'piso'=>1,
            'propietario_id'=>1,
            'edificio_id'=>1,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Suit',
            'numero_departamento'=>'101',
            'piso'=>1,
            'propietario_id'=>1,
            'edificio_id'=>2,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Monoambiente',
            'numero_departamento'=>'105',
            'piso'=>1,
            'propietario_id'=>1,
            'edificio_id'=>1,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Moonoambiente',
            'numero_departamento'=>'109',
            'piso'=>3,
            'propietario_id'=>1,
            'edificio_id'=>1,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Moonoambiente',
            'numero_departamento'=>'107',
            'piso'=>4,
            'propietario_id'=>1,
            'edificio_id'=>1,
        ]);

        Departamento::create([
            'tipo_departamento'=>'Moonoambiente',
            'numero_departamento'=>'107',
            'piso'=>1,
            'propietario_id'=>2,
            'edificio_id'=>2,
        ]);

      
    }
}
