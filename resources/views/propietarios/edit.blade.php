<x-app-layout>

    <x-slot name="header">
        <h3>👤 Editar Propietario</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">

                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Editar Propietario
                </h5>

            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('propietarios.update', $propietario->id) }}">

                    @csrf
                    @method('PUT')

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Nombres
                            </label>

                            <input
                                type="text"
                                name="nombres"
                                value="{{ old('nombres', $propietario->nombres) }}"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Apellido Paterno
                            </label>

                            <input
                                type="text"
                                name="apellido_paterno"
                                value="{{ old('apellido_paterno', $propietario->apellido_paterno) }}"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Apellido Materno
                            </label>

                            <input
                                type="text"
                                name="apellido_materno"
                                value="{{ old('apellido_materno', $propietario->apellido_materno) }}"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Nº de Carnet
                            </label>

                            <input
                                type="text"
                                name="carnet"
                                value="{{ old('carnet', $propietario->carnet) }}"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Celular
                            </label>

                            <input
                                type="text"
                                name="celular"
                                value="{{ old('celular', $propietario->celular) }}"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Correo Electrónico
                            </label>

                            <input
                                type="email"
                                name="correo"
                                value="{{ old('correo', $propietario->correo) }}"
                                class="form-control @error('correo') is-invalid @enderror"
                                required>

                            @error('correo')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-8 mb-3">

                            <label class="form-label fw-bold">
                                Dirección
                            </label>

                            <input
                                type="text"
                                name="direccion"
                                value="{{ old('direccion', $propietario->direccion) }}"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Edificio
                            </label>

                            <select
                                name="edificio_id"
                                class="form-select"
                                required>

                                @foreach($edificios as $edificio)

                                    <option
                                        value="{{ $edificio->id }}"
                                        {{ old('edificio_id', $propietario->edificio_id) == $edificio->id ? 'selected' : '' }}>

                                        {{ $edificio->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a
                            href="{{ route('propietarios.index') }}"
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