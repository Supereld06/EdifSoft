<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReciboExpensa extends Model
{
    use HasFactory;

    protected $table = 'recibo_expensas';

    protected $fillable = [
        'numero',
        'fecha',
        'propietario_id',
        'expensa_id',
        'departamento_id',
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
        return $this->belongsTo(Expensa::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}