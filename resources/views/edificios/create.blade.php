<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-buildings-fill text-primary"></i>
                Registrar Edificio
            </h3>

            <small class="text-muted">
                Registra los datos del edificio que deseas administrar
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
                        <i class="bi bi-buildings-fill"></i>
                    </div>

                    <div>
                        <h5 class="mb-0 fw-bold">
                            Nuevo Edificio
                        </h5>

                        <small class="opacity-75">
                            Complete la información solicitada
                        </small>
                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                <form method="POST" action="{{ route('edificios.store') }}" enctype="multipart/form-data">

                    @csrf


                    {{-- ==========================================
                    INFORMACIÓN GENERAL
                    =========================================== --}}

                    <div class="section-title mb-3">

                        <i class="bi bi-building-fill text-primary"></i>

                        <span>
                            Información general
                        </span>

                    </div>


                    <div class="row">

                        {{-- NOMBRE --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nombre del edificio
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-buildings-fill"></i>
                                </span>

                                <input type="text" name="nombre" value="{{ old('nombre') }}"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    placeholder="Ej. Edificio Central">

                            </div>

                            @error('nombre')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- NÚMERO DE DEPARTAMENTOS --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Número de departamentos
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-carnet">
                                    <i class="bi bi-houses-fill"></i>
                                </span>

                                <input type="number" name="numero_departamentos"
                                    value="{{ old('numero_departamentos') }}" min="0"
                                    class="form-control @error('numero_departamentos') is-invalid @enderror"
                                    placeholder="Ej. 20">

                            </div>

                            @error('numero_departamentos')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- ==========================================
                    UBICACIÓN
                    =========================================== --}}

                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-geo-alt-fill text-danger"></i>

                        <span>
                            Ubicación del edificio
                        </span>

                    </div>


                    <div class="row">

                        {{-- DIRECCIÓN --}}
                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Dirección
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>

                                <input type="text" name="direccion" value="{{ old('direccion') }}"
                                    class="form-control @error('direccion') is-invalid @enderror"
                                    placeholder="Ej. Av. Principal #123">

                            </div>

                            @error('direccion')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- PAÍS --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                País
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-globe-americas"></i>
                                </span>

                                <input type="text" name="pais" value="{{ old('pais') }}"
                                    class="form-control @error('pais') is-invalid @enderror" placeholder="Ej. Bolivia">

                            </div>

                            @error('pais')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- CIUDAD --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Ciudad
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-buildings"></i>
                                </span>

                                <input type="text" name="ciudad" value="{{ old('ciudad') }}"
                                    class="form-control @error('ciudad') is-invalid @enderror"
                                    placeholder="Ej. Cochabamba">

                            </div>

                            @error('ciudad')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- ZONA --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Zona
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-map-fill"></i>
                                </span>

                                <input type="text" name="zona" value="{{ old('zona') }}"
                                    class="form-control @error('zona') is-invalid @enderror"
                                    placeholder="Ej. Zona Norte">

                            </div>

                            @error('zona')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- ==========================================
                    IMÁGENES DEL EDIFICIO
                    =========================================== --}}

                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-images text-success"></i>

                        <span>
                            Imágenes del edificio
                        </span>

                    </div>


                    <div class="row">

                        {{-- IMAGEN DEL EDIFICIO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Imagen del edificio
                            </label>

                            <div class="archivo-edificio">

                                <div class="archivo-icono">
                                    <i class="bi bi-image-fill"></i>
                                </div>

                                <div class="archivo-info">

                                    <strong>
                                        Imagen principal
                                    </strong>

                                    <small>
                                        JPG, JPEG o PNG. Máximo 2 MB.
                                    </small>

                                </div>

                                <label class="btn btn-outline-primary btn-sm mb-0">

                                    <i class="bi bi-upload"></i>
                                    Seleccionar

                                    <input type="file" name="imagen_edificio" id="imagen_edificio"
                                        class="d-none @error('imagen_edificio') is-invalid @enderror"
                                        accept=".jpg,.jpeg,.png">

                                </label>

                            </div>

                            <div id="nombreImagenEdificio" class="archivo-seleccionado">
                            </div>

                            @error('imagen_edificio')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="preview-edificio mt-2" id="previewImagenContainer" style="display:none;">

                                <img id="previewImagenEdificio" src="" alt="Vista previa">

                            </div>

                        </div>


                        {{-- LOGO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Logo del edificio
                            </label>

                            <div class="archivo-edificio">

                                <div class="archivo-icono logo">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>

                                <div class="archivo-info">

                                    <strong>
                                        Logo del edificio
                                    </strong>

                                    <small>
                                        JPG, JPEG o PNG. Máximo 2 MB.
                                    </small>

                                </div>

                                <label class="btn btn-outline-success btn-sm mb-0">

                                    <i class="bi bi-upload"></i>
                                    Seleccionar

                                    <input type="file" name="logo_edificio" id="logo_edificio"
                                        class="d-none @error('logo_edificio') is-invalid @enderror"
                                        accept=".jpg,.jpeg,.png">

                                </label>

                            </div>

                            <div id="nombreLogoEdificio" class="archivo-seleccionado">
                            </div>

                            @error('logo_edificio')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="preview-logo mt-2" id="previewLogoContainer" style="display:none;">

                                <img id="previewLogoEdificio" src="" alt="Vista previa del logo">

                            </div>

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

                        <a href="{{ route('edificios.index') }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>


                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>
                            Guardar Edificio

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- JAVASCRIPT PARA VISTA PREVIA --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // ==========================================
            // IMAGEN DEL EDIFICIO
            // ==========================================

            const imagenInput =
                document.getElementById('imagen_edificio');

            const nombreImagen =
                document.getElementById('nombreImagenEdificio');

            const previewImagen =
                document.getElementById('previewImagenEdificio');

            const previewImagenContainer =
                document.getElementById('previewImagenContainer');


            if (imagenInput) {

                imagenInput.addEventListener('change', function () {

                    if (this.files && this.files[0]) {

                        const archivo = this.files[0];

                        nombreImagen.innerHTML =
                            '<i class="bi bi-check-circle-fill text-success me-1"></i>' +
                            archivo.name;

                        const reader = new FileReader();

                        reader.onload = function (e) {

                            previewImagen.src = e.target.result;

                            previewImagenContainer.style.display = 'block';

                        };

                        reader.readAsDataURL(archivo);

                    } else {

                        nombreImagen.innerHTML = '';

                        previewImagenContainer.style.display = 'none';

                    }

                });

            }


            // ==========================================
            // LOGO DEL EDIFICIO
            // ==========================================

            const logoInput =
                document.getElementById('logo_edificio');

            const nombreLogo =
                document.getElementById('nombreLogoEdificio');

            const previewLogo =
                document.getElementById('previewLogoEdificio');

            const previewLogoContainer =
                document.getElementById('previewLogoContainer');


            if (logoInput) {

                logoInput.addEventListener('change', function () {

                    if (this.files && this.files[0]) {

                        const archivo = this.files[0];

                        nombreLogo.innerHTML =
                            '<i class="bi bi-check-circle-fill text-success me-1"></i>' +
                            archivo.name;

                        const reader = new FileReader();

                        reader.onload = function (e) {

                            previewLogo.src = e.target.result;

                            previewLogoContainer.style.display = 'block';

                        };

                        reader.readAsDataURL(archivo);

                    } else {

                        nombreLogo.innerHTML = '';

                        previewLogoContainer.style.display = 'none';

                    }

                });

            }

        });

    </script>

</x-app-layout>