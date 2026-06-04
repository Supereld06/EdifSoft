<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Propietario extends Model
{
    use HasFactory;

    // Relación: un propietario pertenece a un edificio

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'carnet',
        'direccion',
        'celular',
        'correo',
        'edificio_id'
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function expensas()
    {
        return $this->hasMany(Expensa::class);
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
    public function tiendas()
    {
        return $this->hasMany(Tienda::class);
    }

    public function estacionamientos()
    {
        return $this->hasMany(Estacionamiento::class);
    }
}
