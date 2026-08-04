<x-app-layout>

    <x-slot name="header">
        <h3>🏠 Registrar Departamento</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">

                    <i class="bi bi-house-door"></i>

                    Nuevo Departamento

                </h5>

            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('departamentos.store') }}">

                    @csrf

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Tipo de Departamento
                            </label>

                            <select name="tipo_departamento" id="tipo_departamento" class="form-select" required>

                                <option value="">
                                    Seleccione...
                                </option>

                                <option value="Mono Ambiente">
                                    Mono Ambiente
                                </option>

                                <option value="2 Dormitorios">
                                    2 Dormitorios
                                </option>

                                <option value="3 Dormitorios">
                                    3 Dormitorios
                                </option>

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Número de Departamento
                            </label>

                            <input type="text" name="numero_departamento" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Piso
                            </label>

                            <input type="number" name="piso" class="form-control" required>

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Propietario
                            </label>

                            <select name="propietario_id" class="form-select" required>

                                <option value="">
                                    Seleccione...
                                </option>

                                @foreach($propietarios as $prop)

                                    <option value="{{ $prop->id }}">

                                        {{ $prop->nombres }}
                                        {{ $prop->apellido_paterno }}
                                        {{ $prop->apellido_materno }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Co-Propietario
                            </label>

                            <input type="text" name="co_propietario" class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Edificio
                            </label>

                            <input type="text" class="form-control" value="{{ session('edificio_nombre') }}" readonly>

                            <input type="hidden" name="edificio_id" value="{{ $edificio_id }}">

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">
                                Observaciones
                            </label>

                            <textarea name="observaciones" rows="4" class="form-control"></textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary me-2">

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