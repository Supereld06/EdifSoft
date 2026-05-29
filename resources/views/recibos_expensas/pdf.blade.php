```html
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            margin: 10px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #2d2d2d;
            margin: 0;
            padding: 0;
        }

        /* =================================
   CONTENEDOR
================================= */

        .contenedor {

            border: 1px solid #d6d6d6;

            border-radius: 10px;

            padding: 14px;

            position: relative;

            overflow: hidden;

            background: #ffffff;
        }

        /* =================================
   PATRONES MODERNOS
================================= */

        .pattern-top {

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 7px;

            background:
                linear-gradient(90deg,
                    #d97706,
                    #f59e0b,
                    #92400e);
        }

        .pattern-circle {

            position: absolute;

            right: -50px;

            top: -50px;

            width: 120px;

            height: 120px;

            border-radius: 50%;

            background: rgba(217, 119, 6, 0.06);
        }

        .pattern-circle2 {

            position: absolute;

            left: -40px;

            bottom: -40px;

            width: 90px;

            height: 90px;

            border-radius: 50%;

            background: rgba(146, 64, 14, 0.05);
        }

        /* =================================
   HEADER
================================= */

        .header {
            width: 100%;
            margin-bottom: 10px;
        }

        .logo-box {
            width: 80px;
            float: left;
        }

        .logo-box img {

            width: 80px;
            height: 80px;

            object-fit: cover;


        }

        .titulo-box {
            margin-left: 75px;
        }

        .titulo {

            font-size: 20px;

            font-weight: bold;

            color: #b45309;

            margin-bottom: 2px;

            letter-spacing: 0.5px;
        }

        .subtitulo {

            font-size: 10px;

            color: #666;

            margin-bottom: 1px;
        }

        .clear {
            clear: both;
        }

        /* =================================
   DATOS
================================= */

        .info-box {

            background: #fafafa;

            border-radius: 8px;

            padding: 10px;

            margin-bottom: 10px;

            border: 1px solid #ececec;
        }

        .fila {
            width: 100%;
            margin-bottom: 5px;
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

        /* =================================
   TABLA
================================= */

        table {

            width: 100%;

            border-collapse: collapse;

            margin-top: 6px;
        }

        table th {

            background: #fff7ed;

            color: #9a3412;

            padding: 7px;

            border-bottom: 2px solid #fdba74;

            font-size: 10px;
        }

        table td {

            padding: 7px;

            border-bottom: 1px solid #eeeeee;

            text-align: center;

            font-size: 10px;
        }

        .total {

            text-align: right;

            margin-top: 10px;

            font-size: 15px;

            font-weight: bold;

            color: #b45309;
        }

        /* =================================
   MONTO LITERAL
================================= */

        .literal {

            margin-top: 10px;

            background: #fffaf5;

            border-left: 4px solid #f59e0b;

            padding: 9px;

            border-radius: 6px;

            font-size: 9px;

            line-height: 1.4;
        }

        /* =================================
   FIRMAS
================================= */

        .firmas {

            width: 100%;

            margin-top: 25px;
        }

        .firma {

            width: 45%;

            display: inline-block;

            text-align: center;
        }

        .linea {

            border-top: 1px solid #444;

            width: 75%;

            margin: auto;

            padding-top: 5px;

            font-weight: bold;

            color: #444;

            font-size: 9px;
        }

        .detalle-firma {

            margin-top: 4px;

            font-size: 8px;

            color: #666;
        }

        /* =================================
   FOOTER
================================= */

        .footer {

            margin-top: 10px;

            text-align: center;

            font-size: 8px;

            color: #999;
        }
    </style>

</head>

<body>

    <div class="contenedor">

        <div class="pattern-top"></div>

        <div class="pattern-circle"></div>

        <div class="pattern-circle2"></div>

        <!-- HEADER -->

        <div class="header">

            <div class="logo-box">

                @if($edificio->logo_edificio)

                    <img src="{{ public_path('storage/' . $edificio->logo_edificio) }}">

                @endif

            </div>

            <div class="titulo-box">

                <div class="titulo">
                    RECIBO DE EXPENSAS
                </div>

                <div class="subtitulo">
                    {{ $edificio->nombre }}
                </div>

                <div class="subtitulo">
                    {{ $edificio->direccion }}
                </div>

            </div>

            <div class="clear"></div>

        </div>

        <!-- INFO -->

        <div class="info-box">

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

                    {{ $recibo->propietario->ci }}

                </div>

            </div>

            <div class="fila">

                <div class="col">

                    <span class="label">Departamento:</span>

                    {{ $recibo->departamento->numero_departamento }}

                </div>

                <div class="col">

                    <span class="label">Tipo Pago:</span>

                    {{ $recibo->tipo_pago }}

                </div>

            </div>

        </div>

        <!-- TABLA -->

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

                    <td>Pago de Expensas</td>

                    <td>{{ $recibo->mes }}</td>

                    <td>{{ $recibo->gestion }}</td>

                    <td>
                        Bs. {{ number_format($recibo->monto, 2) }}
                    </td>

                </tr>

            </tbody>

        </table>

        <!-- TOTAL -->

        <div class="total">

            TOTAL:
            Bs. {{ number_format($recibo->monto, 2) }}

        </div>

        <!-- MONTO LITERAL -->

        <div class="literal">

            <strong>SON:</strong>

            {{ strtoupper($montoLiteral) }}
            BOLIVIANOS.

        </div>

        <!-- FIRMAS -->
<br><br><br>
        <div class="firmas">

            <div class="firma">

                <div class="linea">
                    ENTREGUÉ CONFORME
                </div>

                <div class="detalle-firma">

                    {{ $recibo->propietario->nombres }}
                    {{ $recibo->propietario->apellido_paterno }}

                    <br>

                    CI:
                    {{ $recibo->propietario->ci }}

                </div>

            </div>

            <div class="firma">

                <div class="linea">
                    RECIBÍ CONFORME
                </div>

                <div class="detalle-firma">
                    ADMINISTRACIÓN
                </div>

            </div>

        </div>

        <!-- FOOTER -->

        <div class="footer">

            Documento generado automáticamente por el sistema EdifSoft.

        </div>

    </div>

</body>

</html>
