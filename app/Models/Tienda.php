<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tienda extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_tienda',
        'numero_tienda',
        'ubicacion',
        'detalles_tienda',
        'propietario_id',
        'edificio_id',
    ];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class,'propietario_id');
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}