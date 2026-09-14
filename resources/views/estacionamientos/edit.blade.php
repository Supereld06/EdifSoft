<x-app-layout>

    <x-slot name="header">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-pencil-square text-info"></i>
                Editar Estacionamiento
            </h3>
            <small class="text-muted">
                Modifica los datos del estacionamiento
            </small>
        </div>
    </x-slot>

    <div class="container-fluid py-2 px-4">

        {{-- MENSAJES DE ERROR GENERALES --}}
        @if($errors->any())
            <div class="alert alert-danger shadow-sm border-0 mb-3">
                <div class="fw-bold mb-1">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    No se pudo actualizar el estacionamiento
                </div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm formulario-estacionamiento">

            {{-- ENCABEZADO --}}
            <div class="card-header bg-info text-white border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Editar Estacionamiento
                        </h5>

                        <small class="opacity-75">
                            Actualiza la información solicitada
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-3">

                <form action="{{ route('estacionamientos.update', $estacionamiento->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- DATOS DEL ESTACIONAMIENTO --}}
                    <div class="section-title mb-3">
                        <i class="bi bi-car-front-fill text-primary"></i>
                        <span>Datos del estacionamiento</span>
                    </div>

                    <div class="row g-2">

                        {{-- TIPO --}}
                        <div class="col-md-4 mb-2">
                            <label class="form-label">
                                Tipo de estacionamiento
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-car-front"></i>
                                </span>

                                <input type="text" name="tipo_estacionamiento"
                                    class="form-control @error('tipo_estacionamiento') is-invalid @enderror"
                                    value="{{ old('tipo_estacionamiento', $estacionamiento->tipo_estacionamiento) }}"
                                    placeholder="Ej. Privado" required>
                            </div>

                            @error('tipo_estacionamiento')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NUMERO --}}
                        <div class="col-md-4 mb-2">
                            <label class="form-label">
                                Número de estacionamiento
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-hash"></i>
                                </span>

                                <input type="text" name="numero_estacionamiento"
                                    class="form-control @error('numero_estacionamiento') is-invalid @enderror"
                                    value="{{ old('numero_estacionamiento', $estacionamiento->numero_estacionamiento) }}"
                                    placeholder="Ej. E-01" required>
                            </div>

                            @error('numero_estacionamiento')
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
                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>

                                <input type="text" name="ubicacion"
                                    class="form-control @error('ubicacion') is-invalid @enderror"
                                    value="{{ old('ubicacion', $estacionamiento->ubicacion) }}"
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

                    {{-- PROPIETARIO Y EDIFICIO --}}
                    <div class="section-title mb-3 mt-2">
                        <i class="bi bi-person-vcard-fill text-primary"></i>
                        <span>Propietario y edificio</span>
                    </div>

                    <div class="row g-2">

                        <div class="col-md-6 mb-2">
                            <label class="form-label">
                                Propietario
                                <span class="campo-obligatorio">*</span>
                            </label>

                            <select name="propietario_id" id="propietario_id"
                                class="form-select @error('propietario_id') is-invalid @enderror" required>

                                <option value=""></option>

                                @foreach($propietarios as $propietario)
                                    <option value="{{ $propietario->id }}" {{ old('propietario_id', $estacionamiento->propietario_id) == $propietario->id ? 'selected' : '' }}>

                                        {{ $propietario->nombres }}
                                        {{ $propietario->apellido_paterno }}
                                        {{ $propietario->apellido_materno }}

                                    </option>
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
                                <span class="input-group-text">
                                    <i class="bi bi-buildings-fill"></i>
                                </span>

                                <input type="text" class="form-control" value="{{ session('edificio_nombre') }}"
                                    readonly>
                            </div>

                            <input type="hidden" name="edificio_id" value="{{ $estacionamiento->edificio_id }}"
                                required>

                            @error('edificio_id')
                                <div class="mensaje-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    {{-- INFORMACIÓN ADICIONAL --}}
                    <div class="section-title mb-3 mt-2">
                        <i class="bi bi-card-text text-primary"></i>
                        <span>Información adicional</span>
                    </div>

                    <div class="row g-2">

                        {{-- DETALLE --}}
                        <div class="col-md-12 mb-2">
                            <label class="form-label">
                                Detalle
                            </label>

                            <textarea name="detalle" rows="2"
                                class="form-control @error('detalle') is-invalid @enderror"
                                placeholder="Información adicional del estacionamiento...">{{ old('detalle', $estacionamiento->detalle) }}</textarea>

                            @error('detalle')
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
                        Los campos marcados con <strong>*</strong> son obligatorios.
                    </div>

                    <hr class="my-2">

                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('estacionamientos.index') }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>
                            Actualizar
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    @push('scripts')
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