<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        🏣 EdifSoft - {{ session('edificio_nombre') ?? 'Sin edificio' }}
    </title>


    <!-- ===================================================== -->
    <!-- BOOTSWATCH SKETCHY -->
    <!-- ===================================================== -->

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/sketchy/bootstrap.min.css" rel="stylesheet">


    <!-- ===================================================== -->
    <!-- BOOTSTRAP ICONS -->
    <!-- ===================================================== -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <!-- ===================================================== -->
    <!-- SELECT2 -->
    <!-- ===================================================== -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">


    <!-- ===================================================== -->
    <!-- CSS PRINCIPAL -->
    <!-- ===================================================== -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

</head>

<body>

    
    @php

        $edificioSeleccionado = null;

        if (session('edificio_id')) {

            $edificioSeleccionado = \App\Models\Edificio::find(
                session('edificio_id')
            );

        }

    @endphp


    <!-- ===================================================== -->
    <!-- LAYOUT PRINCIPAL -->
    <!-- ===================================================== -->

    <div class="layout">


        <!-- ===================================================== -->
        <!-- SIDEBAR -->
        <!-- ===================================================== -->

        <div class="sidebar bg-dark text-white sidebar-custom">


            <!-- ================================================= -->
            <!-- CABECERA DEL SIDEBAR -->
            <!-- ================================================= -->

            <div class="sidebar-header">


                <!-- EDIFSOFT -->

                <div class="edifsoft-logo">

                    <span>Edif</span><strong>Soft</strong>

                </div>


                <!-- LOGO DEL EDIFICIO -->

                <div class="edificio-logo-container">

                    @if ($edificioSeleccionado && $edificioSeleccionado->logo_edificio)

                        <div class="logo-edificio-sidebar">

                            <img src="{{ asset('storage/' . $edificioSeleccionado->logo_edificio) }}"
                                alt="Logo del edificio">

                        </div>

                    @else

                        <div class="logo-edificio-sidebar logo-vacio">

                            <i class="bi bi-buildings-fill"></i>

                        </div>

                    @endif

                </div>


                <!-- NOMBRE DEL EDIFICIO -->

                <div class="nombre-edificio-sidebar">

                    <i class="bi bi-buildings-fill text-warning"></i>

                    {{ $edificioSeleccionado->nombre ?? session('edificio_nombre', 'Sin edificio') }}

                </div>


                <!-- USUARIO -->

                <div class="usuario-sidebar">

                    <i class="bi bi-person-circle text-info"></i>

                    {{ auth()->user()->name }}

                </div>


            </div>



            <!-- ================================================= -->
            <!-- MENÚ SCROLL -->
            <!-- ================================================= -->

            <div class="sidebar-menu">


                <ul class="nav flex-column">


                    <!-- DASHBOARD -->

                    <li class="nav-item">

                        <a href="{{ route('dashboard') }}" class="nav-link text-white">

                            🏠 Dashboard

                        </a>

                    </li>


                    <!-- EDIFICIOS -->

                    <li class="nav-item">

                        <a href="{{ route('edificios.index') }}" class="nav-link text-white">

                            🏙️ Edificios

                        </a>

                    </li>


                    <!-- CAJAS -->

                    <li class="nav-item">

                        <a href="{{ route('cajas.index') }}" class="nav-link text-white">

                            💰 Cajas

                        </a>

                    </li>


                    <!-- PROPIETARIOS -->

                    <li class="nav-item">

                        <a href="{{ route('propietarios.index') }}" class="nav-link text-white">

                            👤 Propietarios

                        </a>

                    </li>


                    <!-- DEPARTAMENTOS -->

                    <li class="nav-item">

                        <a href="{{ route('departamentos.index') }}" class="nav-link text-white">

                            🏢 Departamentos

                        </a>

                    </li>


                    <!-- TIENDAS -->

                    <li class="nav-item">

                        <a href="{{ route('tiendas.index') }}" class="nav-link text-white">

                            🏪 Tiendas

                        </a>

                    </li>


                    <!-- PARQUEOS -->

                    <li class="nav-item">

                        <a href="{{ route('estacionamientos.index') }}" class="nav-link text-white">

                            🚗 Parqueo

                        </a>

                    </li>


                    <!-- APERTURA -->

                    <li class="nav-item">

                        <a href="{{ route('apertura-expensas.index') }}" class="nav-link text-white">

                            📅 Apertura Mes

                        </a>

                    </li>


                    <!-- PAGO EXPENSAS -->

                    <li class="nav-item">

                        <a href="{{ route('pago-expensas.index') }}" class="nav-link text-white">

                            💰 Pago Expensas

                        </a>

                    </li>


                    <!-- LECTURA AGUA -->

                    <li class="nav-item">

                        <a href="{{ route('expensas_aguas.index') }}" class="nav-link text-white">

                            🚿 Lectura Agua

                        </a>

                    </li>


                    <!-- DEUDAS -->

                    <li class="nav-item">

                        <a href="#" class="nav-link text-white">

                            ⚠️ Deudas

                        </a>

                    </li>



                    <!-- ================================================= -->
                    <!-- RECIBOS -->
                    <!-- ================================================= -->

                    <li class="nav-item">

                        <a class="nav-link text-white d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse" href="#menuRecibos" role="button" aria-expanded="false">

                            <span>
                                📋 Recibos
                            </span>

                            <span>
                                ▫️
                            </span>

                        </a>


                        <div class="collapse" id="menuRecibos">

                            <ul class="nav flex-column ms-3">


                                <li class="nav-item">

                                    <a href="{{ route('recibos_expensas.index') }}" class="nav-link text-white">

                                        📝 Recibos Expensas

                                    </a>

                                </li>


                                <li class="nav-item">

                                    <a href="{{ route('recibos_tiendas.index') }}" class="nav-link text-white">

                                        📝 Recibos Tiendas

                                    </a>

                                </li>


                                <li class="nav-item">

                                    <a href="{{ route('recibos_estacionamientos.index') }}" class="nav-link text-white">

                                        📝 Recibos Parqueos

                                    </a>

                                </li>


                                <li class="nav-item">

                                    <a href="#" class="nav-link text-white">

                                        📝 Recibos Agua

                                    </a>

                                </li>


                            </ul>

                        </div>

                    </li>



                    <!-- ================================================= -->
                    <!-- INGRESOS -->
                    <!-- ================================================= -->

                    <li class="nav-item">


                        <a class="nav-link text-white d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse" href="#menuIngresos" role="button" aria-expanded="false">

                            <span>
                                📈 Ingresos
                            </span>

                            <span>
                                ▫️
                            </span>

                        </a>


                        <div class="collapse" id="menuIngresos">

                            <ul class="nav flex-column ms-3">


                                <li class="nav-item">

                                    <a href="#" class="nav-link text-white">

                                        ➕ Ingresos Fijos

                                    </a>

                                </li>


                                <li class="nav-item">

                                    <a href="#" class="nav-link text-white">

                                        ➕ Ingresos Variables

                                    </a>

                                </li>


                            </ul>

                        </div>


                    </li>



                    <!-- ================================================= -->
                    <!-- EGRESOS -->
                    <!-- ================================================= -->

                    <li class="nav-item">


                        <a class="nav-link text-white d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse" href="#menuEgresos" role="button" aria-expanded="false">

                            <span>
                                📉 Egresos
                            </span>

                            <span>
                                ▫️
                            </span>

                        </a>


                        <div class="collapse" id="menuEgresos">

                            <ul class="nav flex-column ms-3">


                                <li class="nav-item">

                                    <a href="#" class="nav-link text-white">

                                        ➖ Egresos Fijos

                                    </a>

                                </li>


                                <li class="nav-item">

                                    <a href="#" class="nav-link text-white">

                                        ➖ Egresos Variables

                                    </a>

                                </li>


                            </ul>

                        </div>


                    </li>



                    <!-- INFORMES -->

                    <li class="nav-item">

                        <a href="#" class="nav-link text-white">

                            📊 Informes

                        </a>

                    </li>


                    <!-- DEUDAS POR PROPIETARIO -->

                    <li class="nav-item">

                        <a href="#" class="nav-link text-white">

                            💲 Deudas por Propietario

                        </a>

                    </li>


                    <!-- CONFIGURACIÓN -->

                    <li class="nav-item">

                        <a href="#" class="nav-link text-white">

                            ⚙️ Configuración

                        </a>

                    </li>


                </ul>


            </div>



            <!-- ================================================= -->
            <!-- PARTE INFERIOR DEL SIDEBAR -->
            <!-- ================================================= -->

            <div class="sidebar-footer">


                <!-- CERRAR SESIÓN -->

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button class="btn btn-danger w-100">

                        <i class="bi bi-box-arrow-right"></i>

                        Cerrar sesión

                    </button>

                </form>


                <!-- FOOTER -->

                <div class="footer-econdorcet">

                    <small>

                        Econdorcet

                    </small>

                </div>


            </div>


        </div>



        <!-- ===================================================== -->
        <!-- CONTENIDO -->
        <!-- ===================================================== -->

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



    <!-- ===================================================== -->
    <!-- ESTILOS DEL SIDEBAR -->
    <!-- ===================================================== -->

    <style>
        /* =====================================================
       SIDEBAR GENERAL
    ===================================================== */

        .sidebar-custom {

            height: 100vh;

            min-height: 100vh;

            display: flex;

            flex-direction: column;

            padding: 15px !important;

            overflow: hidden;

        }



        /* =====================================================
       CABECERA
    ===================================================== */

        .sidebar-header {

            flex-shrink: 0;

            text-align: center;

            padding-bottom: 12px;

            border-bottom: 1px solid rgba(255, 255, 255, 0.15);

        }



        /* =====================================================
       EDIFSOFT
    ===================================================== */

        .edifsoft-logo {

            font-size: 1.65rem;

            font-weight: 700;

            line-height: 1;

            letter-spacing: 1px;

            margin-bottom: 12px;

        }


        .edifsoft-logo span {

            color: orange;

        }


        .edifsoft-logo strong {

            color: white;

        }



        /* =====================================================
       LOGO EDIFICIO
    ===================================================== */

        .edificio-logo-container {

            display: flex;

            justify-content: center;

            margin-bottom: 8px;

        }


        .logo-edificio-sidebar {

            width: 82px;

            height: 82px;

            background: rgba(255, 255, 255, 0.95);

            border: 3px solid rgba(255, 193, 7, 0.85);

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);

        }


        .logo-edificio-sidebar img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            padding: 5px;

        }


        .logo-vacio {

            color: #6c757d;

            font-size: 2.2rem;

        }



        /* =====================================================
       NOMBRE EDIFICIO
    ===================================================== */

        .nombre-edificio-sidebar {

            color: white;

            font-size: 1rem;

            font-weight: 700;

            margin-top: 5px;

            margin-bottom: 5px;

        }



        /* =====================================================
       USUARIO
    ===================================================== */

        .usuario-sidebar {

            color: rgba(255, 255, 255, 0.85);

            font-size: 0.85rem;

        }



        /* =====================================================
       MENÚ CON SCROLL
    ===================================================== */

        .sidebar-menu {

            flex: 1;

            min-height: 0;

            overflow-y: auto;

            overflow-x: hidden;

            margin-top: 10px;

            padding-right: 4px;

        }


        /* Scrollbar */

        .sidebar-menu::-webkit-scrollbar {

            width: 6px;

        }


        .sidebar-menu::-webkit-scrollbar-track {

            background: rgba(255, 255, 255, 0.04);

            border-radius: 10px;

        }


        .sidebar-menu::-webkit-scrollbar-thumb {

            background: rgba(255, 255, 255, 0.30);

            border-radius: 10px;

        }


        .sidebar-menu::-webkit-scrollbar-thumb:hover {

            background: rgba(255, 255, 255, 0.50);

        }



        /* =====================================================
       ENLACES
    ===================================================== */

        .sidebar .nav-link {

            border-radius: 8px;

            margin-bottom: 3px;

            padding: 8px 10px;

            transition: all 0.2s ease;

        }


        .sidebar .nav-link:hover {

            background: rgba(255, 255, 255, 0.12);

            padding-left: 15px;

        }


        .sidebar .nav-link:focus {

            background: rgba(255, 255, 255, 0.12);

        }



        /* =====================================================
       SUBMENÚS
    ===================================================== */

        .sidebar .collapse .nav-link {

            font-size: 0.92rem;

            padding-top: 6px;

            padding-bottom: 6px;

        }



        /* =====================================================
       PARTE INFERIOR
    ===================================================== */

        .sidebar-footer {

            flex-shrink: 0;

            padding-top: 10px;

            border-top: 1px solid rgba(255, 255, 255, 0.15);

        }


        .sidebar-footer .btn {

            border-radius: 8px;

            font-weight: 600;

        }



        /* =====================================================
       ECONDORCET
    ===================================================== */

        .footer-econdorcet {

            text-align: center;

            margin-top: 8px;

            padding-top: 5px;

            color: rgba(255, 255, 255, 0.45);

            font-size: 0.72rem;

            letter-spacing: 0.5px;

        }


        /* =====================================================
       CONTENIDO
    ===================================================== */

        .content {

            min-width: 0;

            min-height: 100vh;

        }
    </style>



    <!-- ===================================================== -->
    <!-- BOOTSTRAP JS -->
    <!-- ===================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- ===================================================== -->
    <!-- JQUERY -->
    <!-- ===================================================== -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <!-- ===================================================== -->
    <!-- SELECT2 -->
    <!-- ===================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    @stack('scripts')

</body>

</html>