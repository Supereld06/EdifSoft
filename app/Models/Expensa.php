<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expensa extends Model
{
    use HasFactory;

    protected $fillable = [

        'total',
        'pagado',
        'saldo',
        'estado',

        'departamento_id',
        'propietario_id',
        'edificio_id',
        'apertura_expensa_id',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
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
        return $this->hasMany(ReciboExpensa::class);
    }
}