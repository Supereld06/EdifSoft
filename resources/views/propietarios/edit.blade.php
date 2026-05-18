<x-app-layout>

    <x-slot name="header">
            <h3>Editar Propietario</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <h4 class="mb-4">
                Editar Propietario
            </h4>

            <form method="POST" action="{{ route('propietarios.update', $propietario->id) }}">

                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nombres del Propietario
                        </label>
                        <input type="text" name="nombres" value="{{ $propietario->nombres }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Apellido Paterno
                        </label>

                        <input type="text" name="apellido_paterno" value="{{ $propietario->apellido_paterno }}"
                            class="form-control" required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Apellido Materno
                        </label>

                        <input type="text" name="apellido_materno" value="{{ $propietario->apellido_materno }}"
                            class="form-control" required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Número de Carnet
                        </label>

                        <input type="text" name="carnet" value="{{ $propietario->carnet }}" class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Dirección
                        </label>

                        <input type="text" name="direccion" value="{{ $propietario->direccion }}" class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Correo
                        </label>

                        <input type="email" name="correo" value="{{ $propietario->correo }}" class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Celular
                        </label>

                        <input type="text" name="celular" value="{{ $propietario->celular }}" class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Edificio
                        </label>

                        <select name="edificio_id" class="form-control" required>

                            @foreach($edificios as $edificio)

                                <option value="{{ $edificio->id }}" {{ $propietario->edificio_id == $edificio->id ? 'selected' : '' }}>

                                    {{ $edificio->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <button class="btn btn-success">
                    Actualizar
                </button>

                <a href="{{ route('propietarios.index') }}" class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</x-app-layout>