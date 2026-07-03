<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Propietarios</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            margin: 25px;
            color: #444;
        }

        /* ===== ENCABEZADO ===== */

        .header-table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-table td{
            border: 1px solid #bdbdbd;
            padding: 10px;
            vertical-align: middle;
        }

        .logo-cell{
            width: 25%;
            text-align: center;
            background-color: #f5f5f5;
        }

        .title-cell{
            width: 75%;
            text-align: center;
        }

        .title{
            font-size: 28px;
            color: #e9b61f;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle{
            color: #666;
            font-size: 13px;
        }

        /* ===== INFORMACION ===== */

        .info-table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td{
            border: 1px solid #cfcfcf;
            padding: 8px;
            font-size: 12px;
        }

        .info-title{
            background-color: #e9b61f;
            color: white;
            font-weight: bold;
            width: 25%;
        }

        /* ===== TABLA ===== */

        table.reporte{
            width: 100%;
            border-collapse: collapse;
        }

        table.reporte thead{
            background-color: #e9b61f;
            color: white;
        }

        table.reporte th{
            border: 1px solid #bdbdbd;
            padding: 10px;
            font-size: 12px;
        }

        table.reporte td{
            border: 1px solid #d0d0d0;
            padding: 9px;
            font-size: 11px;
            text-align: center;
        }

        table.reporte tbody tr:nth-child(even){
            background-color: #f3f3f3;
        }

        /* ===== FOOTER ===== */

        .footer{
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

    <!-- ENCABEZADO -->
    <table class="header-table">

        <tr>

            <td class="logo-cell">
                <img 
                    src="{{ public_path('images/logo.jpg') }}" 
                    width="140"
                >
            </td>

            <td class="title-cell">

                <div class="title">
                    REPORTE DE PROPIETARIOS
                </div>

                <div class="subtitle">
                    Sistema de Gestión de Edificios - Econdorcet
                </div>

            </td>

        </tr>

    </table>

    <!-- INFORMACION -->
    <table class="info-table">

        <tr>
            <td class="info-title">Fecha de Emisión</td>
            <td>{{ date('d/m/Y H:i') }}</td>
        </tr>

        <tr>
            <td class="info-title">Cantidad de Registros</td>
            <td>{{ count($propietarios) }}</td>
        </tr>

    </table>

    <!-- TABLA -->
    <table class="reporte">

        <thead>

            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Edificio</th>
                <th>Deuda</th>
            </tr>

        </thead>

        <tbody>

            @foreach($propietarios as $prop)

            <tr>
                <td>{{ $prop->nombres }}</td>
                <td>{{ $prop->apellido_paterno }} {{ $prop->apellido_materno }}</td>
                <td>{{ $prop->edificio->nombre ?? '-' }}</td>
                <td>{{ number_format($prop->deuda_total, 2) }} Bs</td>
            </tr>

            @endforeach

        </tbody>

    </table>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} Econdorcet - Todos los derechos reservados
    </div>

</body>
</html>