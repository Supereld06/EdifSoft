<x-app-layout>

    <x-slot name="header">
        <h3>🏠 Editar Departamento</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">

                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Editar Departamento
                </h5>

            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('departamentos.update', $departamento->id) }}">

                    @csrf
                    @method('PUT')

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Tipo de Departamento
                            </label>

                            <select
                                name="tipo_departamento"
                                class="form-select"
                                required>

                                <option value="Mono Ambiente"
                                    {{ $departamento->tipo_departamento == 'Mono Ambiente' ? 'selected' : '' }}>
                                    Mono Ambiente
                                </option>

                                <option value="2 Dormitorios"
                                    {{ $departamento->tipo_departamento == '2 Dormitorios' ? 'selected' : '' }}>
                                    2 Dormitorios
                                </option>

                                <option value="3 Dormitorios"
                                    {{ $departamento->tipo_departamento == '3 Dormitorios' ? 'selected' : '' }}>
                                    3 Dormitorios
                                </option>

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Número de Departamento
                            </label>

                            <input
                                type="text"
                                name="numero_departamento"
                                value="{{ old('numero_departamento', $departamento->numero_departamento) }}"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Piso
                            </label>

                            <input
                                type="number"
                                name="piso"
                                value="{{ old('piso', $departamento->piso) }}"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Propietario
                            </label>

                            <select
                                name="propietario_id"
                                class="form-select"
                                required>

                                @foreach($propietarios as $prop)

                                    <option
                                        value="{{ $prop->id }}"
                                        {{ old('propietario_id', $departamento->propietario_id) == $prop->id ? 'selected' : '' }}>

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

                            <input
                                type="text"
                                name="co_propietario"
                                value="{{ old('co_propietario', $departamento->co_propietario) }}"
                                class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Edificio
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ session('edificio_nombre') }}"
                                readonly>

                            <input
                                type="hidden"
                                name="edificio_id"
                                value="{{ $departamento->edificio_id }}">

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">
                                Observaciones
                            </label>

                            <textarea
                                name="observaciones"
                                rows="4"
                                class="form-control">{{ old('observaciones', $departamento->observaciones) }}</textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a
                            href="{{ route('departamentos.index') }}"
                            class="btn btn-secondary me-2">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Actualizar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>