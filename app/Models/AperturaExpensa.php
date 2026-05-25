<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AperturaExpensa extends Model
{
    use HasFactory;

    protected $fillable = [
        'mes',
        'gestion',
        'saldo_inicial',
        'efectivo_inicial',
        'expensa_departamentos',
        'expensa_tiendas',
        'expensa_parqueo',
        'factura_agua',
        'prorrateo_agua',
        'edificio_id',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function expensas()
    {
        return $this->hasMany(Expensa::class);
    }
   // public function expensas()
   // {
   //     return $this->hasMany(Expensa::class);
   // }
}