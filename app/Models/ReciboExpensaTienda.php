<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReciboExpensaTienda extends Model
{
    use HasFactory;

    protected $table = 'recibo_expensas_tiendas';

    protected $fillable = [
        'numero',
        'fecha',
        'propietario_id',
        'expensa_tienda_id',
        'tienda_id',
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
            ExpensaTienda::class,
            'expensa_tienda_id'
        );
    }

    public function tienda()
    {
        return $this->belongsTo(Tienda::class);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}