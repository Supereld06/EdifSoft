<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>Reporte de Propietarios</title>

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

        /* =========================
           ENCABEZADO
        ========================= */

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

        /* =========================
           INFORMACIÓN DEL EDIFICIO
        ========================= */

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
            width: 130px;
            background-color: #eef2f6;
            color: #0b1f33;
            font-weight: bold;
        }

        /* =========================
           TÍTULO DE SECCIÓN
        ========================= */

        .section-title {
            background-color: #0b1f33;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            padding: 7px 9px;
            border-radius: 3px 3px 0 0;
            margin-bottom: 0;
        }

        /* =========================
           TABLA PRINCIPAL
        ========================= */

        .reporte {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .reporte th {
            background-color: #173b5e;
            color: #ffffff;
            padding: 7px 6px;
            text-align: left;
            font-size: 8px;
            text-transform: uppercase;
            border: 1px solid #173b5e;
        }

        .reporte td {
            border: 1px solid #d8dee5;
            padding: 7px 6px;
            vertical-align: top;
            font-size: 8.5px;
        }

        .reporte tr:nth-child(even) td {
            background-color: #f7f9fb;
        }

        /* Anchos */

        .col-propietario {
            width: 27%;
        }

        .col-propiedades {
            width: 53%;
        }

        .col-deuda {
            width: 20%;
            text-align: right;
        }

        /* =========================
           PROPIETARIO
        ========================= */

        .nombre {
            font-weight: bold;
            color: #0b1f33;
            font-size: 9px;
            margin-bottom: 3px;
        }

        .carnet {
            color: #6b7280;
            font-size: 7.5px;
        }

        /* =========================
           PROPIEDADES
        ========================= */

        .propiedad-grupo {
            margin-bottom: 5px;
        }

        .propiedad-grupo:last-child {
            margin-bottom: 0;
        }

        .propiedad-titulo {
            font-weight: bold;
            color: #173b5e;
            font-size: 8px;
            margin-bottom: 2px;
        }

        .propiedad-item {
            color: #374151;
            padding-left: 7px;
            line-height: 1.45;
        }

        .sin-propiedades {
            color: #9ca3af;
            font-style: italic;
        }

        /* =========================
           DEUDA
        ========================= */

        .deuda {
            text-align: right;
            font-weight: bold;
            font-size: 9px;
        }

        .deuda-pendiente {
            color: #b42318;
        }

        .deuda-pagada {
            color: #18794e;
        }

        /* =========================
           RESUMEN
        ========================= */

        .summary {
            width: 100%;
            margin-top: 14px;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid #d7dee5;
            padding: 7px 9px;
        }

        .summary-label {
            width: 70%;
            background-color: #eef2f6;
            color: #0b1f33;
            font-weight: bold;
        }

        .summary-value {
            text-align: right;
            font-weight: bold;
            color: #0b1f33;
        }

        /* =========================
           PIE
        ========================= */

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

        /* Evita cortes feos */

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    @if(
            $edificio->imagen_edificio &&
            file_exists(public_path('storage/' . $edificio->imagen_edificio))
        )
        <img src="{{ public_path('storage/' . $edificio->imagen_edificio) }}" class="marca-agua">
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

                        @if($edificio->logo_edificio)
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
                        REPORTE DE PROPIETARIOS
                    </div>

                    <div class="subtitle">
                        Sistema de Gestión de Edificios
                    </div>

                    <div class="building-name">
                        {{ $edificio->nombre }}
                    </div>

                </td>


                {{-- INFORMACIÓN DEL DOCUMENTO --}}
                <td class="meta-column">

                    <div class="document-code">
                        REP-PROP
                    </div>

                    <div class="meta">

                        <strong>Generado por:</strong>
                        {{ auth()->user()->name ?? 'Usuario del sistema' }}

                        <br>

                        <strong>Fecha:</strong>
                        {{ date('d/m/Y H:i') }}

                    </div>

                </td>

            </tr>

        </table>

    </div>


    {{-- =====================================================
    INFORMACIÓN DEL EDIFICIO
    ====================================================== --}}

    <table class="info-table">

        <tr>

            <td class="info-label">
                Edificio
            </td>

            <td>
                {{ $edificio->nombre }}
            </td>

            <td class="info-label">
                Dirección
            </td>

            <td>
                {{ $edificio->direccion }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Ciudad
            </td>

            <td>
                {{ $edificio->ciudad ?? '-' }}
            </td>

            <td class="info-label">
                Zona
            </td>

            <td>
                {{ $edificio->zona ?? '-' }}
            </td>

        </tr>

    </table>


    {{-- =====================================================
    TÍTULO
    ====================================================== --}}

    <div class="section-title">
        PROPIETARIOS REGISTRADOS
    </div>


    {{-- =====================================================
    TABLA DE PROPIETARIOS
    ====================================================== --}}

    <table class="reporte">

        <thead>

            <tr>

                <th class="col-propietario">
                    Propietario
                </th>

                <th class="col-propiedades">
                    Propiedades
                </th>

                <th class="col-deuda">
                    Deuda
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($propietarios as $prop)

                <tr>

                    {{-- PROPIETARIO --}}
                    <td>

                        <div class="nombre">

                            {{ $prop->nombres }}
                            {{ $prop->apellido_paterno }}
                            {{ $prop->apellido_materno }}

                        </div>

                        @if($prop->carnet)

                            <div class="carnet">
                                CI: {{ $prop->carnet }}
                            </div>

                        @endif

                    </td>


                    {{-- PROPIEDADES --}}
                    <td>

                        {{-- DEPARTAMENTOS --}}

                        @if($prop->departamentos->count())

                            <div class="propiedad-grupo">

                                <div class="propiedad-titulo">
                                    DEPARTAMENTOS
                                </div>

                                @foreach($prop->departamentos as $departamento)

                                    <div class="propiedad-item">
                                        • Dpto.
                                        {{ $departamento->numero_departamento }}

                                        @if($departamento->piso !== null)
                                            — Piso {{ $departamento->piso }}
                                        @endif
                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- ESTACIONAMIENTOS --}}

                        @if($prop->estacionamientos->count())

                            <div class="propiedad-grupo">

                                <div class="propiedad-titulo">
                                    ESTACIONAMIENTOS
                                </div>

                                @foreach($prop->estacionamientos as $estacionamiento)

                                    <div class="propiedad-item">
                                        • Est.
                                        {{ $estacionamiento->numero_estacionamiento }}

                                        @if($estacionamiento->ubicacion)
                                            — {{ $estacionamiento->ubicacion }}
                                        @endif
                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- TIENDAS --}}

                        @if($prop->tiendas->count())

                            <div class="propiedad-grupo">

                                <div class="propiedad-titulo">
                                    TIENDAS
                                </div>

                                @foreach($prop->tiendas as $tienda)

                                    <div class="propiedad-item">
                                        • Tienda
                                        {{ $tienda->numero_tienda }}

                                        @if($tienda->ubicacion)
                                            — {{ $tienda->ubicacion }}
                                        @endif
                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- SIN PROPIEDADES --}}

                        @if(
                                !$prop->departamentos->count() &&
                                !$prop->estacionamientos->count() &&
                                !$prop->tiendas->count()
                            )

                            <span class="sin-propiedades">
                                Sin propiedades registradas
                            </span>

                        @endif

                    </td>


                    {{-- DEUDA --}}
                    <td class="deuda">

                        @php
                            $deuda = $prop->deuda_total ?? 0;
                        @endphp

                        @if($deuda > 0)

                            <span class="deuda-pendiente">
                                {{ number_format($deuda, 2) }} Bs
                            </span>

                        @else

                            <span class="deuda-pagada">
                                0.00 Bs
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" style="text-align: center; padding: 15px; color: #6b7280;">

                        No existen propietarios registrados
                        para este edificio.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- =====================================================
    RESUMEN
    ====================================================== --}}

    @php

        $totalPropietarios = $propietarios->count();

        $totalDepartamentos = $propietarios->sum(function ($prop) {
            return $prop->departamentos->count();
        });

        $totalEstacionamientos = $propietarios->sum(function ($prop) {
            return $prop->estacionamientos->count();
        });

        $totalTiendas = $propietarios->sum(function ($prop) {
            return $prop->tiendas->count();
        });

        $totalDeuda = $propietarios->sum(function ($prop) {
            return $prop->deuda_total ?? 0;
        });

    @endphp


    <table class="summary">

        <tr>

            <td class="summary-label">
                Total de propietarios
            </td>

            <td class="summary-value">
                {{ $totalPropietarios }}
            </td>

        </tr>

        <tr>

            <td class="summary-label">
                Total de departamentos
            </td>

            <td class="summary-value">
                {{ $totalDepartamentos }}
            </td>

        </tr>

        <tr>

            <td class="summary-label">
                Total de estacionamientos
            </td>

            <td class="summary-value">
                {{ $totalEstacionamientos }}
            </td>

        </tr>

        <tr>

            <td class="summary-label">
                Total de tiendas
            </td>

            <td class="summary-value">
                {{ $totalTiendas }}
            </td>

        </tr>

        <tr>

            <td class="summary-label">
                Deuda total de propietarios
            </td>

            <td class="summary-value" style="color: #b42318;">

                {{ number_format($totalDeuda, 2) }} Bs

            </td>

        </tr>

    </table>


    {{-- =====================================================
    PIE DE PÁGINA
    ====================================================== --}}

    <div class="footer">

        <strong>{{ $edificio->nombre }}</strong>
        — Sistema de Gestión de Edificios

        <br>

        Reporte generado automáticamente el
        {{ date('d/m/Y H:i') }}

    </div>

</body>

</html>