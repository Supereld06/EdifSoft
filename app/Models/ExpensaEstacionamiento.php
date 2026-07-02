<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensaEstacionamiento extends Model
{
    protected $table = 'expensas_estacionamientos';

    protected $fillable = [
        'total',
        'pagado',
        'saldo',
        'estado',
        'estacionamiento_id',
        'propietario_id',
        'edificio_id',
        'apertura_expensa_id',
    ];

    public function estacionamiento()
    {
        return $this->belongsTo(Estacionamiento::class);
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
    public function recibos()
    {
        return $this->hasMany(
            ReciboExpensaEstacionamiento::class,
            'expensa_estacionamiento_id'
        );
    }
}