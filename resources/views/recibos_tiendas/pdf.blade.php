<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        .recibo {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }

        .titulo {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        .total {
            margin-top: 10px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }

        .firmas {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .firma {
            width: 45%;
            text-align: center;
        }

        .linea {
            border-top: 1px solid #000;
            margin-top: 40px;
        }
    </style>

</head>

<body>

    @for($i = 1; $i <= 2; $i++)

        <div class="recibo">

            <div class="titulo">
                <h3>RECIBO DE TIENDA</h3>
                <p>{{ $edificio->nombre }}</p>
                <p>{{ $edificio->direccion }}</p>
            </div>

            <p><strong>N°:</strong> {{ $recibo->numero }}</p>
            <p><strong>Fecha:</strong> {{ $recibo->fecha }}</p>

            <table>
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Monto</th>
                        <th>Moneda</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Pago Expensa Tienda</td>
                        <td>Bs. {{ number_format($recibo->monto, 2) }}</td>
                        <td>{{ $recibo->moneda }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="total">
                TOTAL: Bs. {{ number_format($recibo->monto, 2) }}
            </div>

            <div class="firmas">

                <div class="firma">
                    <div class="linea"></div>
                    ENTREGUÉ CONFORME
                </div>

                <div class="firma">
                    <div class="linea"></div>
                    RECIBÍ CONFORME
                </div>

            </div>

        </div>

        @if($i == 1)
            <div style="border-top:1px dashed #999; margin:20px 0;"></div>
        @endif

    @endfor

</body>

</html>