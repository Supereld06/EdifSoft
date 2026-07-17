<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AperturaExpensa;

class AperturaExpensaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AperturaExpensa::create([
            'mes' => 'Mayo',
            'gestion' => 2026,
            'saldo_inicial' => 0,
            'efectivo_inicial' => 0,
            'expensa_departamentos' => 0,
            'expensa_tiendas' => 0,
            'expensa_parqueo' => 0,
            'factura_agua' => 0,
            'prorrateo_agua' => 0,
            'edificio_id' => 1,
        ]);

    }
}