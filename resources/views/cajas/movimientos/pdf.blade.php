<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>Reporte de Movimientos de Caja</title>

    <style>
        @page {
            margin: 25px 30px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9px;
            color: #1f2933;
            margin: 0;
            padding: 0;
        }

        /* =====================================================
           MARCA DE AGUA
        ====================================================== */

        .marca-agua {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 500px;
            height: 500px;
            transform: translate(-50%, -50%);
            opacity: 0.08;
            z-index: -1;
        }

        /* =====================================================
           ENCABEZADO
        ====================================================== */

        .header {
            width: 100%;
            border-bottom: 3px solid #0b1f33;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-column {
            width: 115px;
            vertical-align: middle;
        }

        .logo-box {
            width: 90px;
            height: 90px;
            border: 2px solid #0b1f33;
            border-radius: 6px;
            padding: 7px;
            text-align: center;
            vertical-align: middle;
            background-color: #ffffff;
        }

        .logo-box img {
            max-width: 72px;
            max-height: 72px;
        }

        .title-column {
            vertical-align: middle;
            padding-left: 12px;
        }

        .title {
            font-size: 19px;
            font-weight: bold;
            color: #0b1f33;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 10px;
            color: #536273;
            margin-bottom: 8px;
        }

        .building-name {
            font-size: 12px;
            font-weight: bold;
            color: #173b5e;
        }

        .meta-column {
            width: 190px;
            vertical-align: middle;
            text-align: right;
        }

        .meta {
            font-size: 8.5px;
            color: #4b5563;
            line-height: 1.6;
        }

        .meta strong {
            color: #0b1f33;
        }

        .document-code {
            display: inline-block;
            background-color: #0b1f33;
            color: #ffffff;
            padding: 5px 9px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        /* =====================================================
           INFORMACIÓN DEL EDIFICIO / CAJA
        ====================================================== */

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .info-table td {
            border: 1px solid #d7dee5;
            padding: 6px 8px;
        }

        .info-label {
            width: 120px;
            background-color: #eef2f6;
            color: #0b1f33;
            font-weight: bold;
        }

        /* =====================================================
           TÍTULO DE SECCIÓN
        ====================================================== */

        .section-title {
            background-color: #0b1f33;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            padding: 7px 9px;
            border-radius: 3px 3px 0 0;
            margin-bottom: 0;
        }

        /* =====================================================
           RESUMEN
        ====================================================== */

        .resumen {
            width: 100%;
            border-collapse: separate;
            border-spacing: 6px;
            margin: 0 0 10px 0;
        }

        .resumen td {
            border: 1px solid #d7dee5;
            padding: 8px;
            vertical-align: middle;
            background-color: #ffffff;
        }

        .resumen-label {
            font-size: 8px;
            color: #536273;
            font-weight: bold;
        }

        .resumen-valor {
            font-size: 13px;
            font-weight: bold;
            margin-top: 3px;
        }

        .saldo {
            color: #0b1f33;
        }

        .ingreso {
            color: #18794e;
        }

        .egreso {
            color: #b42318;
        }

        /* =====================================================
           FILTROS
        ====================================================== */

        .filtros {
            border: 1px solid #d7dee5;
            background-color: #f7f9fb;
            padding: 8px;
            margin-bottom: 14px;
        }

        .filtros-title {
            background-color: #173b5e;
            color: #ffffff;
            font-weight: bold;
            font-size: 9px;
            padding: 5px 7px;
            margin: -8px -8px 7px -8px;
        }

        .filtros-table {
            width: 100%;
            border-collapse: collapse;
        }

        .filtros-table td {
            padding: 3px 5px;
        }

        .filtro-label {
            font-weight: bold;
            color: #0b1f33;
        }

        .sin-filtros {
            color: #7a8591;
            font-style: italic;
        }

        /* =====================================================
           TABLA PRINCIPAL
        ====================================================== */

        .tabla {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .tabla th {
            background-color: #173b5e;
            color: #ffffff;
            padding: 7px 5px;
            text-align: left;
            font-size: 7.5px;
            text-transform: uppercase;
            border: 1px solid #173b5e;
        }

        .tabla td {
            border: 1px solid #d8dee5;
            padding: 6px 5px;
            vertical-align: top;
            font-size: 8px;
        }

        .tabla tr:nth-child(even) td {
            background-color: #f7f9fb;
        }

        .tabla tr.anulado td {
            background-color: #eeeeee;
            color: #6b7280;
        }

        /* =====================================================
           ALINEACIONES
        ====================================================== */

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        /* =====================================================
           BADGES
        ====================================================== */

        .badge {
            display: inline-block;
            padding: 3px 5px;
            font-size: 6.5px;
            font-weight: bold;
            border-radius: 3px;
        }

        .badge-ingreso {
            background-color: #18794e;
            color: #ffffff;
        }

        .badge-egreso {
            background-color: #b42318;
            color: #ffffff;
        }

        .badge-transferencia {
            background-color: #173b5e;
            color: #ffffff;
        }

        .badge-activo {
            background-color: #18794e;
            color: #ffffff;
        }

        .badge-anulado {
            background-color: #b42318;
            color: #ffffff;
        }

        /* =====================================================
           TEXTOS PEQUEÑOS
        ====================================================== */

        .small {
            font-size: 7px;
        }

        .muted {
            color: #7a8591;
        }

        .anulacion {
            color: #b42318;
            font-size: 7px;
            margin-top: 4px;
            line-height: 1.35;
        }

        /* =====================================================
           FOOTER
        ====================================================== */

        .footer {
            margin-top: 20px;
            padding-top: 7px;
            border-top: 1px solid #cfd6dd;
            text-align: center;
            color: #7a8591;
            font-size: 7.5px;
        }

        .footer strong {
            color: #0b1f33;
        }

        /* =====================================================
           EVITA CORTES FEOS
        ====================================================== */

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    @php
        $edificio = optional($caja->edificio);

        $tipoTexto = match ($filtros['tipo'] ?? '') {
            'ingreso' => 'Ingresos',
            'egreso' => 'Egresos',
            default => 'Todos',
        };

        $estadoTexto = match ($filtros['estado'] ?? '') {
            'activo' => 'Activos',
            'anulado' => 'Anulados',
            default => 'Todos',
        };
    @endphp


    {{-- =====================================================
    MARCA DE AGUA
    ====================================================== --}}

    @if(
            $edificio->imagen_edificio &&
            file_exists(public_path('storage/' . $edificio->imagen_edificio))
        )
        <img src="{{ public_path('storage/' . $edificio->imagen_edificio) }}" class="marca-agua" alt="Marca de agua">
    @endif


    {{-- =====================================================
    ENCABEZADO
    ====================================================== --}}

    <div class="header">

        <table class="header-table">

            <tr>

                {{-- LOGO DEL EDIFICIO --}}
                <td class="logo-column">

                    <div class="logo-box">

                        @if(
                                $edificio->logo_edificio &&
                                file_exists(public_path('storage/' . $edificio->logo_edificio))
                            )

                            <img src="{{ public_path('storage/' . $edificio->logo_edificio) }}"
                                style="width: 70px; height: 70px; object-fit: contain;" alt="Logo del edificio">

                        @else

                            <span style="font-size: 8px; color: #999;">
                                SIN LOGO
                            </span>

                        @endif

                    </div>

                </td>


                {{-- TÍTULO --}}
                <td class="title-column">

                    <div class="title">
                        REPORTE DE MOVIMIENTOS DE CAJA
                    </div>

                    <div class="subtitle">
                        Sistema de Gestión de Edificios
                    </div>

                    <div class="building-name">
                        {{ $edificio->nombre ?? 'Edificio' }}
                    </div>

                </td>


                {{-- INFORMACIÓN DEL DOCUMENTO --}}
                <td class="meta-column">

                    <div class="document-code">
                        REP-CAJA
                    </div>

                    <div class="meta">

                        <strong>Generado por:</strong>
                        {{ auth()->user()->name ?? 'Usuario del sistema' }}

                        <br>

                        <strong>Fecha:</strong>
                        {{ now()->format('d/m/Y H:i') }}

                    </div>

                </td>

            </tr>

        </table>

    </div>


    {{-- =====================================================
    INFORMACIÓN DEL EDIFICIO Y CAJA
    ====================================================== --}}

    <table class="info-table">

        <tr>

            <td class="info-label">
                Edificio
            </td>

            <td>
                {{ $edificio->nombre ?? '-' }}
            </td>

            <td class="info-label">
                Caja
            </td>

            <td>
                {{ $caja->nombre }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Dirección
            </td>

            <td>
                {{ $edificio->direccion ?? '-' }}
            </td>

            <td class="info-label">
                Estado de caja
            </td>

            <td>
                {{ ucfirst($caja->estado ?? 'N/A') }}
            </td>

        </tr>

    </table>


    {{-- =====================================================
    RESUMEN
    ====================================================== --}}

    <div class="section-title">
        RESUMEN DE CAJA
    </div>

    <table class="resumen">

        <tr>

            <td width="33%">

                <div class="resumen-label">
                    SALDO ACTUAL DE LA CAJA
                </div>

                <div class="resumen-valor saldo">
                    Bs. {{ number_format($caja->saldo, 2) }}
                </div>

            </td>


            <td width="33%">

                <div class="resumen-label">
                    TOTAL INGRESOS ACTIVOS
                </div>

                <div class="resumen-valor ingreso">
                    Bs. {{ number_format($totalIngresos, 2) }}
                </div>

            </td>


            <td width="33%">

                <div class="resumen-label">
                    TOTAL EGRESOS ACTIVOS
                </div>

                <div class="resumen-valor egreso">
                    Bs. {{ number_format($totalEgresos, 2) }}
                </div>

            </td>

        </tr>

    </table>


    {{-- =====================================================
    FILTROS APLICADOS
    ====================================================== --}}

    <div class="filtros">

        <div class="filtros-title">
            FILTROS APLICADOS
        </div>

        <table class="filtros-table">

            <tr>

                <td width="15%" class="filtro-label">
                    Tipo:
                </td>

                <td width="18%">
                    {{ $tipoTexto }}
                </td>

                <td width="15%" class="filtro-label">
                    Estado:
                </td>

                <td width="18%">
                    {{ $estadoTexto }}
                </td>

                <td width="15%" class="filtro-label">
                    Desde:
                </td>

                <td width="19%">

                    {{ $filtros['fecha_desde']
    ? \Carbon\Carbon::parse($filtros['fecha_desde'])->format('d/m/Y')
    : 'Sin límite'
                    }}

                </td>

            </tr>


            <tr>

                <td class="filtro-label">
                    Hasta:
                </td>

                <td>

                    {{ $filtros['fecha_hasta']
    ? \Carbon\Carbon::parse($filtros['fecha_hasta'])->format('d/m/Y')
    : 'Sin límite'
                    }}

                </td>


                <td class="filtro-label">
                    Buscar:
                </td>

                <td colspan="3">

                    @if(!empty($filtros['buscar']))

                        "{{ $filtros['buscar'] }}"

                    @else

                        <span class="sin-filtros">
                            Sin búsqueda específica
                        </span>

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- =====================================================
    TÍTULO DE MOVIMIENTOS
    ====================================================== --}}

    <div class="section-title">
        MOVIMIENTOS REGISTRADOS
    </div>


    {{-- =====================================================
    TABLA DE MOVIMIENTOS
    ====================================================== --}}

    <table class="tabla">

        <thead>

            <tr>

                <th width="8%">
                    Fecha
                </th>

                <th width="9%">
                    Tipo
                </th>

                <th width="20%">
                    Concepto
                </th>

                <th width="10%">
                    Usuario
                </th>

                <th width="10%">
                    Monto
                </th>

                <th width="10%">
                    Saldo anterior
                </th>

                <th width="10%">
                    Saldo nuevo
                </th>

                <th width="8%">
                    Estado
                </th>

                <th width="15%">
                    Observación / Anulación
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($movimientos as $movimiento)

                <tr class="{{ $movimiento->estado === 'anulado' ? 'anulado' : '' }}">

                    {{-- FECHA --}}
                    <td>

                        {{ $movimiento->fecha->format('d/m/Y') }}

                        <br>

                        <span class="small muted">
                            {{ $movimiento->fecha->format('H:i') }}
                        </span>

                    </td>


                    {{-- TIPO --}}
                    <td class="text-center">

                        @if($movimiento->tipo === 'ingreso')

                            <span class="badge badge-ingreso">
                                INGRESO
                            </span>

                        @else

                            <span class="badge badge-egreso">
                                EGRESO
                            </span>

                        @endif


                        @if($movimiento->transferencia_id)

                            <br>

                            <span class="badge badge-transferencia">
                                TRANSFERENCIA
                            </span>

                        @endif

                    </td>


                    {{-- CONCEPTO --}}
                    <td>

                        <strong>
                            {{ $movimiento->concepto }}
                        </strong>


                        @if($movimiento->transferencia_id)

                            <br>

                            <span class="small muted">
                                ID:
                                {{ $movimiento->transferencia_id }}
                            </span>

                        @endif

                    </td>


                    {{-- USUARIO --}}
                    <td>

                        {{ $movimiento->usuario?->name ?? 'N/A' }}

                    </td>


                    {{-- MONTO --}}
                    <td class="text-right fw-bold">

                        @if($movimiento->tipo === 'ingreso')

                            <span class="ingreso">
                                + Bs.
                                {{ number_format($movimiento->monto, 2) }}
                            </span>

                        @else

                            <span class="egreso">
                                - Bs.
                                {{ number_format($movimiento->monto, 2) }}
                            </span>

                        @endif

                    </td>


                    {{-- SALDO ANTERIOR --}}
                    <td class="text-right">

                        Bs.
                        {{ number_format($movimiento->saldo_anterior, 2) }}

                    </td>


                    {{-- SALDO NUEVO --}}
                    <td class="text-right">

                        Bs.
                        {{ number_format($movimiento->saldo_nuevo, 2) }}

                    </td>


                    {{-- ESTADO --}}
                    <td class="text-center">

                        @if($movimiento->estado === 'activo')

                            <span class="badge badge-activo">
                                ACTIVO
                            </span>

                        @else

                            <span class="badge badge-anulado">
                                ANULADO
                            </span>


                            @if($movimiento->anulado_en)

                                <br>

                                <span class="small muted">
                                    {{ $movimiento->anulado_en->format('d/m/Y H:i') }}
                                </span>

                            @endif

                        @endif

                    </td>


                    {{-- OBSERVACIÓN / ANULACIÓN --}}
                    <td>

                        @if($movimiento->observacion)

                            <div>
                                {{ $movimiento->observacion }}
                            </div>

                        @endif


                        @if($movimiento->estado === 'anulado')

                            <div class="anulacion">

                                <strong>
                                    Anulado por:
                                </strong>

                                {{ $movimiento->usuarioAnulacion?->name ?? 'N/A' }}


                                @if($movimiento->motivo_anulacion)

                                    <br>

                                    <strong>
                                        Motivo:
                                    </strong>

                                    {{ $movimiento->motivo_anulacion }}

                                @endif

                            </div>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" style="text-align: center; padding: 15px; color: #6b7280;">

                        No existen movimientos para los filtros seleccionados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- =====================================================
    RESUMEN FINAL
    ====================================================== --}}

    <table class="info-table" style="margin-top: 14px;">

        <tr>

            <td class="info-label">
                Movimientos mostrados
            </td>

            <td>
                {{ $movimientos->count() }}
            </td>

            <td class="info-label">
                Total ingresos
            </td>

            <td style="color: #18794e; font-weight: bold;">
                Bs. {{ number_format($totalIngresos, 2) }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Total egresos
            </td>

            <td style="color: #b42318; font-weight: bold;">
                Bs. {{ number_format($totalEgresos, 2) }}
            </td>

            <td class="info-label">
                Saldo actual
            </td>

            <td style="color: #0b1f33; font-weight: bold;">
                Bs. {{ number_format($caja->saldo, 2) }}
            </td>

        </tr>

    </table>


    {{-- =====================================================
    PIE DE PÁGINA
    ====================================================== --}}

    <div class="footer">

        <strong>
            {{ $edificio->nombre ?? 'Edificio' }}
        </strong>

        — Sistema de Gestión de Edificios

        <br>

        Caja:
        {{ $caja->nombre }}

        —

        Reporte generado automáticamente el
        {{ now()->format('d/m/Y H:i') }}

    </div>

</body>

</html>