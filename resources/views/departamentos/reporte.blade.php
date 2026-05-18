<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Departamentos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 25px;
            color: #444;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-table td {
            border: 1px solid #bdbdbd;
            padding: 10px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 25%;
            text-align: center;
            background-color: #f5f5f5;
        }

        .title-cell {
            width: 75%;
            text-align: center;
        }

        .title {
            font-size: 28px;
            color: #e9b61f;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #666;
            font-size: 13px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            border: 1px solid #cfcfcf;
            padding: 8px;
            font-size: 12px;
        }

        .info-title {
            background-color: #e9b61f;
            color: white;
            font-weight: bold;
            width: 25%;
        }

        table.reporte {
            width: 100%;
            border-collapse: collapse;
        }

        table.reporte thead {
            background-color: #e9b61f;
            color: white;
        }

        table.reporte th {
            border: 1px solid #bdbdbd;
            padding: 10px;
            font-size: 12px;
        }

        table.reporte td {
            border: 1px solid #d0d0d0;
            padding: 9px;
            font-size: 11px;
            text-align: center;
        }

        table.reporte tbody tr:nth-child(even) {
            background-color: #f3f3f3;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 11px;
            color: gray;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>

</head>

<body>

    <table class="header-table">

        <tr>

            <td class="logo-cell">
                <img src="{{ public_path('images/logo.jpg') }}" width="140">
            </td>

            <td class="title-cell">

                <div class="title">
                    REPORTE DE DEPARTAMENTOS
                </div>

                <div class="subtitle">
                    Sistema de Gestión de Edificios - Econdorcet
                </div>

            </td>

        </tr>

    </table>

    <table class="info-table">

        <tr>
            <td class="info-title">Fecha</td>
            <td>{{ date('d/m/Y H:i') }}</td>
        </tr>

        <tr>
            <td class="info-title">Cantidad</td>
            <td>{{ count($departamentos) }}</td>
        </tr>

    </table>

    <table class="reporte">

        <thead>

            <tr>
                <th>Tipo</th>
                <th>Número</th>
                <th>Piso</th>
                <th>Propietario</th>
                <th>Edificio</th>
            </tr>

        </thead>

        <tbody>

            @foreach($departamentos as $dep)

                <tr>

                    <td>{{ $dep->tipo_departamento }}</td>
                    <td>{{ $dep->numero_departamento }}</td>
                    <td>{{ $dep->piso }}</td>
                    <td>
                        {{ $dep->propietario->nombres ?? '-' }} {{ $dep->propietario->apellido_paterno ?? '-'}} / 
                        {{ $dep->co_propietario ?? '-' }}
                    </td>
                    <td>
                        {{ $dep->edificio->nombre ?? '-' }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="footer">
        © {{ date('Y') }} Econdorcet
    </div>

</body>

</html>