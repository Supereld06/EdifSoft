<?php

namespace App\Services;

use App\Models\Caja;
use App\Models\MovimientoCaja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class CajaService
{
    /**
     * Crear una caja.
     *
     * Si existe saldo inicial, también genera
     * automáticamente el movimiento de ingreso.
     */
    public function crearCaja(
        int $edificioId,
        string $nombre,
        ?string $descripcion,
        float $saldoInicial = 0
    ): Caja {
        return DB::transaction(function () use ($edificioId, $nombre, $descripcion, $saldoInicial) {

            if ($saldoInicial < 0) {
                throw new RuntimeException(
                    'El saldo inicial no puede ser negativo.'
                );
            }

            $caja = Caja::create([
                'edificio_id' => $edificioId,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'saldo' => $saldoInicial,
                'estado' => true,
            ]);

            if ($saldoInicial > 0) {

                MovimientoCaja::create([
                    'caja_id' => $caja->id,
                    'tipo' => 'ingreso',
                    'concepto' => 'Saldo inicial',
                    'monto' => $saldoInicial,
                    'saldo_anterior' => 0,
                    'saldo_nuevo' => $saldoInicial,
                    'usuario_id' => Auth::id(),
                    'fecha' => now(),
                    'observacion' => 'Saldo inicial de la caja.',
                    'estado' => 'activo',
                ]);
            }

            return $caja;
        });
    }

    /**
     * Registrar ingreso.
     */
    public function ingresar(
        Caja $caja,
        float $monto,
        string $concepto,
        ?string $referenciaTipo = null,
        ?int $referenciaId = null,
        ?string $observacion = null
    ): MovimientoCaja {

        if ($monto <= 0) {
            throw new RuntimeException(
                'El monto del ingreso debe ser mayor a cero.'
            );
        }

        return DB::transaction(function () use ($caja, $monto, $concepto, $referenciaTipo, $referenciaId, $observacion) {

            $caja = Caja::where('id', $caja->id)
                ->lockForUpdate()
                ->first();

            if (!$caja) {
                throw new RuntimeException(
                    'La caja no existe.'
                );
            }

            if (!$caja->estado) {
                throw new RuntimeException(
                    'La caja está inactiva.'
                );
            }

            $saldoAnterior = (float) $caja->saldo;
            $saldoNuevo = $saldoAnterior + $monto;

            $caja->update([
                'saldo' => $saldoNuevo,
            ]);

            return MovimientoCaja::create([
                'caja_id' => $caja->id,
                'tipo' => 'ingreso',
                'concepto' => $concepto,
                'monto' => $monto,
                'saldo_anterior' => $saldoAnterior,
                'saldo_nuevo' => $saldoNuevo,
                'referencia_tipo' => $referenciaTipo,
                'referencia_id' => $referenciaId,
                'usuario_id' => Auth::id(),
                'fecha' => now(),
                'observacion' => $observacion,
                'estado' => 'activo',
            ]);
        });
    }

    /**
     * Registrar egreso.
     */
    public function egresar(
        Caja $caja,
        float $monto,
        string $concepto,
        ?string $referenciaTipo = null,
        ?int $referenciaId = null,
        ?string $observacion = null
    ): MovimientoCaja {

        if ($monto <= 0) {
            throw new RuntimeException(
                'El monto del egreso debe ser mayor a cero.'
            );
        }

        return DB::transaction(function () use ($caja, $monto, $concepto, $referenciaTipo, $referenciaId, $observacion) {

            $caja = Caja::where('id', $caja->id)
                ->lockForUpdate()
                ->first();

            if (!$caja) {
                throw new RuntimeException(
                    'La caja no existe.'
                );
            }

            if (!$caja->estado) {
                throw new RuntimeException(
                    'La caja está inactiva.'
                );
            }

            $saldoAnterior = (float) $caja->saldo;

            if ($monto > $saldoAnterior) {
                throw new RuntimeException(
                    'La caja no tiene saldo suficiente para realizar este egreso.'
                );
            }

            $saldoNuevo = $saldoAnterior - $monto;

            $caja->update([
                'saldo' => $saldoNuevo,
            ]);

            return MovimientoCaja::create([
                'caja_id' => $caja->id,
                'tipo' => 'egreso',
                'concepto' => $concepto,
                'monto' => $monto,
                'saldo_anterior' => $saldoAnterior,
                'saldo_nuevo' => $saldoNuevo,
                'referencia_tipo' => $referenciaTipo,
                'referencia_id' => $referenciaId,
                'usuario_id' => Auth::id(),
                'fecha' => now(),
                'observacion' => $observacion,
                'estado' => 'activo',
            ]);
        });
    }

    /**
     * Transferir dinero entre dos cajas.
     */
    public function transferir(
        Caja $cajaOrigen,
        Caja $cajaDestino,
        float $monto,
        string $concepto,
        ?string $observacion = null
    ): array {

        if ($monto <= 0) {
            throw new RuntimeException(
                'El monto de la transferencia debe ser mayor a cero.'
            );
        }

        if ($cajaOrigen->id === $cajaDestino->id) {
            throw new RuntimeException(
                'La caja de origen y destino no pueden ser la misma.'
            );
        }

        if ((int) $cajaOrigen->edificio_id !== (int) $cajaDestino->edificio_id) {
            throw new RuntimeException(
                'Las cajas deben pertenecer al mismo edificio.'
            );
        }

        return DB::transaction(function () use ($cajaOrigen, $cajaDestino, $monto, $concepto, $observacion) {

            $ids = [
                $cajaOrigen->id,
                $cajaDestino->id,
            ];

            sort($ids);

            $cajas = Caja::whereIn('id', $ids)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $origen = $cajas[$cajaOrigen->id];
            $destino = $cajas[$cajaDestino->id];

            if (!$origen->estado || !$destino->estado) {
                throw new RuntimeException(
                    'Ambas cajas deben estar activas.'
                );
            }

            $saldoOrigenAnterior = (float) $origen->saldo;

            if ($monto > $saldoOrigenAnterior) {
                throw new RuntimeException(
                    'La caja de origen no tiene saldo suficiente.'
                );
            }

            $saldoOrigenNuevo = $saldoOrigenAnterior - $monto;

            $saldoDestinoAnterior = (float) $destino->saldo;
            $saldoDestinoNuevo = $saldoDestinoAnterior + $monto;

            $transferenciaId = 'TRF-' . strtoupper(Str::random(12));

            $origen->update([
                'saldo' => $saldoOrigenNuevo,
            ]);

            $destino->update([
                'saldo' => $saldoDestinoNuevo,
            ]);

            $movimientoOrigen = MovimientoCaja::create([
                'caja_id' => $origen->id,
                'tipo' => 'egreso',
                'concepto' => 'Transferencia a ' . $destino->nombre,
                'monto' => $monto,
                'saldo_anterior' => $saldoOrigenAnterior,
                'saldo_nuevo' => $saldoOrigenNuevo,
                'transferencia_id' => $transferenciaId,
                'referencia_tipo' => 'transferencia',
                'referencia_id' => null,
                'usuario_id' => Auth::id(),
                'fecha' => now(),
                'observacion' => $observacion,
                'estado' => 'activo',
            ]);

            $movimientoDestino = MovimientoCaja::create([
                'caja_id' => $destino->id,
                'tipo' => 'ingreso',
                'concepto' => 'Transferencia desde ' . $origen->nombre,
                'monto' => $monto,
                'saldo_anterior' => $saldoDestinoAnterior,
                'saldo_nuevo' => $saldoDestinoNuevo,
                'transferencia_id' => $transferenciaId,
                'referencia_tipo' => 'transferencia',
                'referencia_id' => null,
                'usuario_id' => Auth::id(),
                'fecha' => now(),
                'observacion' => $observacion,
                'estado' => 'activo',
            ]);

            return [
                'transferencia_id' => $transferenciaId,
                'origen' => $movimientoOrigen,
                'destino' => $movimientoDestino,
            ];
        });
    }

    /**
     * Anular un movimiento normal.
     */
    public function anularMovimiento(
        MovimientoCaja $movimiento,
        string $motivo
    ): MovimientoCaja {

        return DB::transaction(function () use ($movimiento, $motivo) {

            $movimiento = MovimientoCaja::where('id', $movimiento->id)
                ->lockForUpdate()
                ->first();

            if (!$movimiento) {
                throw new RuntimeException(
                    'El movimiento no existe.'
                );
            }

            if ($movimiento->estado === 'anulado') {
                throw new RuntimeException(
                    'El movimiento ya se encuentra anulado.'
                );
            }

            if (
                $movimiento->referencia_tipo === 'anulacion_movimiento' ||
                $movimiento->referencia_tipo === 'anulacion_transferencia'
            ) {
                throw new RuntimeException(
                    'Este movimiento es una reversión y no puede ser anulado nuevamente.'
                );
            }

            $caja = Caja::where('id', $movimiento->caja_id)
                ->lockForUpdate()
                ->first();

            if (!$caja) {
                throw new RuntimeException(
                    'La caja asociada no existe.'
                );
            }

            $saldoAnterior = (float) $caja->saldo;

            if ($movimiento->tipo === 'ingreso') {

                $saldoNuevo = $saldoAnterior - (float) $movimiento->monto;

                if ($saldoNuevo < 0) {
                    throw new RuntimeException(
                        'No se puede anular este ingreso porque dejaría el saldo de la caja en negativo.'
                    );
                }

                $tipoReversion = 'egreso';

            } else {

                $saldoNuevo = $saldoAnterior + (float) $movimiento->monto;

                $tipoReversion = 'ingreso';
            }

            $caja->update([
                'saldo' => $saldoNuevo,
            ]);

            $movimiento->update([
                'estado' => 'anulado',
                'anulado_por' => Auth::id(),
                'anulado_en' => now(),
                'motivo_anulacion' => $motivo,
            ]);

            $reversion = MovimientoCaja::create([
                'caja_id' => $caja->id,
                'tipo' => $tipoReversion,
                'concepto' => 'ANULACIÓN: ' . $movimiento->concepto,
                'monto' => $movimiento->monto,
                'saldo_anterior' => $saldoAnterior,
                'saldo_nuevo' => $saldoNuevo,
                'transferencia_id' => null,
                'referencia_tipo' => 'anulacion_movimiento',
                'referencia_id' => $movimiento->id,
                'usuario_id' => Auth::id(),
                'fecha' => now(),
                'observacion' => 'Reversión del movimiento #' .
                    $movimiento->id .
                    '. Motivo: ' .
                    $motivo,
                'estado' => 'activo',
            ]);

            return $reversion;
        });
    }

    /**
     * Anular una transferencia completa.
     */
    public function anularTransferencia(
        string $transferenciaId,
        string $motivo
    ): array {

        return DB::transaction(function () use ($transferenciaId, $motivo) {

            $movimientos = MovimientoCaja::where(
                'transferencia_id',
                $transferenciaId
            )
                ->where('referencia_tipo', 'transferencia')
                ->lockForUpdate()
                ->get();

            if ($movimientos->count() !== 2) {
                throw new RuntimeException(
                    'No se encontraron correctamente los dos movimientos de la transferencia.'
                );
            }

            if (
                $movimientos->contains(
                    fn($movimiento) =>
                        $movimiento->estado === 'anulado'
                )
            ) {
                throw new RuntimeException(
                    'La transferencia ya se encuentra anulada.'
                );
            }

            $idsCajas = $movimientos
                ->pluck('caja_id')
                ->unique()
                ->values()
                ->all();

            if (count($idsCajas) !== 2) {
                throw new RuntimeException(
                    'La transferencia no tiene dos cajas válidas.'
                );
            }

            sort($idsCajas);

            $cajas = Caja::whereIn('id', $idsCajas)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            foreach ($movimientos as $movimiento) {

                $caja = $cajas[$movimiento->caja_id];

                $saldoAnterior = (float) $caja->saldo;

                if ($movimiento->tipo === 'egreso') {

                    $saldoNuevo = $saldoAnterior +
                        (float) $movimiento->monto;

                    $tipoReversion = 'ingreso';

                } else {

                    $saldoNuevo = $saldoAnterior -
                        (float) $movimiento->monto;

                    if ($saldoNuevo < 0) {
                        throw new RuntimeException(
                            'No se puede anular la transferencia porque la caja destino quedaría con saldo negativo.'
                        );
                    }

                    $tipoReversion = 'egreso';
                }

                $caja->update([
                    'saldo' => $saldoNuevo,
                ]);

                $movimiento->update([
                    'estado' => 'anulado',
                    'anulado_por' => Auth::id(),
                    'anulado_en' => now(),
                    'motivo_anulacion' => $motivo,
                ]);

                MovimientoCaja::create([
                    'caja_id' => $caja->id,
                    'tipo' => $tipoReversion,
                    'concepto' => 'ANULACIÓN TRANSFERENCIA: ' .
                        $movimiento->concepto,
                    'monto' => $movimiento->monto,
                    'saldo_anterior' => $saldoAnterior,
                    'saldo_nuevo' => $saldoNuevo,
                    'transferencia_id' => $transferenciaId,
                    'referencia_tipo' => 'anulacion_transferencia',
                    'referencia_id' => $movimiento->id,
                    'usuario_id' => Auth::id(),
                    'fecha' => now(),
                    'observacion' => 'Reversión de transferencia ' .
                        $transferenciaId .
                        '. Motivo: ' .
                        $motivo,
                    'estado' => 'activo',
                ]);
            }

            return [
                'transferencia_id' => $transferenciaId,
                'movimientos' => $movimientos,
            ];
        });
    }
}