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
            <div class="alert alert-success shadow-sm border-0 d-flex align-items-center mb-3 py-2">
                <i class="bi bi-check-circle-fill me-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger shadow-sm border-0 d-flex align-items-center mb-3 py-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- CONTENEDOR PRINCIPAL --}}
        <div class="card border-0 shadow-sm cajas-contenedor">

            {{-- CABECERA --}}
            <div class="card-header bg-primary text-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

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

                    <div class="d-flex gap-2 flex-wrap">

                        {{-- CATÁLOGO --}}
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalCatalogoTipos">

                            <i class="bi bi-list-ul text-primary"></i>
                            Ver catálogo

                        </button>

                        {{-- REGISTRAR TIPO --}}
                        <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalRegistrarTipoGeneral">

                            <i class="bi bi-plus-lg"></i>
                            Registrar tipo

                        </button>

                        {{-- NUEVA CAJA --}}
                        <a href="{{ route('cajas.create') }}" class="btn btn-light btn-sm">

                            <i class="bi bi-plus-circle-fill text-primary"></i>
                            Nueva Caja

                        </a>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-3">

                @if($cajas->count())

                    <div class="row g-3">

                        @foreach($cajas as $caja)

                            <div class="col-xl-3 col-lg-4 col-md-6">

                                <div class="card caja-card h-100 shadow-sm">

                                    {{-- INFORMACIÓN DE CAJA --}}
                                    <div class="card-body pb-2">

                                        {{-- NOMBRE / ESTADO --}}
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
                                                Ver movimientos

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

                        <a href="{{ route('cajas.create') }}" class="btn btn-primary">

                            <i class="bi bi-plus-circle-fill"></i>
                            Crear primera caja

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
    MODAL: CATÁLOGO DE TIPOS
    ========================================================= --}}
    <div class="modal fade modal-edifsoft" id="modalCatalogoTipos" tabindex="-1"
        aria-labelledby="modalCatalogoTiposLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">

                    <div class="d-flex align-items-center gap-2">

                        <div class="modal-icon modal-icon-primary">
                            <i class="bi bi-list-ul"></i>
                        </div>

                        <div>
                            <h5 class="modal-title fw-bold mb-0" id="modalCatalogoTiposLabel">
                                Catálogo de tipos de movimiento
                            </h5>

                            <small class="text-muted">
                                Tipos registrados para este edificio
                            </small>
                        </div>

                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row g-3">

                        {{-- =================================================
                        INGRESOS
                        ================================================= --}}
                        <div class="col-md-6">

                            <div class="card h-100 border-success">

                                <div class="card-header bg-success text-white py-2">

                                    <i class="bi bi-arrow-down-circle me-1"></i>

                                    Ingresos

                                </div>

                                <div class="card-body p-2">

                                    @forelse($tiposIngreso as $tipo)

                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                                            <div class="pe-2">

                                                <strong class="d-block">
                                                    {{ $tipo->nombre }}
                                                </strong>

                                                @if($tipo->descripcion)

                                                    <small class="d-block text-muted">
                                                        {{ $tipo->descripcion }}
                                                    </small>

                                                @endif

                                            </div>


                                            @if($tipo->estado)

                                                <span class="badge text-bg-success">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    Activo
                                                </span>

                                            @else

                                                <span class="badge text-bg-secondary">
                                                    <i class="bi bi-dash-circle-fill me-1"></i>
                                                    Inactivo
                                                </span>

                                            @endif

                                        </div>

                                    @empty

                                        <div class="text-center text-muted py-4">

                                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>

                                            No hay tipos de ingreso.

                                        </div>

                                    @endforelse

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                        EGRESOS
                        ================================================= --}}
                        <div class="col-md-6">

                            <div class="card h-100 border-danger">

                                <div class="card-header bg-danger text-white py-2">

                                    <i class="bi bi-arrow-up-circle me-1"></i>

                                    Egresos

                                </div>

                                <div class="card-body p-2">

                                    @forelse($tiposEgreso as $tipo)

                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                                            <div class="pe-2">

                                                <strong class="d-block">
                                                    {{ $tipo->nombre }}
                                                </strong>

                                                @if($tipo->descripcion)

                                                    <small class="d-block text-muted">
                                                        {{ $tipo->descripcion }}
                                                    </small>

                                                @endif

                                            </div>


                                            @if($tipo->estado)

                                                <span class="badge text-bg-success">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    Activo
                                                </span>

                                            @else

                                                <span class="badge text-bg-secondary">
                                                    <i class="bi bi-dash-circle-fill me-1"></i>
                                                    Inactivo
                                                </span>

                                            @endif

                                        </div>

                                    @empty

                                        <div class="text-center text-muted py-4">

                                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>

                                            No hay tipos de egreso.

                                        </div>

                                    @endforelse

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                        Cerrar
                    </button>

                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#modalRegistrarTipoGeneral">
                        <i class="bi bi-plus-lg"></i>
                        Registrar tipo
                    </button>

                </div>

            </div>

        </div>
    </div>


    {{-- =========================================================
    MODAL: REGISTRAR TIPO
    ========================================================= --}}
    <div class="modal fade modal-edifsoft" id="modalRegistrarTipoGeneral" tabindex="-1"
        aria-labelledby="modalRegistrarTipoGeneralLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">

            <div class="modal-content">

                <form action="{{ route('tipos-movimiento.store') }}" method="POST">

                    @csrf


                    {{-- HEADER --}}
                    <div class="modal-header">

                        <div class="d-flex align-items-center gap-2">

                            <div class="modal-icon modal-icon-primary">
                                <i class="bi bi-plus-lg"></i>
                            </div>

                            <div>

                                <h5 class="modal-title fw-bold mb-0" id="modalRegistrarTipoGeneralLabel">
                                    Registrar tipo
                                </h5>

                                <small class="text-muted">
                                    Nuevo tipo de movimiento
                                </small>

                            </div>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

                    </div>


                    {{-- BODY --}}
                    <div class="modal-body">

                        <div class="alert alert-info py-2 small mb-3">

                            <i class="bi bi-info-circle me-1"></i>

                            El tipo quedará registrado para el edificio seleccionado.

                        </div>


                        {{-- TIPO --}}
                        <div class="mb-3">

                            <label for="tipo_general" class="form-label fw-semibold">
                                Tipo de movimiento
                                <span class="text-danger">*</span>
                            </label>

                            <select name="tipo" id="tipo_general" class="form-select" required>

                                <option value="">
                                    Seleccione...
                                </option>

                                <option value="ingreso">
                                    Ingreso
                                </option>

                                <option value="egreso">
                                    Egreso
                                </option>

                            </select>

                        </div>


                        {{-- NOMBRE --}}
                        <div class="mb-3">

                            <label for="nombre_general" class="form-label fw-semibold">
                                Nombre
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="nombre" id="nombre_general" class="form-control" maxlength="150"
                                placeholder="Ej.: Pago de expensas" required>

                        </div>


                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-3">

                            <label for="descripcion_general" class="form-label fw-semibold">
                                Descripción
                                <small class="text-muted">
                                    (opcional)
                                </small>
                            </label>

                            <textarea name="descripcion" id="descripcion_general" class="form-control" rows="2"
                                maxlength="255" placeholder="Descripción del tipo de movimiento"></textarea>

                        </div>


                        {{-- ORDEN --}}
                        <div class="mb-0">

                            <label for="orden_general" class="form-label fw-semibold">
                                Orden
                            </label>

                            <input type="number" name="orden" id="orden_general" class="form-control" value="0" min="0">

                            <div class="form-text">
                                Permite controlar el orden en los listados.
                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i>
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i>
                            Guardar tipo
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    

</x-app-layout>