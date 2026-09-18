<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>
        Recibo de Transferencia
    </title>

    <style>
        @page {
            margin: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 8px;
            color: #1f2933;
            margin: 0;
            padding: 0;
        }

        /* =========================================
           MARCA DE AGUA
        ========================================= */

        .marca-agua {
            position: fixed;
            top: 150px;
            left: 100px;
            width: 400px;
            height: 400px;
            opacity: 0.07;
            z-index: -1;
        }

        .documento {
            width: 100%;
        }

        /* =========================================
           ENCABEZADO
        ========================================= */

        .header {
            width: 100%;
            border-bottom: 2px solid #0b1f33;
            padding-bottom: 7px;
            margin-bottom: 7px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo-cell {
            width: 72px;
        }

        .logo-box {
            width: 58px;
            height: 58px;
            border: 1px solid #d7dee5;
            background: #ffffff;
            text-align: center;
            vertical-align: middle;
            padding: 3px;
        }

        .logo-box img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .titulo {
            text-align: center;
            padding: 0 8px;
        }

        .titulo-principal {
            font-size: 15px;
            font-weight: bold;
            color: #0b1f33;
            margin: 0;
            text-transform: uppercase;
        }

        .subtitulo {
            font-size: 8px;
            color: #536273;
            margin-top: 2px;
        }

        .edificio {
            font-size: 9px;
            font-weight: bold;
            color: #173b5e;
            margin-top: 2px;
        }

        .codigo-header {
            width: 105px;
            text-align: right;
            font-size: 7px;
            color: #536273;
            line-height: 1.4;
        }

        .codigo-header strong {
            color: #0b1f33;
        }

        /* =========================================
           CÓDIGO DE TRANSFERENCIA
        ========================================= */

        .codigo {
            width: 150px;
            margin: 5px auto 6px auto;
            text-align: center;
            border: 1px solid #173b5e;
            background: #f7f9fb;
            padding: 4px 8px;
            color: #0b1f33;
            font-family: monospace;
            font-size: 9px;
            font-weight: bold;
        }

        /* =========================================
           ANULADO
        ========================================= */

        .anulado {
            color: #b42318;
            border: 1px solid #f1b8b5;
            background: #fff1f0;
            text-align: center;
            padding: 4px;
            font-weight: bold;
            font-size: 8px;
            margin-bottom: 6px;
        }

        /* =========================================
           SECCIONES
        ========================================= */

        .seccion {
            background: #0b1f33;
            color: white;
            font-size: 8px;
            font-weight: bold;
            padding: 4px 6px;
            margin-top: 6px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        /* =========================================
           TABLAS
        ========================================= */

        table.info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        table.info th,
        table.info td {
            border: 1px solid #d7dee5;
            padding: 3px 5px;
            vertical-align: middle;
        }

        table.info th {
            width: 30%;
            background: #eef2f6;
            color: #536273;
            font-weight: bold;
            text-align: left;
        }

        table.info td {
            background: #ffffff;
        }

        /* =========================================
           MONTO
        ========================================= */

        .monto-contenedor {
            width: 100%;
            text-align: center;
            margin: 7px 0;
        }

        .monto-box {
            display: inline-block;
            width: 190px;
            border: 1px solid #173b5e;
            border-radius: 5px;
            background: #f7f9fb;
            padding: 6px 10px;
        }

        .monto-label {
            font-size: 7px;
            font-weight: bold;
            color: #536273;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .monto {
            font-size: 16px;
            font-weight: bold;
            color: #173b5e;
        }

        /* =========================================
           SALDOS
        ========================================= */

        .saldos {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .saldos td {
            width: 25%;
            border: 1px solid #d7dee5;
            padding: 4px;
            text-align: center;
            vertical-align: middle;
        }

        .saldo-label {
            background: #eef2f6;
            color: #536273;
            font-weight: bold;
            font-size: 7px;
        }

        .saldo-valor {
            background: #ffffff;
            color: #0b1f33;
            font-size: 9px;
            font-weight: bold;
        }

        /* =========================================
           OBSERVACIÓN
        ========================================= */

        .observacion {
            border: 1px solid #d7dee5;
            background: #f7f9fb;
            padding: 5px;
            min-height: 25px;
            margin-top: 4px;
        }

        .observacion-titulo {
            font-weight: bold;
            color: #536273;
            font-size: 7px;
            margin-bottom: 2px;
        }

        /* =========================================
           FIRMAS
        ========================================= */

        .firmas {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .firmas td {
            width: 50%;
            text-align: center;
            vertical-align: bottom;
            border: none;
            padding: 0 25px;
        }

        .linea-firma {
            border-top: 1px solid #0b1f33;
            height: 1px;
            margin-bottom: 4px;
        }

        .firma-titulo {
            font-size: 8px;
            font-weight: bold;
            color: #0b1f33;
            text-transform: uppercase;
        }

        .firma-subtitulo {
            font-size: 7px;
            color: #536273;
            margin-top: 2px;
        }

        /* =========================================
           PIE
        ========================================= */

        .footer {
            margin-top: 12px;
            padding-top: 5px;
            border-top: 1px solid #d7dee5;
            text-align: center;
            color: #7a8591;
            font-size: 6.5px;
        }
    </style>
</head>

<body>

    @php

        $edificio = optional($origen->caja->edificio);

        $anulada = $movimientos->contains(
            fn($movimiento) => $movimiento->estado === 'anulado'
        );

    @endphp


    {{-- =========================================
    MARCA DE AGUA
    ========================================= --}}

    @if(
            $edificio->imagen_edificio &&
            file_exists(public_path('storage/' . $edificio->imagen_edificio))
        )

        <img src="{{ public_path('storage/' . $edificio->imagen_edificio) }}" class="marca-agua">

    @endif


    <div class="documento">


        {{-- =========================================
        ENCABEZADO
        ========================================== --}}

        <div class="header">

            <table class="header-table">

                <tr>

                    {{-- LOGO --}}

                    <td class="logo-cell">

                        <div class="logo-box">

                            @if(
                                    $edificio->logo_edificio &&
                                    file_exists(public_path('storage/' . $edificio->logo_edificio))
                                )

                                <img src="{{ public_path('storage/' . $edificio->logo_edificio) }}" alt="Logo">

                            @else

                                <span style="font-size: 6px; color:#999;">
                                    SIN LOGO
                                </span>

                            @endif

                        </div>

                    </td>


                    {{-- TÍTULO --}}

                    <td class="titulo">

                        <div class="titulo-principal">
                            RECIBO DE TRANSFERENCIA
                        </div>

                        <div class="subtitulo">
                            Gestión de Cajas
                        </div>

                        <div class="edificio">
                            {{ $edificio->nombre ?? 'Edificio' }}
                        </div>

                    </td>


                    {{-- INFORMACIÓN --}}

                    <td class="codigo-header">

                        <strong>REC-TRANSF</strong><br>

                        N.º {{ $transferenciaId }}<br>

                        {{ $origen->fecha->format('d/m/Y H:i') }}

                    </td>

                </tr>

            </table>

        </div>


        {{-- =========================================
        CÓDIGO
        ========================================== --}}

        <div class="codigo">
            TRANSFERENCIA #{{ $transferenciaId }}
        </div>


        {{-- =========================================
        ANULADA
        ========================================== --}}

        @if($anulada)

            <div class="anulado">
                ⚠ TRANSFERENCIA ANULADA
            </div>

        @endif


        {{-- =========================================
        INFORMACIÓN
        ========================================== --}}

        <div class="seccion">
            Información de la Transferencia
        </div>


        <table class="info">

            <tr>

                <th>
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


        {{-- =========================================
        MONTO
        ========================================== --}}

        <div class="monto-contenedor">

            <div class="monto-box">

                <div class="monto-label">
                    Monto Transferido
                </div>

                <div class="monto">

                    Bs. {{ number_format($origen->monto, 2) }}

                </div>

            </div>

        </div>


        {{-- =========================================
        SALDOS
        ========================================== --}}

        <div class="seccion">
            Saldos de las Cajas
        </div>


        <table class="saldos">

            <tr>

                <td class="saldo-label">
                    SALDO ANT. ORIGEN
                </td>

                <td class="saldo-label">
                    SALDO POST. ORIGEN
                </td>

                <td class="saldo-label">
                    SALDO ANT. DESTINO
                </td>

                <td class="saldo-label">
                    SALDO POST. DESTINO
                </td>

            </tr>

            <tr>

                <td class="saldo-valor">
                    Bs. {{ number_format($origen->saldo_anterior, 2) }}
                </td>

                <td class="saldo-valor">
                    Bs. {{ number_format($origen->saldo_nuevo, 2) }}
                </td>

                <td class="saldo-valor">
                    Bs. {{ number_format($destino->saldo_anterior, 2) }}
                </td>

                <td class="saldo-valor">
                    Bs. {{ number_format($destino->saldo_nuevo, 2) }}
                </td>

            </tr>

        </table>


        {{-- =========================================
        OBSERVACIÓN
        ========================================== --}}

        @if($origen->observacion)

            <div class="seccion">
                Observación
            </div>

            <div class="observacion">

                <div class="observacion-titulo">
                    Detalle:
                </div>

                {{ $origen->observacion }}

            </div>

        @endif


        {{-- =========================================
        INFORMACIÓN DE ANULACIÓN
        ========================================== --}}

        @if($anulada)

            @php

                $movimientoAnulado = $movimientos->firstWhere(
                    'estado',
                    'anulado'
                );

            @endphp


            <div class="seccion">
                Información de Anulación
            </div>


            <table class="info">

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

                        {{ $movimientoAnulado->anulado_en?->format('d/m/Y H:i:s') ?? 'N/A' }}

                    </td>

                </tr>

            </table>

        @endif


        {{-- =========================================
        FIRMAS
        ========================================== --}}

        <table class="firmas">

            <tr>

                <td>

                    <div class="linea-firma"></div>

                    <div class="firma-titulo">
                        Entregué Conforme
                    </div>

                    <div class="firma-subtitulo">
                        Firma y aclaración
                    </div>

                </td>


                <td>

                    <div class="linea-firma"></div>

                    <div class="firma-titulo">
                        Recibí Conforme
                    </div>

                    <div class="firma-subtitulo">
                        Firma y aclaración
                    </div>

                </td>

            </tr>

        </table>


        {{-- =========================================
        FOOTER
        ========================================== --}}

        <div class="footer">

            Documento generado por EdifSoft —
            {{ now()->format('d/m/Y H:i') }}

            <br>

            Sistema de Gestión de Edificios

        </div>


    </div>

</body>

</html>