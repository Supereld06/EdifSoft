<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ✅ Bootswatch Sketchy -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/sketchy/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- ✅ Tu CSS (solo layout) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar bg-dark text-white p-3 d-flex flex-column justify-content-between sidebar-custom">

        <div>
            <!-- USUARIO -->
            <div class="user-box text-center">
                <h1 class="fw-bold display-5"><span style="color: orange;">Edif</span><span>Soft</span></h1>
                <h6 class="mb-1"> Usuario : {{ auth()->user()->name }}</h6>
                <small>🏢 Edificio : {{ session('edificio_nombre') ?? 'Sin edificio' }}</small>
            </div>

            <!-- MENÚ -->
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edificios.index') }}" class="nav-link text-white">🏢 Edificios</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('propietarios.index') }}" class="nav-link text-white">👤 Propietarios</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('departamentos.index') }}" class="nav-link text-white">🏢 Departamentos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('apertura.index') }}" class="nav-link text-white"> 📅 Apertura Mes</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('expensas.index') }}" class="nav-link text-white">💰 Expensas</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">🚗 Estacionamiento</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">⚙️ Configuración</a>
                </li>
            </ul>
        </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger w-100">Cerrar sesión</button>
        </form>

    </div>

    <!-- CONTENIDO -->
    <div class="content flex-grow-1">

        <!-- HEADER -->
        @isset($header)
            <div class="p-3 border-bottom bg-light">
                {{ $header }}
            </div>
        @endisset

        <!-- MAIN -->
        <div class="container-fluid p-4">
            {{ $slot }}
        </div>

    </div>
    

</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>