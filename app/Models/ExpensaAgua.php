<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensaAgua extends Model
{
    protected $table = 'expensas_aguas';

    protected $fillable = [

        'departamento_id',
        'propietario_id',
        'edificio_id',
        'apertura_expensa_id',
        'total',
        'pagado',
        'saldo',
        'estado',
        'lectura_anterior',
        'lectura_actual',
        'lectura_pagar',
        'prorrateo',
        'pago'

    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function apertura()
    {
        return $this->belongsTo(
            AperturaExpensa::class,
            'apertura_expensa_id'
        );
    }
}