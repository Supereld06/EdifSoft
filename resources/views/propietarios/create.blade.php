<x-app-layout>

    <x-slot name="header">

        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-person-plus-fill text-primary"></i>
                Registrar Propietario
            </h3>

            <small class="text-muted">
                Registra los datos del propietario del edificio
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
                        <i class="bi bi-person-plus-fill"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Nuevo Propietario
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
                      action="{{ route('propietarios.store') }}">

                    @csrf


                    {{-- DATOS PERSONALES --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-person-vcard-fill text-primary"></i>

                        <span>
                            Datos personales
                        </span>

                    </div>


                    <div class="row">

                        {{-- NOMBRES --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Nombres
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input type="text"
                                       name="nombres"
                                       value="{{ old('nombres') }}"
                                       class="form-control @error('nombres') is-invalid @enderror"
                                       placeholder="Ingrese los nombres"
                                       >

                            </div>

                            @error('nombres')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- APELLIDO PATERNO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Apellido Paterno
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input type="text"
                                       name="apellido_paterno"
                                       value="{{ old('apellido_paterno') }}"
                                       class="form-control @error('apellido_paterno') is-invalid @enderror"
                                       placeholder="Apellido paterno"
                                       >

                            </div>

                            @error('apellido_paterno')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- APELLIDO MATERNO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Apellido Materno
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input type="text"
                                       name="apellido_materno"
                                       value="{{ old('apellido_materno') }}"
                                       class="form-control @error('apellido_materno') is-invalid @enderror"
                                       placeholder="Apellido materno"
                                       >

                            </div>

                            @error('apellido_materno')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- DATOS DE CONTACTO --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-person-lines-fill text-success"></i>

                        <span>
                            Datos de contacto
                        </span>

                    </div>


                    <div class="row">

                        {{-- CARNET --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Nº de Carnet
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-carnet">
                                    <i class="bi bi-card-text"></i>
                                </span>

                                <input type="text"
                                       name="carnet"
                                       value="{{ old('carnet') }}"
                                       class="form-control @error('carnet') is-invalid @enderror"
                                       placeholder="Número de carnet"
                                       >

                            </div>

                            @error('carnet')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- CELULAR --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Celular
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>

                                <input type="text"
                                       name="celular"
                                       value="{{ old('celular') }}"
                                       class="form-control @error('celular') is-invalid @enderror"
                                       placeholder="Número de celular"
                                       >

                            </div>

                            @error('celular')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- CORREO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Correo Electrónico
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-correo">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>

                                <input type="email"
                                       name="correo"
                                       value="{{ old('correo') }}"
                                       class="form-control @error('correo') is-invalid @enderror"
                                       placeholder="correo@ejemplo.com"
                                    >

                            </div>

                            @error('correo')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- INFORMACIÓN DE RESIDENCIA --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-geo-alt-fill text-danger"></i>

                        <span>
                            Información de residencia
                        </span>

                    </div>


                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Dirección
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>

                                <input type="text"
                                       name="direccion"
                                       value="{{ old('direccion') }}"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       placeholder="Ingrese la dirección"
                                    >

                            </div>

                            @error('direccion')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- EDIFICIO --}}
                    <input type="hidden"
                           name="edificio_id"
                           value="{{ $edificio_id }}">


                    <div class="nota-obligatorios mt-2 mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                        Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>


                    <hr class="my-4">


                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('propietarios.index') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>


                        <button type="submit"
                                class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>
                            Guardar Propietario

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>

