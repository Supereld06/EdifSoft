
<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-calendar-plus-fill text-primary"></i>
                Registrar Apertura de Expensas
            </h3>
            <small class="text-muted">
                Registra los datos iniciales de la apertura de expensas del edificio
            </small>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">

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


        <div class="card border-0 shadow-sm formulario-apertura">

            {{-- CABECERA --}}
            <div class="card-header bg-primary text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-calendar-plus-fill"></i>
                    </div>

                    <div>
                        <h5 class="mb-0 fw-bold">
                            Nueva Apertura
                        </h5>

                        <small class="opacity-75">
                            Complete la información solicitada
                        </small>
                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                <form method="POST"
                      action="{{ route('apertura-expensas.store') }}">

                    @csrf


                    {{-- INFORMACIÓN GENERAL --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-calendar-event-fill text-primary"></i>

                        <span>
                            Información general
                        </span>

                    </div>


                    <div class="row">

                        {{-- MES --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Mes
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-fecha">
                                    <i class="bi bi-calendar-month-fill"></i>
                                </span>

                                <input type="text"
                                       name="mes"
                                       value="{{ old('mes') }}"
                                       class="form-control @error('mes') is-invalid @enderror"
                                       placeholder="Ej. Enero"
                                       required>

                            </div>

                            @error('mes')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- GESTIÓN --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Gestión
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-gestion">
                                    <i class="bi bi-calendar3"></i>
                                </span>

                                <input type="number"
                                       name="gestion"
                                       value="{{ old('gestion') }}"
                                       class="form-control @error('gestion') is-invalid @enderror"
                                       placeholder="Ej. 2026"
                                       required>

                            </div>

                            @error('gestion')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- EDIFICIO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Edificio
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-edificio">
                                    <i class="bi bi-buildings-fill"></i>
                                </span>

                                <input type="text"
                                       class="form-control"
                                       value="{{ session('edificio_nombre') }}"
                                       readonly>

                            </div>

                            <input type="hidden"
                                   name="edificio_id"
                                   value="{{ session('edificio_id') }}">

                            @error('edificio_id')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- DATOS INICIALES --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-cash-stack text-success"></i>

                        <span>
                            Datos iniciales
                        </span>

                    </div>


                    <div class="row">

                        {{-- SALDO INICIAL --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Saldo Inicial (Bs.)
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-dinero">
                                    <i class="bi bi-wallet2"></i>
                                </span>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="saldo_inicial"
                                       value="{{ old('saldo_inicial', '0.00') }}"
                                       class="form-control @error('saldo_inicial') is-invalid @enderror"
                                       placeholder="0.00"
                                       required>

                            </div>

                            @error('saldo_inicial')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- EFECTIVO INICIAL --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Efectivo Inicial (Bs.)
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-dinero">
                                    <i class="bi bi-cash-coin"></i>
                                </span>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="efectivo_inicial"
                                       value="{{ old('efectivo_inicial', '0.00') }}"
                                       class="form-control @error('efectivo_inicial') is-invalid @enderror"
                                       placeholder="0.00"
                                       required>

                            </div>

                            @error('efectivo_inicial')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- FACTURA AGUA --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Factura de Agua (Bs.)
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-agua">
                                    <i class="bi bi-droplet-fill"></i>
                                </span>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="factura_agua"
                                       value="{{ old('factura_agua', '0.00') }}"
                                       class="form-control @error('factura_agua') is-invalid @enderror"
                                       placeholder="0.00"
                                       required>

                            </div>

                            @error('factura_agua')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- MONTOS DE EXPENSAS --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-house-check-fill text-warning"></i>

                        <span>
                            Montos de expensas
                        </span>

                    </div>


                    <div class="row">

                        {{-- DEPARTAMENTOS --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Expensa Departamentos
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-departamento">
                                    <i class="bi bi-building-fill"></i>
                                </span>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="expensa_departamentos"
                                       value="{{ old('expensa_departamentos', '0.00') }}"
                                       class="form-control @error('expensa_departamentos') is-invalid @enderror"
                                       placeholder="0.00"
                                       required>

                            </div>

                            @error('expensa_departamentos')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- TIENDAS --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Expensa Tiendas
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-tienda">
                                    <i class="bi bi-shop"></i>
                                </span>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="expensa_tiendas"
                                       value="{{ old('expensa_tiendas', '0.00') }}"
                                       class="form-control @error('expensa_tiendas') is-invalid @enderror"
                                       placeholder="0.00"
                                       required>

                            </div>

                            @error('expensa_tiendas')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- PARQUEOS --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Expensa Parqueos
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-parqueo">
                                    <i class="bi bi-car-front-fill"></i>
                                </span>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="expensa_parqueo"
                                       value="{{ old('expensa_parqueo', '0.00') }}"
                                       class="form-control @error('expensa_parqueo') is-invalid @enderror"
                                       placeholder="0.00"
                                       required>

                            </div>

                            @error('expensa_parqueo')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- INFORMACIÓN DE AGUA --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-droplet-half text-info"></i>

                        <span>
                            Información de agua
                        </span>

                    </div>


                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Prorrateo de Agua
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-agua">
                                    <i class="bi bi-calculator-fill"></i>
                                </span>

                                <input type="number"
                                       step="0.0001"
                                       name="prorrateo_agua"
                                       value="{{ old('prorrateo_agua', '0.00') }}"
                                       class="form-control bg-light @error('prorrateo_agua') is-invalid @enderror"
                                       readonly>

                            </div>

                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i>
                                Se calculará automáticamente cuando se registren
                                todas las lecturas.
                            </small>

                            @error('prorrateo_agua')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="nota-obligatorios mt-2 mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                        Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>


                    <hr class="my-4">


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
                            Guardar Apertura

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


</x-app-layout>
