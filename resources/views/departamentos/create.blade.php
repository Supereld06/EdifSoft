<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-house-door-fill text-primary"></i>
                Registrar Departamento
            </h3>

            <small class="text-muted">
                Registra los datos de un nuevo departamento en el sistema.
            </small>
        </div>
    </x-slot>


    <div class="container-fluid py-4 px-4">

        <div class="card border-0 shadow-sm formulario-departamento">

            {{-- CABECERA --}}
            <div class="card-header bg-primary text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-house-door-fill"></i>
                    </div>

                    <div>
                        <h5 class="mb-0 fw-bold">
                            Nuevo Departamento
                        </h5>

                        <small class="opacity-75">
                            Complete la información solicitada
                        </small>
                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                <form method="POST" action="{{ route('departamentos.store') }}">

                    @csrf


                    {{-- DATOS DEL DEPARTAMENTO --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-building-fill text-primary"></i>

                        <span>
                            Datos del departamento
                        </span>

                    </div>


                    <div class="row">

                        {{-- TIPO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Tipo de Departamento

                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-house-fill"></i>
                                </span>

                                <select name="tipo_departamento" id="tipo_departamento" class="form-select" required>

                                    <option value="">
                                        Seleccione...
                                    </option>

                                    <option value="Mono Ambiente" {{ old('tipo_departamento') == 'Mono Ambiente' ? 'selected' : '' }}>
                                        Mono Ambiente
                                    </option>

                                    <option value="2 Dormitorios" {{ old('tipo_departamento') == '2 Dormitorios' ? 'selected' : '' }}>
                                        2 Dormitorios
                                    </option>

                                    <option value="3 Dormitorios" {{ old('tipo_departamento') == '3 Dormitorios' ? 'selected' : '' }}>
                                        3 Dormitorios
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- NUMERO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Número de Departamento

                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-hash"></i>
                                </span>

                                <input type="text" name="numero_departamento" value="{{ old('numero_departamento') }}"
                                    class="form-control" placeholder="Número de departamento" required>

                            </div>

                        </div>


                        {{-- PISO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Piso

                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-layers-fill"></i>
                                </span>

                                <input type="number" name="piso" value="{{ old('piso') }}" class="form-control"
                                    placeholder="Número de piso" required>

                            </div>

                        </div>

                    </div>


                    {{-- PROPIETARIO --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-person-lines-fill text-success"></i>

                        <span>
                            Propietario y edificio
                        </span>

                    </div>


                    <div class="row">

                        {{-- PROPIETARIO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Propietario

                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">


                                <select name="propietario_id" id="propietario_id" class="form-select" required>

                                    <option value=""></option>

                                    @foreach($propietarios as $prop)

                                        <option value="{{ $prop->id }}" {{ old('propietario_id') == $prop->id ? 'selected' : '' }}>

                                            {{ $prop->nombres }}
                                            {{ $prop->apellido_paterno }}
                                            {{ $prop->apellido_materno }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- CO-PROPIETARIO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Co-Propietario

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-people-fill"></i>
                                </span>

                                <input type="text" name="co_propietario" value="{{ old('co_propietario') }}"
                                    class="form-control" placeholder="Nombre del co-propietario">

                            </div>

                        </div>


                        {{-- EDIFICIO --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Edificio

                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion">
                                    <i class="bi bi-buildings-fill"></i>
                                </span>

                                <input type="text" class="form-control" value="{{ session('edificio_nombre') }}"
                                    readonly>

                            </div>

                            <input type="hidden" name="edificio_id" value="{{ $edificio_id }}" required>

                        </div>

                    </div>


                    {{-- OBSERVACIONES --}}
                    <div class="section-title mb-3 mt-2">

                        <i class="bi bi-chat-left-text-fill text-danger"></i>

                        <span>
                            Información adicional
                        </span>

                    </div>


                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Observaciones
                            </label>

                            <div class="input-group">

                                <textarea name="observaciones" rows="3" class="form-control"
                                    placeholder="Ingrese alguna observación (opcional)">{{ old('observaciones') }}</textarea>

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

                        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>


                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>

                            Guardar Departamento

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ESTILOS Y SELECT2 --}}
    @push('scripts')

        <style>
            .formulario-departamento {
                border-radius: 8px;
            }

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

            .form-label {
                font-weight: 600;
            }

            .campo-obligatorio {
                color: #dc3545;
                font-weight: bold;
            }

            .input-group-text {
                min-width: 42px;
                justify-content: center;
            }

            .icono-nombre {
                background-color: #f8f9fa;
            }

            .icono-carnet {
                background-color: #f8f9fa;
            }

            .icono-direccion {
                background-color: #f8f9fa;
            }

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


            /* SELECT2 */

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

                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);

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