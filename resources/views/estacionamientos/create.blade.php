<x-app-layout>

    <x-slot name="header">
        <h3>Registrar Estacionamiento</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('estacionamientos.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Tipo de Estacionamiento</label>
                    <input type="text"
                        name="tipo_estacionamiento"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Número de Estacionamiento</label>
                    <input type="text"
                        name="numero_estacionamiento"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Ubicación</label>
                    <input type="text"
                        name="ubicacion"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Detalle</label>
                    <textarea name="detalle"
                        class="form-control"></textarea>
                </div>

                <div class="mb-3">

                    <label>Propietario</label>

                    <select name="propietario_id" class="form-control">

                        @foreach($propietarios as $propietario)

                        <option value="{{ $propietario->id }}">
                            {{ $propietario->nombres }}
                            {{ $propietario->apellido_paterno }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <button type="button"
                    class="btn btn-secondary"
                    onclick="window.history.back()">

                    Cancelar

                </button>

            </form>

        </div>

    </div>

</x-app-layout>