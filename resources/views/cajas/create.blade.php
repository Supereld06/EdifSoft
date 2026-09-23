<x-app-layout>

    <x-slot name="header">

        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-cash-stack text-primary"></i>
                Registrar Caja
            </h3>

            <small class="text-muted">
                Crea una nueva caja para el edificio actual
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


        <div class="card border-0 shadow-sm formulario-propietario">

            {{-- CABECERA --}}
            <div class="card-header bg-primary text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Nueva Caja
                        </h5>

                        <small class="opacity-75">
                            Complete la información solicitada
                        </small>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                <form method="POST" action="{{ route('cajas.store') }}">

                    @csrf


                    {{-- INFORMACIÓN DE LA CAJA --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-wallet2 text-primary"></i>

                        <span>
                            Información de la caja
                        </span>

                    </div>


                    <div class="row">

                        {{-- NOMBRE --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Nombre de la caja
                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-wallet-fill"></i>
                                </span>

                                <input type="text" name="nombre" value="{{ old('nombre') }}"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    placeholder="Ej. Caja Principal">

                            </div>

                            @error('nombre')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- SALDO INICIAL --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Saldo inicial
                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>

                                <input type="number" name="saldo" value="{{ old('saldo', 0) }}"
                                    class="form-control @error('saldo') is-invalid @enderror" step="0.01" min="0"
                                    placeholder="0.00">

                            </div>

                            @error('saldo')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- DESCRIPCIÓN --}}
                        <div class="col-12 mb-3">

                            <label class="form-label">

                                Descripción

                                <span class="text-muted small">
                                    (opcional)
                                </span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion align-items-start pt-3">
                                    <i class="bi bi-card-text"></i>
                                </span>

                                <textarea name="descripcion"
                                    class="form-control @error('descripcion') is-invalid @enderror" rows="4"
                                    placeholder="Ingrese una descripción o detalle de la caja">{{ old('descripcion') }}</textarea>

                            </div>

                            @error('descripcion')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- NOTA --}}
                    <div class="nota-obligatorios mt-2 mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                        Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>


                    <hr class="my-4">


                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('cajas.index') }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>


                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>
                            Guardar Caja

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
