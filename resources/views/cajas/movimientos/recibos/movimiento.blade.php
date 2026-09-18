<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">

    <title>
        Recibo {{ $movimiento->tipo ?? 'Movimiento' }}
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

        /* =========================================
           CONTENEDOR
        ========================================= */

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
            vertical-align: middle;
            padding: 0;
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

        .codigo {
            width: 105px;
            text-align: right;
            font-size: 7px;
            color: #536273;
            line-height: 1.4;
        }

        .codigo strong {
            color: #0b1f33;
        }

        /* =========================================
           ESTADO ANULADO
        ========================================= */

        .anulado {
            background: #fff1f0;
            border: 1px solid #f1b8b5;
            color: #b42318;
            text-align: center;
            padding: 4px;
            margin-bottom: 7px;
            font-size: 8px;
            font-weight: bold;
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

        table.info td {
            border: 1px solid #d7dee5;
            padding: 3px 5px;
            vertical-align: middle;
        }

        .label {
            width: 18%;
            background: #eef2f6;
            font-weight: bold;
            color: #536273;
        }

        .valor {
            width: 32%;
            background: #ffffff;
        }

        /* =========================================
           BADGES
        ========================================= */

        .badge {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: bold;
        }

        .badge-ingreso {
            background: #e8f5ee;
            color: #18794e;
        }

        .badge-egreso {
            background: #fdecea;
            color: #b42318;
        }

        .badge-activo {
            background: #e8f5ee;
            color: #18794e;
        }

        .badge-anulado {
            background: #fdecea;
            color: #b42318;
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
            color: #0b1f33;
        }

        .monto-ingreso {
            color: #18794e;
        }

        .monto-egreso {
            color: #b42318;
        }

        /* =========================================
           SALDOS
        ========================================= */

        .saldos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .saldos td {
            border: 1px solid #d7dee5;
            padding: 4px;
            text-align: center;
        }

        .saldo-label {
            background: #eef2f6;
            color: #536273;
            font-weight: bold;
            font-size: 7px;
        }

        .saldo-valor {
            font-size: 10px;
            font-weight: bold;
            color: #0b1f33;
        }

        /* =========================================
           OBSERVACIÓN
        ========================================= */

        .observacion {
            border: 1px solid #d7dee5;
            background: #f7f9fb;
            padding: 5px;
            min-height: 28px;
            margin-top: 4px;
        }

        .observacion-titulo {
            font-weight: bold;
            color: #536273;
            font-size: 7px;
            margin-bottom: 2px;
        }

        /* =========================================
           CANCELACIÓN
        ========================================= */

        .cancelacion {
            margin-top: 5px;
            border: 1px solid #f1b8b5;
            background: #fff7f6;
            padding: 4px;
            color: #7f1d1d;
            font-size: 7px;
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
        $edificio = optional($movimiento->caja->edificio);
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


                    <td class="titulo">

                        <div class="titulo-principal">
                            RECIBO DE {{ strtoupper($movimiento->tipo) }}
                        </div>

                        <div class="subtitulo">
                            Gestión de Caja
                        </div>

                        <div class="edificio">
                            {{ $edificio->nombre ?? 'Edificio' }}
                        </div>

                    </td>


                    <td class="codigo">

                        <strong>REC-CAJA</strong><br>

                        N.º {{ $movimiento->id }}<br>

                        {{ $movimiento->fecha->format('d/m/Y H:i') }}

                    </td>

                </tr>
            </table>

        </div>


        {{-- =========================================
        ESTADO ANULADO
        ========================================== --}}

        @if($movimiento->estado === 'anulado')

            <div class="anulado">
                ⚠ MOVIMIENTO ANULADO
            </div>

        @endif


        {{-- =========================================
        INFORMACIÓN DEL MOVIMIENTO
        ========================================== --}}

        <div class="seccion">
            Información del Movimiento
        </div>

        <table class="info">

            <tr>

                <td class="label">
                    Caja
                </td>

                <td class="valor">
                    {{ $movimiento->caja->nombre ?? '—' }}
                </td>

                <td class="label">
                    Usuario
                </td>

                <td class="valor">
                    {{ $movimiento->usuario?->name ?? '—' }}
                </td>

            </tr>


            <tr>

                <td class="label">
                    Fecha
                </td>

                <td class="valor">
                    {{ $movimiento->fecha->format('d/m/Y H:i') }}
                </td>

                <td class="label">
                    Tipo
                </td>

                <td class="valor">

                    @if($movimiento->tipo === 'ingreso')

                        <span class="badge badge-ingreso">
                            INGRESO
                        </span>

                    @else

                        <span class="badge badge-egreso">
                            EGRESO
                        </span>

                    @endif

                </td>

            </tr>


            <tr>

                <td class="label">
                    Estado
                </td>

                <td class="valor">

                    @if($movimiento->estado === 'activo')

                        <span class="badge badge-activo">
                            ACTIVO
                        </span>

                    @else

                        <span class="badge badge-anulado">
                            ANULADO
                        </span>

                    @endif

                </td>

                <td class="label">
                    Concepto
                </td>

                <td class="valor">
                    {{ $movimiento->concepto ?? '—' }}
                </td>

            </tr>

        </table>


        {{-- =========================================
        MONTO
        ========================================== --}}

        <div class="monto-contenedor">

            <div class="monto-box">

                <div class="monto-label">
                    Monto del Movimiento
                </div>

                <div class="
                monto
                {{ $movimiento->tipo === 'ingreso'
    ? 'monto-ingreso'
    : 'monto-egreso' }}
            ">

                    {{ $movimiento->tipo === 'ingreso' ? '+' : '-' }}
                    Bs {{ number_format($movimiento->monto, 2) }}

                </div>

            </div>

        </div>


        {{-- =========================================
        SALDOS
        ========================================== --}}

        <div class="seccion">
            Saldos de Caja
        </div>

        <table class="saldos">

            <tr>

                <td class="saldo-label">
                    SALDO ANTERIOR
                </td>

                <td class="saldo-label">
                    SALDO NUEVO
                </td>

            </tr>

            <tr>

                <td class="saldo-valor">
                    Bs {{ number_format($movimiento->saldo_anterior, 2) }}
                </td>

                <td class="saldo-valor">
                    Bs {{ number_format($movimiento->saldo_nuevo, 2) }}
                </td>

            </tr>

        </table>


        {{-- =========================================
        TRANSFERENCIA
        ========================================== --}}

        @if($movimiento->transferencia_id)

            <div class="seccion">
                Información de Transferencia
            </div>

            <table class="info">

                <tr>

                    <td class="label">
                        Transferencia
                    </td>

                    <td class="valor">
                        #{{ $movimiento->transferencia_id }}
                    </td>

                    <td class="label">
                        Referencia
                    </td>

                    <td class="valor">
                        Movimiento relacionado
                    </td>

                </tr>

            </table>

        @endif


        {{-- =========================================
        OBSERVACIÓN
        ========================================== --}}

        @if($movimiento->observacion)

            <div class="seccion">
                Observación
            </div>

            <div class="observacion">

                <div class="observacion-titulo">
                    Detalle:
                </div>

                {{ $movimiento->observacion }}

            </div>

        @endif


        {{-- =========================================
        DATOS DE ANULACIÓN
        ========================================== --}}

        @if($movimiento->estado === 'anulado')

            <div class="cancelacion">

                <strong>Datos de anulación:</strong>

                {{ $movimiento->usuarioAnulacion?->name ?? 'Usuario no registrado' }}

                @if($movimiento->anulado_en)
                    — {{ $movimiento->anulado_en->format('d/m/Y H:i') }}
                @endif

                @if($movimiento->motivo_anulacion)
                    — {{ $movimiento->motivo_anulacion }}
                @endif

            </div>

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