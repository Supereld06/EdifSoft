<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-wallet2 text-primary"></i>
                Cajas
            </h3>

            <small class="text-muted">
                Administración de las cajas del edificio seleccionado
            </small>
        </div>
    </x-slot>


    <div class="container-fluid py-3 px-4">

        {{-- MENSAJES --}}
        @if(session('success'))
            <div class="alert alert-success shadow-sm border-0 d-flex align-items-center mb-3">
                <i class="bi bi-check-circle-fill me-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger shadow-sm border-0 d-flex align-items-center mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        {{-- CABECERA --}}
        <div class="card border-0 shadow-sm cajas-contenedor">

            <div class="card-header bg-primary text-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">

                        <div class="cajas-icon-header me-3">
                            <i class="bi bi-wallet2"></i>
                        </div>

                        <div>
                            <h5 class="mb-0 fw-bold">
                                Cajas del edificio
                            </h5>

                            <small class="opacity-75">
                                Consulta saldos y administra movimientos
                            </small>
                        </div>

                    </div>


                    <a href="{{ route('cajas.create') }}"
                       class="btn btn-light btn-sm">

                        <i class="bi bi-plus-circle-fill text-primary"></i>
                        Nueva Caja

                    </a>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-3">

                @if($cajas->count())

                    <div class="row g-3">

                        @foreach($cajas as $caja)

                            <div class="col-xl-3 col-lg-4 col-md-6">

                                <div class="card caja-card h-100 shadow-sm">

                                    {{-- CABECERA DE CAJA --}}
                                    <div class="card-body pb-2">

                                        <div class="d-flex justify-content-between align-items-start gap-2">

                                            <div class="d-flex align-items-center">

                                                <div class="caja-icon me-2">
                                                    <i class="bi bi-wallet-fill"></i>
                                                </div>

                                                <div>

                                                    <h6 class="mb-0 fw-bold">
                                                        {{ $caja->nombre }}
                                                    </h6>

                                                    <small class="text-muted">
                                                        Caja
                                                    </small>

                                                </div>

                                            </div>


                                            @if($caja->estado)

                                                <span class="badge bg-success-subtle text-success">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    Activa
                                                </span>

                                            @else

                                                <span class="badge bg-secondary-subtle text-secondary">
                                                    <i class="bi bi-dash-circle-fill"></i>
                                                    Inactiva
                                                </span>

                                            @endif

                                        </div>


                                        {{-- DESCRIPCIÓN --}}
                                        <div class="caja-descripcion mt-3">

                                            <i class="bi bi-info-circle text-muted me-1"></i>

                                            <span>
                                                {{ $caja->descripcion ?: 'Sin descripción' }}
                                            </span>

                                        </div>


                                        {{-- SALDO --}}
                                        <div class="caja-saldo mt-3">

                                            <small class="text-muted d-block">
                                                Saldo actual
                                            </small>

                                            <div class="d-flex align-items-center justify-content-between">

                                                <h4 class="mb-0 fw-bold text-success">
                                                    Bs {{ number_format($caja->saldo, 2) }}
                                                </h4>

                                                <i class="bi bi-cash-stack text-success fs-4"></i>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- ACCIONES --}}
                                    <div class="card-footer bg-white border-top-0 pt-0 pb-3 px-3">

                                        <div class="d-grid gap-2">

                                            {{-- MOVIMIENTOS --}}
                                            <a href="{{ route('cajas.movimientos', $caja->id) }}"
                                               class="btn btn-outline-primary btn-sm">

                                                <i class="bi bi-list-ul"></i>
                                                Ver Movimientos

                                            </a>


                                            {{-- INGRESO / EGRESO --}}
                                            <div class="row g-2">

                                                <div class="col-6">

                                                    <a href="{{ route('cajas.ingreso.create', $caja->id) }}"
                                                       class="btn btn-outline-success btn-sm w-100">

                                                        <i class="bi bi-arrow-down-circle"></i>
                                                        Ingreso

                                                    </a>

                                                </div>


                                                <div class="col-6">

                                                    <a href="{{ route('cajas.egreso.create', $caja->id) }}"
                                                       class="btn btn-outline-danger btn-sm w-100">

                                                        <i class="bi bi-arrow-up-circle"></i>
                                                        Egreso

                                                    </a>

                                                </div>

                                            </div>


                                            {{-- TRANSFERENCIA --}}
                                            <a href="{{ route('cajas.transferencia.create', $caja->id) }}"
                                               class="btn btn-outline-warning btn-sm">

                                                <i class="bi bi-arrow-left-right"></i>
                                                Transferir

                                            </a>


                                            {{-- EDITAR --}}
                                            <a href="{{ route('cajas.edit', $caja->id) }}"
                                               class="btn btn-outline-secondary btn-sm">

                                                <i class="bi bi-pencil-square"></i>
                                                Editar Caja

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                @else

                    {{-- SIN CAJAS --}}
                    <div class="cajas-vacio text-center py-5">

                        <div class="cajas-vacio-icon mb-3">
                            <i class="bi bi-wallet2"></i>
                        </div>

                        <h5 class="fw-bold mb-2">
                            No hay cajas registradas
                        </h5>

                        <p class="text-muted mb-3">
                            No existen cajas creadas para este edificio.
                        </p>

                        <a href="{{ route('cajas.create') }}"
                           class="btn btn-primary">

                            <i class="bi bi-plus-circle-fill"></i>
                            Crear primera caja

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>

