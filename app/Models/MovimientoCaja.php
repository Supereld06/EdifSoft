<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoCaja extends Model
{
    protected $table = 'movimientos_caja';

    protected $fillable = [
        'caja_id',
        'tipo',
        'concepto',
        'monto',
        'saldo_anterior',
        'saldo_nuevo',
        'transferencia_id',
        'referencia_tipo',
        'referencia_id',
        'usuario_id',
        'fecha',
        'observacion',
        'estado',
        'anulado_por',
        'anulado_en',
        'motivo_anulacion',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'saldo_anterior' => 'decimal:2',
        'saldo_nuevo' => 'decimal:2',
        'fecha' => 'datetime',
        'anulado_en' => 'datetime',
    ];

    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function usuarioAnulacion(): BelongsTo
    {
        return $this->belongsTo(User::class, 'anulado_por');
    }

    public function estaAnulado(): bool
    {
        return $this->estado === 'anulado';
    }
}