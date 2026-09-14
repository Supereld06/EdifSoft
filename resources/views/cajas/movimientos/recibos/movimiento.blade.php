<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Recibo de {{ ucfirst($movimiento->tipo) }}
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
            font-size: 13px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        .monto {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }

        .ingreso {
            color: #198754;
        }

        .egreso {
            color: #dc3545;
        }

        .observacion {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
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

        .anulado {
            color: #dc3545;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            border: 2px solid #dc3545;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <div class="header">

        <div class="titulo">
            RECIBO DE {{ strtoupper($movimiento->tipo) }}
        </div>

        <div class="subtitulo">
            Gestión de Caja
        </div>

    </div>

    @if($movimiento->estado === 'anulado')

        <div class="anulado">
            MOVIMIENTO ANULADO
        </div>

    @endif

    <table>

        <tr>
            <th width="30%">N.º Movimiento</th>
            <td>
                {{ $movimiento->id }}
            </td>
        </tr>

        <tr>
            <th>Edificio</th>
            <td>
                {{ $movimiento->caja->edificio->nombre ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <th>Caja</th>
            <td>
                {{ $movimiento->caja->nombre }}
            </td>
        </tr>

        <tr>
            <th>Fecha</th>
            <td>
                {{ $movimiento->fecha->format('d/m/Y H:i:s') }}
            </td>
        </tr>

        <tr>
            <th>Usuario</th>
            <td>
                {{ $movimiento->usuario?->name ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <th>Concepto</th>
            <td>
                {{ $movimiento->concepto }}
            </td>
        </tr>

        <tr>
            <th>Estado</th>
            <td>
                {{ strtoupper($movimiento->estado) }}
            </td>
        </tr>

    </table>

    <br>

    <div class="monto {{ $movimiento->tipo }}">

        {{ strtoupper($movimiento->tipo) }}:
        Bs. {{ number_format($movimiento->monto, 2) }}

    </div>

    <br>

    <table>

        <tr>
            <th>Saldo anterior</th>
            <td>
                Bs. {{ number_format($movimiento->saldo_anterior, 2) }}
            </td>
        </tr>

        <tr>
            <th>Saldo nuevo</th>
            <td>
                Bs. {{ number_format($movimiento->saldo_nuevo, 2) }}
            </td>
        </tr>

    </table>

    @if($movimiento->observacion)

        <div class="observacion">

            <strong>Observación:</strong>

            <br>

            {{ $movimiento->observacion }}

        </div>

    @endif

    @if($movimiento->estado === 'anulado')

        <div class="observacion">

            <strong>Motivo de anulación:</strong>

            <br>

            {{ $movimiento->motivo_anulacion }}

            <br><br>

            <strong>Anulado por:</strong>

            {{ $movimiento->usuarioAnulacion?->name ?? 'N/A' }}

            <br>

            <strong>Fecha de anulación:</strong>

            {{ $movimiento->anulado_en?->format('d/m/Y H:i:s') }}

        </div>

    @endif

    <div class="firma">

        <div class="linea"></div>

        <br>

        Firma / Responsable

    </div>

</body>

</html>