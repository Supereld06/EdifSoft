<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-pencil-square text-infor"></i>
                Editar Tienda
            </h3>

            <small class="text-muted">
                Modifica los datos de la tienda
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


        {{-- FORMULARIO --}}
        <div class="card border-0 shadow-sm formulario-tienda">

            {{-- CABECERA --}}
            <div class="card-header bg-info text-white border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Editar Tienda
                        </h5>

                        <small class="opacity-75">
                            Actualiza la información solicitada
                        </small>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-3">

                <form action="{{ route('tiendas.update', $tienda->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')


                    {{-- ===============================
                         DATOS DE LA TIENDA
                    ================================ --}}

                    <div class="section-title mb-3">

                        <i class="bi bi-shop text-primary"></i>

                        <span>Datos de la tienda</span>

                    </div>


                    <div class="row g-2">

                        {{-- TIPO DE TIENDA --}}
                        <div class="col-md-4 mb-2">

                            <label class="form-label">

                                Tipo de Tienda

                                <span class="campo-obligatorio">*</span>

                            </label>


                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-shop"></i>
                                </span>


                                <input
                                    type="text"
                                    name="tipo_tienda"
                                    value="{{ old('tipo_tienda', $tienda->tipo_tienda) }}"
                                    class="form-control @error('tipo_tienda') is-invalid @enderror"
                                    placeholder="Ej. Comercial"
                                    required>

                            </div>


                            @error('tipo_tienda')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- NUMERO DE TIENDA --}}
                        <div class="col-md-4 mb-2">

                            <label class="form-label">

                                Número de Tienda

                                <span class="campo-obligatorio">*</span>

                            </label>


                            <div class="input-group">

                                <span class="input-group-text icono-carnet">
                                    <i class="bi bi-hash"></i>
                                </span>


                                <input
                                    type="text"
                                    name="numero_tienda"
                                    value="{{ old('numero_tienda', $tienda->numero_tienda) }}"
                                    class="form-control @error('numero_tienda') is-invalid @enderror"
                                    placeholder="Número de tienda"
                                    required>

                            </div>


                            @error('numero_tienda')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- UBICACION --}}
                        <div class="col-md-4 mb-2">

                            <label class="form-label">
                                Ubicación
                            </label>


                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>


                                <input
                                    type="text"
                                    name="ubicacion"
                                    value="{{ old('ubicacion', $tienda->ubicacion) }}"
                                    class="form-control @error('ubicacion') is-invalid @enderror"
                                    placeholder="Ej. Planta baja">

                            </div>


                            @error('ubicacion')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ===============================
                         PROPIETARIO Y EDIFICIO
                    ================================ --}}

                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-person-lines-fill text-success"></i>

                        <span>Propietario y edificio</span>

                    </div>


                    <div class="row g-2">

                        {{-- PROPIETARIO --}}
                        <div class="col-md-6 mb-2">

                            <label class="form-label">

                                Propietario

                                <span class="campo-obligatorio">*</span>

                            </label>


                            <select
                                name="propietario_id"
                                id="propietario_id"
                                class="form-select @error('propietario_id') is-invalid @enderror"
                                required>

                                <option value=""></option>


                                @foreach($propietarios as $propietario)

                                    {{-- SOLO PROPIETARIOS DEL EDIFICIO DE LA TIENDA --}}
                                    @if($propietario->edificio_id == $tienda->edificio_id)

                                        <option
                                            value="{{ $propietario->id }}"
                                            {{ old('propietario_id', $tienda->propietario_id) == $propietario->id ? 'selected' : '' }}>

                                            {{ $propietario->nombres }}
                                            {{ $propietario->apellido_paterno }}
                                            {{ $propietario->apellido_materno }}

                                        </option>

                                    @endif

                                @endforeach

                            </select>


                            @error('propietario_id')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- EDIFICIO --}}
                        <div class="col-md-6 mb-2">

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
                                    class="form-control"
                                    value="{{ session('edificio_nombre') }}"
                                    readonly>

                            </div>


                            <input
                                type="hidden"
                                name="edificio_id"
                                value="{{ $tienda->edificio_id }}"
                                required>


                            @error('edificio_id')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ===============================
                         INFORMACION ADICIONAL
                    ================================ --}}

                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-card-text text-danger"></i>

                        <span>Información adicional</span>

                    </div>


                    <div class="row g-2">

                        <div class="col-md-12 mb-2">

                            <label class="form-label">
                                Detalles
                            </label>


                            <textarea
                                name="detalles_tienda"
                                rows="3"
                                class="form-control @error('detalles_tienda') is-invalid @enderror"
                                placeholder="Ingrese detalles de la tienda (opcional)">{{ old('detalles_tienda', $tienda->detalles_tienda) }}</textarea>


                            @error('detalles_tienda')

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

                        <a
                            href="{{ route('tiendas.index') }}"
                            class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>


                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>

                            Actualizar

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    {{-- ===============================
         ESTILOS Y SELECT2
    ================================ --}}

    @push('scripts')

        <style>

            /* ===============================
               FORMULARIO
            ================================ */

            .formulario-tienda {

                border-radius: 10px;

                background: rgba(255, 255, 255, 0.85);

                backdrop-filter: blur(8px);

                -webkit-backdrop-filter: blur(8px);

            }


            /* ===============================
               CABECERA
            ================================ */

            .icon-header {

                width: 42px;
                height: 42px;

                display: flex;
                align-items: center;
                justify-content: center;

                background: rgba(255, 255, 255, 0.15);

                border-radius: 8px;

                font-size: 20px;

            }


            /* ===============================
               TITULOS DE SECCION
            ================================ */

            .section-title {

                display: flex;

                align-items: center;

                gap: 8px;

                font-size: 16px;

                font-weight: 700;

                border-bottom: 1px solid #e9ecef;

                padding-bottom: 8px;

            }


            .section-title i {

                font-size: 18px;

            }


            /* ===============================
               LABELS
            ================================ */

            .form-label {

                font-weight: 600;

            }


            /* ===============================
               CAMPOS OBLIGATORIOS
            ================================ */

            .campo-obligatorio {

                color: #dc3545;

                font-weight: bold;

            }


            /* ===============================
               ICONOS
            ================================ */

            .input-group-text {

                min-width: 42px;

                justify-content: center;

            }


            .icono-nombre,
            .icono-carnet,
            .icono-direccion,
            .icono-edificio {

                background-color: #f8f9fa;

            }


            /* ===============================
               MENSAJES DE ERROR
            ================================ */

            .mensaje-error {

                color: #dc3545;

                font-size: 12px;

                margin-top: 4px;

                display: flex;

                align-items: center;

                gap: 4px;

            }


            /* ===============================
               NOTA
            ================================ */

            .nota-obligatorios {

                background-color: #f8f9fa;

                border-radius: 6px;

                padding: 8px 12px;

                font-size: 13px;

                color: #6c757d;

            }


            .nota-obligatorios i {

                color: #0d6efd;

                margin-right: 5px;

            }


            /* ===============================
               SELECT2
            ================================ */

            .select2-container {

                width: 100% !important;

            }


            .select2-container--default
            .select2-selection--single {

                height: 38px;

                border: 1px solid #ced4da;

                border-radius: 5px;

                padding: 5px 10px;

                background-color: #fff;

            }


            .select2-container--default
            .select2-selection--single
            .select2-selection__rendered {

                line-height: 26px;

                color: #212529;

            }


            .select2-container--default
            .select2-selection--single
            .select2-selection__arrow {

                height: 36px;

            }


            .select2-container--default.select2-container--focus
            .select2-selection--single {

                border-color: #86b7fe;

                outline: 0;

                box-shadow:
                    0 0 0 0.25rem
                    rgba(13, 110, 253, 0.25);

            }

        </style>


        <script>

            $(document).ready(function () {

                $('#propietario_id').select2({

                    placeholder: 'Seleccione propietario...',

                    allowClear: true,

                    width: '100%',

                    language: {

                        noResults: function () {
                            return "No se encontró ningún propietario";
                        },

                        searching: function () {
                            return "Buscando...";
                        },

                        inputTooShort: function () {
                            return "Escriba para buscar";
                        }

                    }

                });

            });

        </script>

    @endpush


</x-app-layout>