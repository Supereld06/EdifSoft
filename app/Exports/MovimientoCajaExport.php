<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MovimientoCajaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $movimientos;

    public function __construct($movimientos)
    {
        $this->movimientos = $movimientos;
    }

    /**
     * Colección de movimientos que se exportarán
     */
    public function collection()
    {
        return $this->movimientos;
    }

    /**
     * Encabezados del archivo Excel
     */
    public function headings(): array
    {
        return [
            'Fecha',
            'Tipo',
            'Concepto',
            'Usuario',
            'Monto',
            'Saldo anterior',
            'Saldo nuevo',
            'Estado',
            'Anulado por',
            'Fecha de anulación',
            'Motivo de anulación',
        ];
    }

    /**
     * Formato de cada movimiento
     */
    public function map($movimiento): array
    {
        return [
            $movimiento->fecha
            ? $movimiento->fecha->format('d/m/Y H:i')
            : '',

            $movimiento->tipo,

            $movimiento->concepto,

            $movimiento->usuario
            ? $movimiento->usuario->name
            : 'N/A',

            $movimiento->monto,

            $movimiento->saldo_anterior,

            $movimiento->saldo_nuevo,

            $movimiento->estado,

            $movimiento->usuarioAnulacion
            ? $movimiento->usuarioAnulacion->name
            : '',

            $movimiento->anulado_en
            ? $movimiento->anulado_en->format('d/m/Y H:i')
            : '',

            $movimiento->motivo_anulacion ?? '',
        ];
    }
}