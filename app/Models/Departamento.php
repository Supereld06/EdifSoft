<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_departamento',
        'numero_departamento',
        'piso',
        'propietario_id',
        'edificio_id',
    ];

    public function propietario()
{
    return $this->belongsTo(Propietario::class, 'id'); // o la FK que uses
}

public function edificio()
{
    return $this->belongsTo(Edificio::class, 'edificio_id'); // o la FK que uses
}

}
