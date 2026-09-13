<x-app-layout>

<x-slot name="header">
    <div>
        <h3 class="mb-1 fw-bold">
            <i class="bi bi-pencil-square text-info"></i>
            Editar Edificio
        </h3>
        <small class="text-muted">
            Modifica los datos del edificio
        </small>
    </div>
</x-slot>

<div class="container-fluid py-2 px-4">

    <div class="card border-0 shadow-sm formulario-propietario">

        {{-- CABECERA --}}
        <div class="card-header bg-info text-white border-0">
            <div class="d-flex align-items-center">

                <div class="icon-header me-3">
                    <i class="bi bi-building-fill"></i>
                </div>

                <div>
                    <h5 class="mb-0 fw-bold">
                        Editar Edificio
                    </h5>

                    <small class="opacity-75">
                        Actualiza la información del edificio
                    </small>
                </div>

            </div>
        </div>

        {{-- CUERPO --}}
        <div class="card-body p-3">

            <form method="POST"
                  action="{{ route('edificios.update', $edificio->id) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- ===============================
                     INFORMACIÓN DEL EDIFICIO
                ================================ --}}

                <div class="section-title mb-3">
                    <i class="bi bi-building-fill text-primary"></i>
                    <span>Información del edificio</span>
                </div>

                <div class="row g-2">

                    {{-- NOMBRE --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">
                            Nombre del edificio
                            <span class="campo-obligatorio">*</span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-nombre">
                                <i class="bi bi-building"></i>
                            </span>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre', $edificio->nombre) }}"
                                class="form-control"
                                placeholder="Nombre del edificio"
                                required
                            >

                        </div>

                    </div>


                    {{-- DIRECCIÓN --}}
                    <div class="col-md-4 mb-2">

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
                                value="{{ old('direccion', $edificio->direccion) }}"
                                class="form-control"
                                placeholder="Dirección del edificio"
                                required
                            >

                        </div>

                    </div>


                    {{-- DEPARTAMENTOS --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">
                            Nº Departamentos
                            <span class="campo-obligatorio">*</span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-edificio">
                                <i class="bi bi-houses-fill"></i>
                            </span>

                            <input
                                type="number"
                                name="numero_departamentos"
                                value="{{ old('numero_departamentos', $edificio->numero_departamentos) }}"
                                class="form-control"
                                placeholder="Cantidad"
                                min="0"
                                required
                            >

                        </div>

                    </div>

                </div>


                {{-- ===============================
                     UBICACIÓN
                ================================ --}}

                <div class="section-title mb-3 mt-2">
                    <i class="bi bi-geo-alt-fill text-danger"></i>
                    <span>Ubicación</span>
                </div>

                <div class="row g-2">

                    {{-- PAÍS --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">
                            País
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-direccion">
                                <i class="bi bi-globe2"></i>
                            </span>

                            <input
                                type="text"
                                name="pais"
                                value="{{ old('pais', $edificio->pais) }}"
                                class="form-control"
                                placeholder="País"
                            >

                        </div>

                    </div>


                    {{-- CIUDAD --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">
                            Ciudad
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-direccion">
                                <i class="bi bi-buildings"></i>
                            </span>

                            <input
                                type="text"
                                name="ciudad"
                                value="{{ old('ciudad', $edificio->ciudad) }}"
                                class="form-control"
                                placeholder="Ciudad"
                            >

                        </div>

                    </div>


                    {{-- ZONA --}}
                    <div class="col-md-4 mb-2">

                        <label class="form-label">
                            Zona
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-direccion">
                                <i class="bi bi-geo-fill"></i>
                            </span>

                            <input
                                type="text"
                                name="zona"
                                value="{{ old('zona', $edificio->zona) }}"
                                class="form-control"
                                placeholder="Zona"
                            >

                        </div>

                    </div>

                </div>


                {{-- ===============================
                     IMÁGENES
                ================================ --}}

                <div class="section-title mb-3 mt-2">
                    <i class="bi bi-images text-success"></i>
                    <span>Imágenes del edificio</span>
                </div>

                <div class="row g-2">

                    {{-- IMAGEN DEL EDIFICIO --}}
                    <div class="col-md-6 mb-2">

                        <label class="form-label">
                            Imagen del edificio
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-imagen">
                                <i class="bi bi-image-fill"></i>
                            </span>

                            <input
                                type="file"
                                name="imagen_edificio"
                                class="form-control"
                                accept="image/*"
                            >

                        </div>

                        <small class="text-muted">
                            Selecciona una nueva imagen solo si deseas reemplazar la actual.
                        </small>

                    </div>


                    {{-- LOGO --}}
                    <div class="col-md-6 mb-2">

                        <label class="form-label">
                            Logo del edificio
                        </label>

                        <div class="input-group">

                            <span class="input-group-text icono-imagen">
                                <i class="bi bi-image"></i>
                            </span>

                            <input
                                type="file"
                                name="logo_edificio"
                                class="form-control"
                                accept="image/*"
                            >

                        </div>

                        <small class="text-muted">
                            Selecciona un nuevo logo solo si deseas reemplazar el actual.
                        </small>

                    </div>

                </div>


                {{-- ===============================
                     IMÁGENES ACTUALES
                ================================ --}}

                <div class="row g-2 mt-1">

                    {{-- IMAGEN ACTUAL --}}
                    <div class="col-md-6 mb-2 text-center">

                        @if($edificio->imagen_edificio)

                            <div class="preview-imagen">

                                <label class="form-label fw-semibold d-block">
                                    <i class="bi bi-image-fill me-1"></i>
                                    Imagen actual
                                </label>

                                <img
                                    src="{{ asset('storage/' . $edificio->imagen_edificio) }}"
                                    class="img-thumbnail"
                                    style="max-height:180px; max-width:100%; object-fit:contain;"
                                >

                            </div>

                        @endif

                    </div>


                    {{-- LOGO ACTUAL --}}
                    <div class="col-md-6 mb-2 text-center">

                        @if($edificio->logo_edificio)

                            <div class="preview-imagen">

                                <label class="form-label fw-semibold d-block">
                                    <i class="bi bi-image me-1"></i>
                                    Logo actual
                                </label>

                                <img
                                    src="{{ asset('storage/' . $edificio->logo_edificio) }}"
                                    class="img-thumbnail"
                                    style="max-height:180px; max-width:100%; object-fit:contain;"
                                >

                            </div>

                        @endif

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

                    <a href="{{ route('edificios.index') }}"
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
