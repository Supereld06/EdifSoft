<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    protected $fillable = [

        'nombre',
        'direccion',
        'numero_departamentos',
        'pais',
        'ciudad',
        'zona',
        'imagen_edificio',
        'logo_edificio'

    ];

    public function propietarios()
    {
        return $this->hasMany(Propietario::class);
    }
    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
    public function tiendas()
    {
        return $this->hasMany(Tienda::class);
    }
}