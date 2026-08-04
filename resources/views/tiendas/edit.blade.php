<x-app-layout>

    <x-slot name="header">
        <h3>🏪 Editar Tienda</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">

                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Editar Tienda
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('tiendas.update', $tienda->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Tipo de Tienda
                            </label>

                            <input
                                type="text"
                                name="tipo_tienda"
                                class="form-control"
                                value="{{ old('tipo_tienda', $tienda->tipo_tienda) }}"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Número de Tienda
                            </label>

                            <input
                                type="text"
                                name="numero_tienda"
                                class="form-control"
                                value="{{ old('numero_tienda', $tienda->numero_tienda) }}"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Ubicación
                            </label>

                            <input
                                type="text"
                                name="ubicacion"
                                class="form-control"
                                value="{{ old('ubicacion', $tienda->ubicacion) }}">

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Propietario
                            </label>

                            <select
                                name="propietario_id"
                                class="form-select"
                                required>

                                @foreach($propietarios as $propietario)

                                    @if($propietario->edificio_id == $edificio_id)

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

                        </div>

                        <div class="col-md-6 mb-3">

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
                                value="{{ $tienda->edificio_id }}">

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">
                                Detalles
                            </label>

                            <textarea
                                name="detalles_tienda"
                                rows="4"
                                class="form-control">{{ old('detalles_tienda', $tienda->detalles_tienda) }}</textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a
                            href="{{ route('tiendas.index') }}"
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