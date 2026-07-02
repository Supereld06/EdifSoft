<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            margin: 15px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #2d2d2d;
        }

        .recibo {
            border: 1px solid #d8d8d8;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 15px;
            position: relative;
            overflow: hidden;
        }

        .franja {
            position: absolute;
            top: 0;
            left: 0;
            height: 6px;
            width: 100%;
            background: linear-gradient(90deg,
                    #b45309,
                    #f59e0b,
                    #92400e);
        }

        .tipo-copia {
            position: absolute;
            top: 12px;
            right: 15px;
            font-size: 9px;
            font-weight: bold;
            color: #b45309;
            border: 1px solid #f59e0b;
            padding: 2px 8px;
            border-radius: 15px;
        }

        .logo {
            width: 70px;
            float: left;
        }

        .logo img {
            width: 65px;
            height: 65px;
            object-fit: cover;
        }

        .titulo {
            margin-left: 80px;
        }

        .titulo h2 {
            margin: 0;
            color: #b45309;
            font-size: 18px;
        }

        .titulo p {
            margin: 2px 0;
            color: #666;
            font-size: 9px;
        }

        .clear {
            clear: both;
        }

        .info {
            margin-top: 10px;
            background: #fafafa;
            border: 1px solid #ececec;
            border-radius: 8px;
            padding: 8px;
        }

        .fila {
            width: 100%;
            margin-bottom: 4px;
        }

        .col {
            width: 49%;
            display: inline-block;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            color: #92400e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table th {
            background: #fff7ed;
            color: #9a3412;
            padding: 6px;
            border-bottom: 2px solid #fdba74;
        }

        table td {
            padding: 6px;
            border-bottom: 1px solid #eeeeee;
            text-align: center;
        }

        .total-box {
            margin-top: 8px;
            background: #fff7ed;
            border: 1px solid #fdba74;
            border-radius: 8px;
            padding: 8px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            color: #b45309;
        }

        .literal {
            margin-top: 8px;
            background: #fffaf5;
            border-left: 4px solid #f59e0b;
            padding: 8px;
            border-radius: 6px;
            font-size: 9px;
        }

        .firmas {
            margin-top: 22px;
        }

        .firma {
            width: 45%;
            display: inline-block;
            text-align: center;
        }

        .linea {
            border-top: 1px solid #444;
            width: 80%;
            margin: auto;
            padding-top: 5px;
            font-size: 9px;
            font-weight: bold;
        }

        .detalle {
            font-size: 8px;
            color: #666;
            margin-top: 3px;
        }

        .footer {
            margin-top: 8px;
            text-align: center;
            font-size: 8px;
            color: #999;
        }

        .corte {
            border-top: 2px dashed #999;
            margin: 10px 0;
        }
    </style>

</head>

<body>

    @for($i = 1; $i <= 2; $i++)

        <div class="recibo">

        <div class="franja"></div>

        <div class="tipo-copia">
            {{ $i == 1 ? 'ORIGINAL' : 'COPIA' }}
        </div>

        <div class="logo">

            @if($edificio->logo_edificio)
            <img src="{{ public_path('storage/' . $edificio->logo_edificio) }}">
            @endif

        </div>

        <div class="titulo">

            <h2>RECIBO DE ESTACIONAMIENTO</h2>

            <p>{{ $edificio->nombre }}</p>

            <p>{{ $edificio->direccion }}</p>

        </div>

        <div class="clear"></div>

        <div class="info">

            <div class="fila">

                <div class="col">
                    <span class="label">N° Recibo:</span>
                    {{ $recibo->numero }}
                </div>

                <div class="col">
                    <span class="label">Fecha:</span>
                    {{ $recibo->fecha }}
                </div>

            </div>

            <div class="fila">

                <div class="col">
                    <span class="label">Propietario:</span>

                    {{ $recibo->propietario->nombres }}
                    {{ $recibo->propietario->apellido_paterno }}

                </div>

                <div class="col">
                    <span class="label">CI:</span>

                    {{ $recibo->propietario->carnet }}

                </div>

            </div>

            <div class="fila">

                <div class="col">
                    <span class="label">Estacionamiento:</span>

                    {{ $recibo->estacionamiento->numero_estacionamiento }}

                </div>

                <div class="col">
                    <span class="label">Tipo de Pago:</span>

                    {{ $recibo->tipo_pago }}

                </div>

            </div>

        </div>

        <table>

            <thead>

                <tr>
                    <th>Concepto</th>
                    <th>Mes</th>
                    <th>Gestión</th>
                    <th>Monto</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>Pago de Estacionamiento</td>
                    <td>{{ $recibo->mes }}</td>
                    <td>{{ $recibo->gestion }}</td>
                    <td>Bs. {{ number_format($recibo->monto,2) }}</td>
                </tr>

            </tbody>

        </table>

        <div class="total-box">

            TOTAL:
            Bs. {{ number_format($recibo->monto,2) }}

        </div>

        <div class="literal">

            <strong>SON:</strong>

            {{ strtoupper($montoLiteral) }}
            BOLIVIANOS.

        </div>

        <div class="firmas">

            <div class="firma">

                <div class="linea">

                    ENTREGUÉ CONFORME

                </div>

                <div class="detalle">

                    {{ $recibo->propietario->nombres }}
                    {{ $recibo->propietario->apellido_paterno }}

                    <br>

                    CI:
                    {{ $recibo->propietario->carnet }}

                </div>

            </div>

            <div class="firma">

                <div class="linea">

                    RECIBÍ CONFORME

                </div>

                <div class="detalle">

                    ADMINISTRACIÓN

                </div>

            </div>

        </div>

        <div class="footer">

            Documento generado automáticamente por EdifSoft

        </div>

        </div>

        @if($i == 1)
        <div class="corte"></div>
        @endif

        @endfor

</body>

</html>