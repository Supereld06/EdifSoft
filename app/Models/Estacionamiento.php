<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estacionamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_estacionamiento',
        'numero_estacionamiento',
        'ubicacion',
        'detalle',
        'propietario_id',
        'edificio_id',
    ];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}
