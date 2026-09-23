<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="mb-1 fw-bold">

                    <i class="bi bi-cash-stack text-primary"></i>

                    Pago de Expensas

                </h3>

                <small class="text-muted">

                    Administración y cobro de expensas del edificio

                </small>

            </div>

        </div>

    </x-slot>


    <div class="container-fluid py-4 px-4">


        <!-- ===================================================== -->
        <!-- TARJETA PRINCIPAL -->
        <!-- ===================================================== -->

        <div class="card border-0 shadow-sm pago-expensas-card">


            <!-- ================================================= -->
            <!-- ENCABEZADO -->
            <!-- ================================================= -->

            <div class="card-header bg-primary text-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="mb-1 fw-bold">

                            <i class="bi bi-receipt-cutoff"></i>

                            Aperturas de Expensas

                        </h5>

                        <small class="opacity-75">

                            Selecciona el tipo de pago que deseas administrar

                        </small>

                    </div>

                </div>

            </div>



            <!-- ================================================= -->
            <!-- TABLA -->
            <!-- ================================================= -->

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="text-center">
                                    #
                                </th>

                                <th>
                                    Mes
                                </th>

                                <th>
                                    Gestión
                                </th>

                                <th class="text-center">
                                    Saldo a Cobrar
                                </th>

                                <th class="text-center">
                                    🏢 Departamentos
                                </th>

                                <th class="text-center">
                                    🏪 Tiendas
                                </th>

                                <th class="text-center">
                                    🚗 Parqueos
                                </th>

                                <th class="text-center">
                                    💧 Agua
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse($aperturas as $apertura)

                                @if($apertura->edificio_id == session('edificio_id'))

                                    <tr>


                                        <!-- NÚMERO -->

                                        <td class="text-center fw-bold text-muted">

                                            {{ $aperturas->firstItem() + $loop->index }}

                                        </td>


                                        <!-- MES -->

                                        <td>

                                            <span class="fw-semibold">

                                                {{ $apertura->mes }}

                                            </span>

                                        </td>


                                        <!-- GESTIÓN -->

                                        <td>

                                            <span class="badge bg-secondary">

                                                {{ $apertura->gestion }}

                                            </span>

                                        </td>


                                        <!-- SALDO -->

                                        <td class="text-center">

                                            @if($apertura->saldo_cobrar > 0)

                                                <span class="badge bg-danger fs-6 px-3 py-2">

                                                    Bs.
                                                    {{ number_format($apertura->saldo_cobrar, 2) }}

                                                </span>

                                            @else

                                                <span class="badge bg-success fs-6 px-3 py-2">

                                                    Bs. 0.00

                                                </span>

                                            @endif

                                        </td>


                                        <!-- ================================================= -->
                                        <!-- EXPENSAS DEPARTAMENTOS -->
                                        <!-- ================================================= -->

                                        <td class="text-center">

                                            <a href="{{ route('pago-expensas.expensas', $apertura) }}"
                                                class="btn btn-info btn-sm btn-accion-expensa"
                                                title="Pago de Expensas de Departamentos">

                                                <i class="bi bi-cash-coin"></i>

                                            </a>

                                        </td>


                                        <!-- ================================================= -->
                                        <!-- TIENDAS -->
                                        <!-- ================================================= -->

                                        <td class="text-center">

                                            <a href="{{ route('pago-expensas.tiendas', $apertura) }}"
                                                class="btn btn-warning btn-sm btn-accion-expensa"
                                                title="Pago de Expensas de Tiendas">

                                                <i class="bi bi-cash-coin"></i>

                                            </a>

                                        </td>


                                        <!-- ================================================= -->
                                        <!-- PARQUEOS -->
                                        <!-- ================================================= -->

                                        <td class="text-center">

                                            <a href="{{ route('pago-expensas.estacionamientos', $apertura) }}"
                                                class="btn btn-dark btn-sm btn-accion-expensa"
                                                title="Pago de Expensas de Estacionamientos">

                                                <i class="bi bi-cash-coin"></i>

                                            </a>

                                        </td>


                                        <!-- ================================================= -->
                                        <!-- AGUA -->
                                        <!-- ================================================= -->

                                        <td class="text-center">

                                            <div class="d-flex justify-content-center gap-1">


                                                <!-- LECTURA -->

                                                <a href="{{ route('expensas_aguas.lecturas', $apertura->id) }}"
                                                    class="btn btn-info btn-sm btn-accion-expensa" title="Lectura de Agua">

                                                    <i class="bi bi-droplet"></i>

                                                </a>


                                                <!-- PAGO AGUA -->

                                                <a href="#" class="btn btn-success btn-sm btn-accion-expensa"
                                                    title="Pago de Agua">

                                                    <i class="bi bi-cash-coin"></i>

                                                </a>


                                            </div>

                                        </td>


                                    </tr>

                                @endif

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                            <strong>

                                                No hay aperturas de expensas registradas.

                                            </strong>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse


                        </tbody>

                    </table>

                </div>

            </div>



            <!-- ================================================= -->
            <!-- PAGINACIÓN -->
            <!-- ================================================= -->

            @if($aperturas->hasPages())

                <div class="card-footer bg-transparent border-0">

                    <div class="d-flex justify-content-center mt-2">

                        {{ $aperturas->links() }}

                    </div>

                </div>

            @endif


        </div>


    </div>



    <!-- ===================================================== -->
    <!-- ESTILOS -->
    <!-- ===================================================== -->

    <style>
        /* =====================================================
       TARJETA
    ===================================================== */

        .pago-expensas-card {

            border-radius: 14px;

            overflow: hidden;

            background: rgba(255, 255, 255, 0.82);

            backdrop-filter: blur(8px);

            -webkit-backdrop-filter: blur(8px);

        }



        /* =====================================================
       ENCABEZADO
    ===================================================== */

        .pago-expensas-card .card-header {

            border: none;

        }



        /* =====================================================
       TABLA
    ===================================================== */

        .pago-expensas-card .table {

            font-size: 17px;

        }


        .pago-expensas-card thead th {

            font-size: 15px;

            font-weight: 700;

            white-space: nowrap;

            padding: 14px 12px;

        }


        .pago-expensas-card tbody td {

            padding: 13px 12px;

        }


        .pago-expensas-card tbody tr {

            transition: all 0.2s ease;

        }


        .pago-expensas-card tbody tr:hover {

            background: rgba(13, 110, 253, 0.05);

        }



        /* =====================================================
       BOTONES DE ACCIONES
    ===================================================== */

        .btn-accion-expensa {

            width: 42px;

            height: 38px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            font-size: 17px;

            transition: all 0.2s ease;

        }


        .btn-accion-expensa:hover {

            transform: translateY(-2px);

            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.18);

        }



        /* =====================================================
       BADGES
    ===================================================== */

        .pago-expensas-card .badge {

            border-radius: 7px;

        }



        /* =====================================================
       RESPONSIVE
    ===================================================== */

        @media (max-width: 900px) {

            .pago-expensas-card .table {

                font-size: 15px;

            }

            .pago-expensas-card thead th {

                font-size: 13px;

            }

        }
    </style>

</x-app-layout>