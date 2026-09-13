<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-pencil-square text-info"></i>
                Editar Propietario
            </h3>
            <small class="text-muted">
                Modifica los datos del propietario
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
                        <strong>Revisa los datos del formulario</strong>

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
            <div class="card-header bg-info text-white border-0">
                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>
                        <h5 class="mb-0 fw-bold">
                            Editar Propietario
                        </h5>

                        <small class="opacity-75">
                            Actualiza la información solicitada
                        </small>
                    </div>

                </div>
            </div>


            {{-- CUERPO --}}
            <div class="card-body p-3">

                <form method="POST"
                      action="{{ route('propietarios.update', $propietario->id) }}">

                    @csrf
                    @method('PUT')


                    {{-- ===============================
                         DATOS PERSONALES
                    ================================ --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-person-vcard-fill text-primary"></i>

                        <span>Datos personales</span>

                    </div>


                    <div class="row g-2">

                        {{-- NOMBRES --}}
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Nombres
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="nombres"
                                    value="{{ old('nombres', $propietario->nombres) }}"
                                    class="form-control @error('nombres') is-invalid @enderror"
                                    placeholder="Ingrese los nombres"
                                    required
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
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Apellido Paterno
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="apellido_paterno"
                                    value="{{ old('apellido_paterno', $propietario->apellido_paterno) }}"
                                    class="form-control @error('apellido_paterno') is-invalid @enderror"
                                    placeholder="Apellido paterno"
                                    required
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
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Apellido Materno
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="apellido_materno"
                                    value="{{ old('apellido_materno', $propietario->apellido_materno) }}"
                                    class="form-control @error('apellido_materno') is-invalid @enderror"
                                    placeholder="Apellido materno"
                                    required
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


                    {{-- ===============================
                         DATOS DE CONTACTO
                    ================================ --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-person-lines-fill text-success"></i>

                        <span>Datos de contacto</span>

                    </div>


                    <div class="row g-2">

                        {{-- CARNET --}}
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Nº de Carnet
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-carnet">
                                    <i class="bi bi-card-text"></i>
                                </span>

                                <input
                                    type="text"
                                    name="carnet"
                                    value="{{ old('carnet', $propietario->carnet) }}"
                                    class="form-control @error('carnet') is-invalid @enderror"
                                    placeholder="Número de carnet"
                                    required
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
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Celular
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="celular"
                                    value="{{ old('celular', $propietario->celular) }}"
                                    class="form-control @error('celular') is-invalid @enderror"
                                    placeholder="Número de celular"
                                    required
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
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Correo Electrónico
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-correo">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>

                                <input
                                    type="email"
                                    name="correo"
                                    value="{{ old('correo', $propietario->correo) }}"
                                    class="form-control @error('correo') is-invalid @enderror"
                                    placeholder="correo@ejemplo.com"
                                    required
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


                    {{-- ===============================
                         INFORMACIÓN DE RESIDENCIA
                    ================================ --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-geo-alt-fill text-danger"></i>

                        <span>Información de residencia</span>

                    </div>


                    <div class="row g-2">

                        {{-- DIRECCIÓN --}}
                        <div class="col-md-8 mb-2">

                            <label class="form-label">
                                Dirección
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>

                                <input
                                    type="text"
                                    name="direccion"
                                    value="{{ old('direccion', $propietario->direccion) }}"
                                    class="form-control @error('direccion') is-invalid @enderror"
                                    placeholder="Ingrese la dirección"
                                    required
                                >

                            </div>

                            @error('direccion')
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

                                <select
                                    name="edificio_id"
                                    class="form-select @error('edificio_id') is-invalid @enderror"
                                    required
                                >

                                    @foreach($edificios as $edificio)

                                        <option
                                            value="{{ $edificio->id }}"
                                            {{ old('edificio_id', $propietario->edificio_id) == $edificio->id ? 'selected' : '' }}
                                        >
                                            {{ $edificio->nombre }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            @error('edificio_id')
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

                        <a href="{{ route('propietarios.index') }}"
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

