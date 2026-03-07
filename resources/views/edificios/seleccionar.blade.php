<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Edificio</title>

    <!-- Sketchy -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/sketchy/bootstrap.min.css" rel="stylesheet">

    <!-- Tu CSS (solo layout) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">

    <h1 class="mb-5 text-center">🏢 Selecciona un Edificio</h1>

    <div class="row justify-content-center g-4">

        @foreach($edificios as $edificio)
            <div class="col-12 col-sm-6 col-md-6">

                <form method="POST" action="{{ route('edificios.elegir', $edificio->id) }}">
                    @csrf

                    <button type="submit" class="card w-100 shadow text-center p-4 border-0 card-custom">

                        <div class="fs- mb-2">🏢</div>

                        <h5 class="mb-0">{{ $edificio->nombre }}</h5>

                    </button>

                </form>

            </div>
        @endforeach

    </div>

</div>

</body>
</html>