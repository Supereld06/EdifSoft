<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoMovimiento extends Model
{
    protected $table = 'tipos_movimiento';

    protected $fillable = [
        'edificio_id',
        'tipo',
        'nombre',
        'descripcion',
        'estado',
        'orden',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'orden' => 'integer',
    ];

    public function edificio(): BelongsTo
    {
        return $this->belongsTo(Edificio::class);
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(
            MovimientoCaja::class,
            'tipo_movimiento_id'
        );
    }
}