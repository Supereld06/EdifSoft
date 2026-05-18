<x-app-layout>

    <x-slot name="header">
        <h3>Editar Departamento</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <h4 class="mb-4">Editar Departamento</h4>

            <form method="POST" action="{{ route('departamentos.update', $departamento->id) }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tipo de Departamento</label>

                    <select name="tipo_departamento" class="form-control" required>

                        <option value="Mono Ambiente" {{ $departamento->tipo_departamento == 'Mono Ambiente' ? 'selected' : '' }}>
                            Mono Ambiente
                        </option>

                        <option value="2 Dormitorios" {{ $departamento->tipo_departamento == '2 Dormitorios' ? 'selected' : '' }}>
                            2 Dormitorios
                        </option>

                        <option value="3 Dormitorios" {{ $departamento->tipo_departamento == '3 Dormitorios' ? 'selected' : '' }}>
                            3 Dormitorios
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Número de Departamento</label>

                    <input type="text" name="numero_departamento" value="{{ $departamento->numero_departamento }}"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Piso</label>

                    <input type="number" name="piso" value="{{ $departamento->piso }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Co-Propietario</label>

                    <input type="text" name="co_propietario" value="{{ $departamento->co_propietario }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>

                    <textarea name="observaciones" class="form-control"
                        rows="4">{{ $departamento->observaciones }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Propietario</label>

                    <select name="propietario_id" class="form-control" required>

                        @foreach($propietarios as $prop)

                            <option value="{{ $prop->id }}" {{ $departamento->propietario_id == $prop->id ? 'selected' : '' }}>

                                {{ $prop->nombres }}
                                {{ $prop->apellido_paterno }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <input type="hidden" name="edificio_id" value="{{ $departamento->edificio_id }}">

                <button class="btn btn-success">
                    Actualizar
                </button>

                <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </form>

        </div>

    </div>

</x-app-layout>