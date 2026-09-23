<x-app-layout>

    <x-slot name="header">

        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-pencil-square text-info"></i>
                Editar Caja
            </h3>

            <small class="text-muted">
                Modifica la información de la caja seleccionada
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
            <div class="card-header bg-info text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Editar Caja
                        </h5>

                        <small class="opacity-75">
                            {{ $caja->nombre }}
                        </small>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                <form action="{{ route('cajas.update', $caja->id) }}" method="POST">

                    @csrf
                    @method('PUT')


                    {{-- INFORMACIÓN DE LA CAJA --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-wallet2 text-info"></i>

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

                                <input type="text" name="nombre" value="{{ old('nombre', $caja->nombre) }}"
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


                        {{-- ESTADO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Estado
                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-edificio">
                                    <i class="bi bi-toggle-on"></i>
                                </span>

                                <select name="estado" class="form-select @error('estado') is-invalid @enderror">

                                    <option value="1" {{ old('estado', $caja->estado) ? 'selected' : '' }}>
                                        Activa
                                    </option>

                                    <option value="0" {{ !old('estado', $caja->estado) ? 'selected' : '' }}>
                                        Inactiva
                                    </option>

                                </select>

                            </div>

                            @error('estado')

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
                                    placeholder="Ingrese una descripción o detalle de la caja">{{ old('descripcion', $caja->descripcion) }}</textarea>

                            </div>

                            @error('descripcion')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- SALDO ACTUAL --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Saldo actual

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>

                                <input type="text" class="form-control" value="Bs {{ number_format($caja->saldo, 2) }}"
                                    disabled>

                            </div>

                            <small class="text-muted mt-1 d-block">

                                <i class="bi bi-info-circle"></i>
                                El saldo se modifica mediante movimientos.

                            </small>

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


                        <button type="submit" class="btn btn-info text-white">

                            <i class="bi bi-check-circle-fill"></i>
                            Actualizar Caja

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>