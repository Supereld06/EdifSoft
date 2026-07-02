<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensaTienda extends Model
{
    protected $table = 'expensas_tiendas';

    protected $fillable = [
        'total',
        'pagado',
        'saldo',
        'estado',
        'tienda_id',
        'propietario_id',
        'edificio_id',
        'apertura_expensa_id',
    ];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class);
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
            ReciboExpensaTienda::class,
            'expensa_tienda_id'
        );
    }
}