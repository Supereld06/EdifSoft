<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-p-square-fill text-primary"></i>
                Registrar Estacionamiento
            </h3>
            <small class="text-muted">
                Registra los datos de un nuevo estacionamiento en el sistema.
            </small>
        </div>
    </x-slot>

    <div class="container-fluid py-4 px-4">

        <div class="card border-0 shadow-sm formulario-estacionamiento">

            {{-- ENCABEZADO --}}
            <div class="card-header bg-primary text-white py-3 border-0">
                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-p-square-fill"></i>
                    </div>

                    <div>
                        <h5 class="mb-0 fw-bold">
                            Nuevo Estacionamiento
                        </h5>

                        <small class="opacity-75">
                            Complete la información solicitada
                        </small>
                    </div>

                </div>
            </div>

            {{-- CUERPO --}}
            <div class="card-body p-4">

                <form action="{{ route('estacionamientos.store') }}" method="POST">
                    @csrf

                    {{-- ========================= --}}
                    {{-- DATOS DEL ESTACIONAMIENTO --}}
                    {{-- ========================= --}}

                    <div class="section-title mb-3">
                        <i class="bi bi-p-square-fill text-primary"></i>
                        <span>Datos del estacionamiento</span>
                    </div>

                    <div class="row">

                        {{-- TIPO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Tipo de Estacionamiento
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-car-front-fill"></i>
                                </span>

                                <input type="text" name="tipo_estacionamiento" value="{{ old('tipo_estacionamiento') }}"
                                    class="form-control" placeholder="Ej. Privado" required>

                            </div>

                        </div>

                        {{-- NUMERO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Número de Estacionamiento
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-carnet">
                                    <i class="bi bi-hash"></i>
                                </span>

                                <input type="text" name="numero_estacionamiento"
                                    value="{{ old('numero_estacionamiento') }}" class="form-control"
                                    placeholder="Ej. E-01" required>

                            </div>

                        </div>

                        {{-- UBICACION --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Ubicación
                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>

                                <input type="text" name="ubicacion" value="{{ old('ubicacion') }}" class="form-control"
                                    placeholder="Ej. Sótano 1">

                            </div>

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- PROPIETARIO Y EDIFICIO --}}
                    {{-- ========================= --}}

                    <div class="section-title mb-3 mt-3">
                        <i class="bi bi-person-lines-fill text-success"></i>
                        <span>Propietario y edificio</span>
                    </div>

                    <div class="row">

                        {{-- PROPIETARIO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Propietario
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <select name="propietario_id" id="propietario_id" class="form-select" required>

                                <option value=""></option>

                                @foreach($propietarios as $propietario)

                                    @if($propietario->edificio_id == session('edificio_id'))

                                        <option value="{{ $propietario->id }}" {{ old('propietario_id') == $propietario->id ? 'selected' : '' }}>

                                            {{ $propietario->nombres }}
                                            {{ $propietario->apellido_paterno }}
                                            {{ $propietario->apellido_materno }}

                                        </option>

                                    @endif

                                @endforeach

                            </select>

                        </div>


                        {{-- EDIFICIO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Edificio
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <input type="text" class="form-control" value="{{ session('edificio_nombre') }}" readonly>

                            <input type="hidden" name="edificio_id" value="{{ session('edificio_id') }}" required>

                        </div>

                    </div>

                    {{-- ========================= --}}
                    {{-- INFORMACION ADICIONAL --}}
                    {{-- ========================= --}}

                    <div class="section-title mb-3 mt-3">
                        <i class="bi bi-card-text text-danger"></i>
                        <span>Información adicional</span>
                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Detalle
                            </label>

                            <textarea name="detalle" rows="3" class="form-control"
                                placeholder="Ingrese detalles del estacionamiento (opcional)">{{ old('detalle') }}</textarea>

                        </div>

                    </div>


                    {{-- NOTA --}}
                    <div class="nota-obligatorios mt-2 mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                        Los campos marcados con <strong>*</strong>
                        son obligatorios.

                    </div>


                    <hr class="my-4">


                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('estacionamientos.index') }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>
                            Guardar Estacionamiento

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- ESTILOS Y SELECT2 --}}
    {{-- ========================= --}}

    @push('scripts')

        <style>
            /* TARJETA PRINCIPAL */

            .formulario-estacionamiento {
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }


            /* ICONO DEL ENCABEZADO */

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


            /* TITULOS DE SECCION */

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


            /* LABELS */

            .form-label {
                font-weight: 600;
            }


            /* CAMPOS OBLIGATORIOS */

            .campo-obligatorio {
                color: #dc3545;
                font-weight: bold;
            }


            /* ICONOS DE INPUT */

            .input-group-text {
                min-width: 42px;
                justify-content: center;
            }

            .icono-nombre,
            .icono-carnet,
            .icono-direccion {
                background-color: #f8f9fa;
            }


            /* NOTA */

            .nota-obligatorios {
                background-color: #f8f9fa;

                border-radius: 6px;

                padding: 10px 12px;

                font-size: 13px;

                color: #6c757d;
            }

            .nota-obligatorios i {
                color: #0d6efd;
                margin-right: 5px;
            }


            /* ========================= */
            /* SELECT2 */
            /* ========================= */

            .select2-container {
                width: 100% !important;
            }

            .select2-container--default .select2-selection--single {

                height: 38px;

                border: 1px solid #ced4da;

                border-radius: 5px;

                padding: 5px 10px;

                background-color: #fff;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {

                line-height: 26px;

                color: #212529;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {

                height: 36px;
            }

            .select2-container--default.select2-container--focus .select2-selection--single {

                border-color: #86b7fe;

                outline: 0;

                box-shadow:
                    0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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