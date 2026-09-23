<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-arrow-down-circle-fill text-success"></i>
                Registrar Ingreso
            </h3>

            <small class="text-muted">
                Registra un nuevo ingreso en la caja seleccionada
            </small>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">

        {{-- MENSAJE DE ERROR --}}
        @if(session('error'))
            <div class="alert alert-danger shadow-sm border-0 mb-4">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>
                        <strong>
                            No se pudo registrar el ingreso
                        </strong>

                        <div class="small mt-1">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ERRORES DE VALIDACIÓN --}}
        @if($errors->any())
            <div class="alert alert-danger shadow-sm border-0 mb-4">

                <div class="d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>
                        <strong>
                            Revisa los datos del formulario
                        </strong>

                        <div class="small mt-1">
                            Por favor completa o corrige los campos
                            marcados antes de continuar.
                        </div>

                        <ul class="mb-0 mt-2 small">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        @endif


        {{-- FORMULARIO --}}
        <div class="card border-0 shadow-sm formulario-propietario">

            {{-- CABECERA --}}
            <div class="card-header bg-success text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Nuevo Ingreso
                        </h5>

                        <small class="opacity-75">
                            Caja: {{ $caja->nombre }}
                        </small>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                {{-- SALDO ACTUAL --}}
                <div class="alert alert-light border shadow-sm mb-4">

                    <div class="d-flex align-items-center">

                        <div class="me-3">
                            <i class="bi bi-wallet2 fs-3 text-primary"></i>
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Saldo actual de la caja
                            </small>

                            <span class="text-success fw-bold fs-4">
                                Bs {{ number_format($caja->saldo, 2) }}
                            </span>

                        </div>

                    </div>

                </div>


                <form action="{{ route('cajas.ingreso.store', $caja->id) }}" method="POST">

                    @csrf


                    {{-- TÍTULO --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-cash-coin text-success"></i>

                        <span>
                            Información del ingreso
                        </span>

                    </div>


                    <div class="row g-3">

                        {{-- TIPO DE INGRESO --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Tipo de ingreso

                                <span class="campo-obligatorio">
                                    *
                                </span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-tags-fill"></i>
                                </span>

                                <select name="tipo_movimiento_id" id="tipo_movimiento_id"
                                    class="form-select @error('tipo_movimiento_id') is-invalid @enderror" required>

                                    <option value="">
                                        -- Seleccione un tipo --
                                    </option>

                                    @foreach($tiposIngreso as $tipo)

                                        <option value="{{ $tipo->id }}" @selected(
                                            old('tipo_movimiento_id') == $tipo->id
                                        )>
                                            {{ $tipo->nombre }}
                                        </option>

                                    @endforeach

                                </select>

                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#modalRegistrarTipo" title="Registrar nuevo tipo">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                            </div>

                            @error('tipo_movimiento_id')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- CONCEPTO --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Concepto

                                <span class="campo-obligatorio">
                                    *
                                </span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-receipt"></i>
                                </span>

                                <input type="text" name="concepto" value="{{ old('concepto') }}"
                                    class="form-control @error('concepto') is-invalid @enderror"
                                    placeholder="Ej. Pago de cuota de mantenimiento" required>

                            </div>

                            @error('concepto')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- MONTO --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">

                                Monto

                                <span class="campo-obligatorio">
                                    *
                                </span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>

                                <input type="number" name="monto" value="{{ old('monto') }}"
                                    class="form-control @error('monto') is-invalid @enderror" step="0.01" min="0.01"
                                    placeholder="0.00" required>

                            </div>

                            @error('monto')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- OBSERVACIÓN --}}
                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                Observación

                                <span class="text-muted small">
                                    (opcional)
                                </span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion align-items-start pt-3">
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </span>

                                <textarea name="observacion"
                                    class="form-control @error('observacion') is-invalid @enderror" rows="3"
                                    placeholder="Ingrese una observación o detalle del ingreso">{{ old('observacion') }}</textarea>

                            </div>

                            @error('observacion')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- NOTA --}}
                    <div class="nota-obligatorios mt-3 mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                        Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>


                    <hr class="my-4">


                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('cajas.movimientos', $caja->id) }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>

                            Registrar Ingreso

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL: REGISTRAR TIPO DE INGRESO --}}
    {{-- ========================================================= --}}

    <div class="modal fade modal-edifsoft" id="modalRegistrarTipo" tabindex="-1"
        aria-labelledby="modalRegistrarTipoLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-sm">

            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">

                    <div class="d-flex align-items-center gap-2">

                        <div class="modal-icon modal-icon-success">

                            <i class="bi bi-plus-lg"></i>

                        </div>

                        <div>

                            <h5 class="modal-title fw-bold mb-0" id="modalRegistrarTipoLabel">
                                Nuevo tipo de ingreso
                            </h5>

                            <small class="text-muted">
                                Agregar al catálogo
                            </small>

                        </div>

                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

                </div>


                {{-- BODY --}}
                <form action="{{ route('tipos-movimiento.store') }}" method="POST">

                    @csrf

                    <input type="hidden" name="tipo" value="ingreso">

                    <div class="modal-body">

                        {{-- NOMBRE --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Nombre

                                <span class="campo-obligatorio">
                                    *
                                </span>

                            </label>

                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control"
                                placeholder="Ej.: Expensas" maxlength="150" required>

                        </div>


                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Descripción

                                <span class="text-muted small">
                                    (opcional)
                                </span>

                            </label>

                            <textarea name="descripcion" class="form-control" rows="2" maxlength="255"
                                placeholder="Descripción opcional">{{ old('descripcion') }}</textarea>

                        </div>


                        {{-- ORDEN --}}
                        <div class="mb-0">

                            <label class="form-label fw-semibold">

                                Orden

                            </label>

                            <input type="number" name="orden" value="{{ old('orden', 0) }}" class="form-control"
                                min="0">

                            <div class="form-text">
                                Los números menores aparecen primero.
                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            <i class="bi bi-x-lg"></i>

                            Cancelar

                        </button>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-lg"></i>

                            Registrar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>