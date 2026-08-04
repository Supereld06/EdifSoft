<x-app-layout>

    <x-slot name="header">
        <h3>🚗 Registrar Estacionamiento</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="bi bi-p-square"></i>
                    Nuevo Estacionamiento
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('estacionamientos.store') }}" method="POST">

                    @csrf

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Tipo de Estacionamiento
                            </label>

                            <input type="text" name="tipo_estacionamiento" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Número de Estacionamiento
                            </label>

                            <input type="text" name="numero_estacionamiento" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Ubicación
                            </label>

                            <input type="text" name="ubicacion" class="form-control">

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Propietario
                            </label>

                            <select name="propietario_id" class="form-select" required>

                                <option value="">
                                    Seleccione un propietario...
                                </option>

                                @foreach($propietarios as $propietario)

                                    <option value="{{ $propietario->id }}">

                                        {{ $propietario->nombres }}
                                        {{ $propietario->apellido_paterno }}
                                        {{ $propietario->apellido_materno }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Edificio
                            </label>

                            <input type="text" class="form-control" value="{{ session('edificio_nombre') }}" readonly>

                            <input type="hidden" name="edificio_id" value="{{ session('edificio_id') }}">

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">
                                Detalle
                            </label>

                            <textarea name="detalle" rows="4" class="form-control"></textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('estacionamientos.index') }}" class="btn btn-secondary me-2">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Guardar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>