<!DOCTYPE html>
<html>

<head>
    <title>Recibo Estacionamiento</title>
</head>

<body>

    <h2>{{ $edificio->nombre }}</h2>

    <hr>

    <p>N°: {{ $recibo->numero }}</p>
    <p>Fecha: {{ $recibo->fecha }}</p>

    <p>Propietario:
        {{ $recibo->propietario->nombres }}
        {{ $recibo->propietario->apellido_paterno }}
    </p>

    <p>Estacionamiento: {{ $recibo->estacionamiento->numero_estacionamiento }}</p>

    <p>Monto: Bs {{ $recibo->monto }}</p>

    <p>Mes: {{ $recibo->mes }} - {{ $recibo->gestion }}</p>

</body>

</html>