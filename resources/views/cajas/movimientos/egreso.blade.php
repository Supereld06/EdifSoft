<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-arrow-up-circle-fill text-danger"></i>
                Registrar Egreso
            </h3>

            <small class="text-muted">
                Registra un nuevo egreso en la caja seleccionada
            </small>
        </div>
    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- MENSAJE DE ERROR DE SESIÓN --}}
        @if(session('error'))
            <div class="alert alert-danger shadow-sm border-0 mb-4">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>
                        <strong>
                            No se pudo registrar el egreso
                        </strong>

                        <div class="small mt-1">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{-- MENSAJE GENERAL DE ERRORES --}}
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
                    </div>
                </div>
            </div>
        @endif


        {{-- FORMULARIO --}}
        <div class="card border-0 shadow-sm formulario-propietario">

            {{-- CABECERA --}}
            <div class="card-header bg-danger text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>

                    <div>
                        <h5 class="mb-0 fw-bold">
                            Nuevo Egreso
                        </h5>

                        <small class="opacity-75">
                            Caja: {{ $caja->nombre }}
                        </small>
                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                {{-- SALDO DISPONIBLE --}}
                <div class="alert alert-light border shadow-sm mb-4">

                    <div class="d-flex align-items-center">

                        <div class="me-3">
                            <i class="bi bi-wallet2 fs-3 text-primary"></i>
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Saldo disponible de la caja
                            </small>

                            <span class="text-success fw-bold fs-4">
                                Bs {{ number_format($caja->saldo, 2) }}
                            </span>

                        </div>

                    </div>

                </div>


                <form action="{{ route('cajas.egreso.store', $caja->id) }}" method="POST">

                    @csrf


                    {{-- DATOS DEL EGRESO --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-cash-coin text-danger"></i>

                        <span>
                            Información del egreso
                        </span>

                    </div>


                    <div class="row g-3">

                        {{-- TIPO DE EGRESO --}}
                        <div class="col-md-4">

                            <label for="tipo_movimiento_id" class="form-label fw-semibold">
                                Tipo de egreso
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <select name="tipo_movimiento_id" id="tipo_movimiento_id"
                                    class="form-select @error('tipo_movimiento_id') is-invalid @enderror" required>

                                    <option value="">
                                        -- Seleccione un tipo --
                                    </option>

                                    @foreach($tiposEgreso as $tipo)

                                        <option value="{{ $tipo->id }}" @selected(old('tipo_movimiento_id') == $tipo->id)>
                                            {{ $tipo->nombre }}
                                        </option>

                                    @endforeach

                                </select>

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalRegistrarTipo" title="Agregar tipo de egreso">
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

                            <label for="concepto" class="form-label fw-semibold">
                                Concepto
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-receipt"></i>
                                </span>

                                <input type="text" name="concepto" id="concepto" value="{{ old('concepto') }}"
                                    class="form-control @error('concepto') is-invalid @enderror"
                                    placeholder="Ej. Compra de materiales" required>

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

                            <label for="monto" class="form-label fw-semibold">
                                Monto
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>

                                <input type="number" name="monto" id="monto" value="{{ old('monto') }}"
                                    class="form-control @error('monto') is-invalid @enderror" step="0.01" min="0.01"
                                    max="{{ $caja->saldo }}" placeholder="0.00" required>

                            </div>

                            @error('monto')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted mt-1 d-block">
                                El monto no puede superar el saldo disponible.
                            </small>

                        </div>


                        {{-- OBSERVACIÓN --}}
                        <div class="col-12">

                            <label for="observacion" class="form-label fw-semibold">
                                Observación
                                <span class="text-muted small">
                                    (opcional)
                                </span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion align-items-start pt-2">
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </span>

                                <textarea name="observacion" id="observacion"
                                    class="form-control @error('observacion') is-invalid @enderror" rows="3"
                                    placeholder="Ingrese una observación o detalle del egreso">{{ old('observacion') }}</textarea>

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

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-check-circle-fill"></i>
                            Registrar Egreso
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
    MODAL: REGISTRAR TIPO DE EGRESO
    ============================================================ --}}
    <div class="modal fade modal-edifsoft" id="modalRegistrarTipo" tabindex="-1"
        aria-labelledby="modalRegistrarTipoLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-sm">

            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">

                    <div class="d-flex align-items-center gap-2">

                        <div class="modal-icon modal-icon-danger">
                            <i class="bi bi-dash-lg"></i>
                        </div>

                        <div>

                            <h5 class="modal-title fw-bold mb-0" id="modalRegistrarTipoLabel">
                                Nuevo tipo de egreso
                            </h5>

                            <small class="text-muted">
                                Agregar al catálogo
                            </small>

                        </div>

                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

                </div>


                {{-- FORMULARIO --}}
                <form action="{{ route('tipos-movimiento.store') }}" method="POST">

                    @csrf

                    {{-- IMPORTANTE:
                    Esta vista es de EGRESO --}}
                    <input type="hidden" name="tipo" value="egreso">


                    {{-- BODY --}}
                    <div class="modal-body">

                        {{-- NOMBRE --}}
                        <div class="mb-3">

                            <label for="nombre_tipo" class="form-label fw-semibold">
                                Nombre
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="nombre" id="nombre_tipo" class="form-control"
                                placeholder="Ej.: Compra de materiales" maxlength="150" required>

                        </div>


                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-3">

                            <label for="descripcion_tipo" class="form-label fw-semibold">
                                Descripción
                            </label>

                            <textarea name="descripcion" id="descripcion_tipo" class="form-control" rows="2"
                                maxlength="255" placeholder="Descripción opcional"></textarea>

                        </div>


                        {{-- ORDEN --}}
                        <div class="mb-0">

                            <label for="orden_tipo" class="form-label fw-semibold">
                                Orden
                            </label>

                            <input type="number" name="orden" id="orden_tipo" class="form-control" value="0" min="0">

                            <div class="form-text">
                                Define la posición del tipo en el listado.
                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i>
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-check-lg"></i>
                            Registrar
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>