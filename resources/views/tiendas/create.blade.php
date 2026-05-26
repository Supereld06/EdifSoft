<x-app-layout>

    <x-slot name="header">
        <h3>Registrar Tienda</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('tiendas.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Tipo de Tienda</label>
                    <input type="text" name="tipo_tienda" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Número de Tienda</label>
                    <input type="text" name="numero_tienda" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Detalles</label>
                    <textarea name="detalles_tienda" class="form-control"></textarea>
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

                <input type="hidden" name="edificio_id" value="{{ $edificio_id }}">

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <button class="btn btn-secondary" type="button" onclick="window.history.back()">
                    Cancelar
                </button>

            </form>

        </div>

    </div>

</x-app-layout>