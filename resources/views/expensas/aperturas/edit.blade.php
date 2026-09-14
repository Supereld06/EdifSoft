<x-app-layout>

<x-slot name="header">

    <div>
        <h3 class="mb-1 fw-bold">
            <i class="bi bi-pencil-square text-info"></i>
            Editar Apertura de Expensas
        </h3>

        <small class="text-muted">
            Modifica los datos de la apertura de expensas
        </small>
    </div>

</x-slot>


<div class="container-fluid py-2 px-4">

    {{-- MENSAJE GENERAL DE ERRORES --}}
    @if($errors->any())

        <div class="alert alert-danger shadow-sm border-0 mb-3">

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


    <div class="card border-0 shadow-sm formulario-apertura">


        {{-- CABECERA --}}
        <div class="card-header bg-info text-white border-0">

            <div class="d-flex align-items-center">

                <div class="icon-header me-3">

                    <i class="bi bi-calendar2-check-fill"></i>

                </div>

                <div>

                    <h5 class="mb-0 fw-bold">
                        Modificar Apertura
                    </h5>

                    <small class="opacity-75">
                        Actualiza la información de la apertura
                    </small>

                </div>

            </div>

        </div>


        {{-- CUERPO --}}
        <div class="card-body p-3">

            <form method="POST"
                  action="{{ route('apertura-expensas.update', $apertura_expensa) }}">

                @csrf

                @method('PUT')


                {{-- =================================
                     INFORMACIÓN GENERAL
                ================================== --}}

                <div class="section-title mb-3">

                    <i class="bi bi-calendar3 text-primary"></i>

                    <span>Información general</span>

                </div>


                <div class="row g-2">


                    {{-- MES --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Mes

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-mes">

                                <i class="bi bi-calendar-month"></i>

                            </span>

                            <input
                                type="text"
                                name="mes"
                                value="{{ old('mes', $apertura_expensa->mes) }}"
                                class="form-control @error('mes') is-invalid @enderror"
                                placeholder="Ej. Enero"
                                required
                            >

                        </div>

                        @error('mes')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- GESTIÓN --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Gestión

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-gestion">

                                <i class="bi bi-calendar3"></i>

                            </span>

                            <input
                                type="number"
                                name="gestion"
                                value="{{ old('gestion', $apertura_expensa->gestion) }}"
                                class="form-control @error('gestion') is-invalid @enderror"
                                placeholder="Ej. 2026"
                                min="2000"
                                max="2100"
                                required
                            >

                        </div>

                        @error('gestion')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- EDIFICIO --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Edificio

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-edificio">

                                <i class="bi bi-building-fill"></i>

                            </span>

                            <input
                                type="text"
                                class="form-control bg-light"
                                value="{{ session('edificio_nombre') }}"
                                readonly
                            >

                        </div>

                        <input
                            type="hidden"
                            name="edificio_id"
                            value="{{ session('edificio_id') }}"
                        >

                        @error('edificio_id')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================
                     DATOS INICIALES
                ================================== --}}

                <div class="section-title mb-3 mt-2">

                    <i class="bi bi-wallet2 text-success"></i>

                    <span>Datos iniciales</span>

                </div>


                <div class="row g-2">


                    {{-- SALDO INICIAL --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Saldo Inicial (Bs.)

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-dinero">

                                <i class="bi bi-cash-stack"></i>

                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="saldo_inicial"
                                value="{{ old('saldo_inicial', $apertura_expensa->saldo_inicial) }}"
                                class="form-control @error('saldo_inicial') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('saldo_inicial')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- EFECTIVO INICIAL --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Efectivo Inicial (Bs.)

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-dinero">

                                <i class="bi bi-cash"></i>

                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="efectivo_inicial"
                                value="{{ old('efectivo_inicial', $apertura_expensa->efectivo_inicial) }}"
                                class="form-control @error('efectivo_inicial') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('efectivo_inicial')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- FACTURA AGUA --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Factura Agua (Bs.)

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-agua">

                                <i class="bi bi-droplet-fill"></i>

                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="factura_agua"
                                value="{{ old('factura_agua', $apertura_expensa->factura_agua) }}"
                                class="form-control @error('factura_agua') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('factura_agua')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================
                     EXPENSAS
                ================================== --}}

                <div class="section-title mb-3 mt-2">

                    <i class="bi bi-cash-coin text-success"></i>

                    <span>Montos de expensas</span>

                </div>


                <div class="row g-2">


                    {{-- DEPARTAMENTOS --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Expensa Departamentos (Bs.)

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-departamento">

                                <i class="bi bi-house-door-fill"></i>

                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="expensa_departamentos"
                                value="{{ old('expensa_departamentos', $apertura_expensa->expensa_departamentos) }}"
                                class="form-control @error('expensa_departamentos') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('expensa_departamentos')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- TIENDAS --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Expensa Tiendas (Bs.)

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-tienda">

                                <i class="bi bi-shop"></i>

                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="expensa_tiendas"
                                value="{{ old('expensa_tiendas', $apertura_expensa->expensa_tiendas) }}"
                                class="form-control @error('expensa_tiendas') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('expensa_tiendas')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- PARQUEOS --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Expensa Parqueos (Bs.)

                            <span class="campo-obligatorio">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-parqueo">

                                <i class="bi bi-car-front-fill"></i>

                            </span>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="expensa_parqueo"
                                value="{{ old('expensa_parqueo', $apertura_expensa->expensa_parqueo) }}"
                                class="form-control @error('expensa_parqueo') is-invalid @enderror"
                                placeholder="0.00"
                                required
                            >

                        </div>

                        @error('expensa_parqueo')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================
                     AGUA
                ================================== --}}

                <div class="section-title mb-3 mt-2">

                    <i class="bi bi-droplet-fill text-info"></i>

                    <span>Información de agua</span>

                </div>


                <div class="row g-2">


                    {{-- PRORRATEO --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">

                            Prorrateo Agua

                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-agua">

                                <i class="bi bi-calculator-fill"></i>

                            </span>

                            <input
                                type="number"
                                step="0.0001"
                                name="prorrateo_agua"
                                value="{{ old('prorrateo_agua', $apertura_expensa->prorrateo_agua) }}"
                                class="form-control bg-light @error('prorrateo_agua') is-invalid @enderror"
                                readonly
                            >

                        </div>

                        <small class="text-muted">

                            <i class="bi bi-info-circle"></i>

                            Se calcula automáticamente desde Lecturas de Agua.

                        </small>

                        @error('prorrateo_agua')

                            <div class="mensaje-error">

                                <i class="bi bi-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>


                {{-- NOTA --}}
                <div class="nota-obligatorios mt-2 mb-2">

                    <i class="bi bi-info-circle-fill"></i>

                    Los campos marcados con

                    <strong>*</strong>

                    son obligatorios.

                </div>


                <hr class="my-2">


                {{-- BOTONES --}}
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('apertura-expensas.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Cancelar

                    </a>


                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-check-circle-fill"></i>

                        Actualizar

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

</x-app-layout>
