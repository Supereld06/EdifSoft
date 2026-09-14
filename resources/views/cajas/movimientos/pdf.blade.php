<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Movimientos de Caja
    </title>

    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #222;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        .header {
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-left {
            width: 65%;
            vertical-align: top;
        }

        .header-right {
            width: 35%;
            text-align: right;
            vertical-align: top;
        }

        .titulo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .subtitulo {
            font-size: 10px;
            color: #666;
        }

        .fecha-generacion {
            font-size: 8px;
            color: #666;
        }

        .caja {
            font-size: 13px;
            font-weight: bold;
            margin-top: 5px;
        }

        .resumen {
            width: 100%;
            border-collapse: separate;
            border-spacing: 6px;
            margin-bottom: 12px;
        }

        .resumen td {
            border: 1px solid #ccc;
            padding: 8px;
            vertical-align: middle;
        }

        .resumen-label {
            font-size: 8px;
            color: #666;
        }

        .resumen-valor {
            font-size: 13px;
            font-weight: bold;
            margin-top: 3px;
        }

        .saldo {
            color: #222;
        }

        .ingreso {
            color: #198754;
        }

        .egreso {
            color: #dc3545;
        }

        .filtros {
            border: 1px solid #ccc;
            background: #f7f7f7;
            padding: 8px;
            margin-bottom: 12px;
        }

        .filtros-title {
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 5px;
        }

        .filtros-table {
            width: 100%;
            border-collapse: collapse;
        }

        .filtros-table td {
            padding: 2px 5px;
        }

        .filtro-label {
            font-weight: bold;
        }

        .sin-filtros {
            color: #666;
            font-style: italic;
        }

        .tabla {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla th {
            background: #222;
            color: white;
            padding: 6px 4px;
            border: 1px solid #222;
            font-size: 8px;
        }

        .tabla td {
            padding: 5px 4px;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .tabla tr.anulado {
            background: #eeeeee;
            color: #666;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 3px 5px;
            font-size: 7px;
            font-weight: bold;
        }

        .badge-ingreso {
            background: #198754;
            color: white;
        }

        .badge-egreso {
            background: #dc3545;
            color: white;
        }

        .badge-transferencia {
            background: #0d6efd;
            color: white;
        }

        .badge-activo {
            background: #198754;
            color: white;
        }

        .badge-anulado {
            background: #dc3545;
            color: white;
        }

        .small {
            font-size: 7px;
        }

        .muted {
            color: #777;
        }

        .mt-2 {
            margin-top: 4px;
        }

        .anulacion {
            color: #dc3545;
            font-size: 7px;
            margin-top: 4px;
        }

        .footer {
            margin-top: 15px;
            padding-top: 7px;
            border-top: 1px solid #ccc;
            font-size: 7px;
            color: #777;
            text-align: center;
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


    {{-- ========================================================= --}}
    {{-- ENCABEZADO --}}
    {{-- ========================================================= --}}

    <div class="header">

        <table class="header-table">

            <tr>

                <td class="header-left">

                    <div class="titulo">
                        REPORTE DE MOVIMIENTOS DE CAJA
                    </div>

                    <div class="subtitulo">
                        {{ $edificio->nombre ?? 'Edificio' }}
                    </div>

                    <div class="caja">
                        Caja: {{ $caja->nombre }}
                    </div>

                </td>

                <td class="header-right">

                    <div class="fecha-generacion">
                        Generado:
                        {{ now()->format('d/m/Y H:i') }}
                    </div>

                    <div class="fecha-generacion">
                        Usuario:
                        {{ auth()->user()?->name ?? 'N/A' }}
                    </div>

                </td>

            </tr>

        </table>

    </div>


    {{-- ========================================================= --}}
    {{-- RESUMEN --}}
    {{-- ========================================================= --}}

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


    {{-- ========================================================= --}}
    {{-- FILTROS APLICADOS --}}
    {{-- ========================================================= --}}

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


    {{-- ========================================================= --}}
    {{-- TABLA DE MOVIMIENTOS --}}
    {{-- ========================================================= --}}

    <table class="tabla">

        <thead>

            <tr>

                <th width="8%">
                    Fecha
                </th>

                <th width="8%">
                    Tipo
                </th>

                <th width="22%">
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

                <th width="14%">
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

                    <td colspan="9" class="text-center">

                        No existen movimientos para los filtros seleccionados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- ========================================================= --}}
    {{-- PIE --}}
    {{-- ========================================================= --}}

    <div class="footer">

        Sistema de administración de edificios -

        {{ $edificio->nombre ?? 'Edificio' }}

        |

        Caja: {{ $caja->nombre }}

        |

        Total de movimientos mostrados:

        {{ $movimientos->count() }}

    </div>

</body>

</html>