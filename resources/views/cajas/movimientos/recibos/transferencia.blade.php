<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Recibo de transferencia
    </title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .titulo {
            font-size: 22px;
            font-weight: bold;
        }

        .subtitulo {
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background: #f1f1f1;
            text-align: left;
        }

        .codigo {
            text-align: center;
            border: 1px solid #aaa;
            padding: 10px;
            margin-bottom: 20px;
            font-family: monospace;
            font-size: 15px;
        }

        .monto {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
        }

        .anulado {
            color: #dc3545;
            border: 2px solid #dc3545;
            text-align: center;
            padding: 10px;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .firma {
            margin-top: 70px;
            text-align: center;
        }

        .linea {
            border-top: 1px solid #222;
            width: 250px;
            margin: auto;
        }
    </style>

</head>

<body>

    <div class="header">

        <div class="titulo">
            RECIBO DE TRANSFERENCIA
        </div>

        <div class="subtitulo">
            Gestión de Cajas
        </div>

    </div>

    <div class="codigo">

        {{ $transferenciaId }}

    </div>

    @php

        $anulada = $movimientos->contains(
            fn($movimiento) => $movimiento->estado === 'anulado'
        );

    @endphp

    @if($anulada)

        <div class="anulado">
            TRANSFERENCIA ANULADA
        </div>

    @endif

    <table>

        <tr>
            <th width="30%">
                Fecha
            </th>

            <td>
                {{ $origen->fecha->format('d/m/Y H:i:s') }}
            </td>
        </tr>

        <tr>
            <th>
                Edificio
            </th>

            <td>
                {{ $origen->caja->edificio->nombre ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <th>
                Caja origen
            </th>

            <td>
                {{ $origen->caja->nombre }}
            </td>
        </tr>

        <tr>
            <th>
                Caja destino
            </th>

            <td>
                {{ $destino->caja->nombre }}
            </td>
        </tr>

        <tr>
            <th>
                Concepto
            </th>

            <td>
                {{ $origen->concepto }}
            </td>
        </tr>

        <tr>
            <th>
                Usuario
            </th>

            <td>
                {{ $origen->usuario?->name ?? 'N/A' }}
            </td>
        </tr>

    </table>

    <div class="monto">

        Monto transferido:
        Bs. {{ number_format($origen->monto, 2) }}

    </div>

    <table>

        <tr>
            <th>
                Saldo anterior origen
            </th>

            <td>
                Bs. {{ number_format($origen->saldo_anterior, 2) }}
            </td>
        </tr>

        <tr>
            <th>
                Saldo posterior origen
            </th>

            <td>
                Bs. {{ number_format($origen->saldo_nuevo, 2) }}
            </td>
        </tr>

        <tr>
            <th>
                Saldo anterior destino
            </th>

            <td>
                Bs. {{ number_format($destino->saldo_anterior, 2) }}
            </td>
        </tr>

        <tr>
            <th>
                Saldo posterior destino
            </th>

            <td>
                Bs. {{ number_format($destino->saldo_nuevo, 2) }}
            </td>
        </tr>

    </table>

    @if($origen->observacion)

        <table>

            <tr>
                <th>
                    Observación
                </th>

                <td>
                    {{ $origen->observacion }}
                </td>
            </tr>

        </table>

    @endif

    @if($anulada)

        @php
            $movimientoAnulado = $movimientos->firstWhere(
                'estado',
                'anulado'
            );
        @endphp

        <table>

            <tr>
                <th>
                    Motivo de anulación
                </th>

                <td>
                    {{ $movimientoAnulado->motivo_anulacion ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <th>
                    Anulado por
                </th>

                <td>
                    {{ $movimientoAnulado->usuarioAnulacion?->name ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <th>
                    Fecha de anulación
                </th>

                <td>
                    {{ $movimientoAnulado->anulado_en?->format('d/m/Y H:i:s') }}
                </td>
            </tr>

        </table>

    @endif

    <div class="firma">

        <div class="linea"></div>

        <br>

        Firma / Responsable

    </div>

</body>

</html>