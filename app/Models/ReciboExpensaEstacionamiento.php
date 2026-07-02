<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReciboExpensaEstacionamiento extends Model
{
    use HasFactory;

    protected $table = 'recibo_expensas_estacionamientos';

    protected $fillable = [
        'numero',
        'fecha',
        'propietario_id',
        'expensa_estacionamiento_id',
        'estacionamiento_id',
        'monto',
        'moneda',
        'mes',
        'gestion',
        'tipo_pago',
        'numero_deposito',
        'edificio_id',
    ];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function expensa()
    {
        return $this->belongsTo(
            ExpensaEstacionamiento::class,
            'expensa_estacionamiento_id'
        );
    }

    public function estacionamiento()
    {
        return $this->belongsTo(Estacionamiento::class);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}