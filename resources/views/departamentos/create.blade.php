<x-app-layout>
    <x-slot name="header">
        <h3>Registrar Departamento</h3>
    </x-slot>

    <div class="container">
        <div class="card shadow p-4">
            <h4 class="mb-4">Nuevo Departamento</h4>

            <form method="POST" action="{{ route('departamentos.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tipo de Departamento</label>
                    <select name="tipo_departamento" id="tipo_departamento" class="form-control" required>
                        <option value="">Selecciona un tipo</option>
                        <option value="Mono Ambiente">Mono Ambiente</option>
                        <option value="2 Dormitorios">2 Dormitorios</option>
                        <option value="3 Dormitorios">3 Dormitorios</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Número de Departamento</label>
                    <input type="text" name="numero_departamento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Piso</label>
                    <input type="number" name="piso" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Propietario</label>
                    <select name="propietario_id" class="form-control" required>
                    <option value="">Selecciona un propietario</option>
                    @foreach($propietarios as $prop)
                        <option value="{{ $prop->id }}">{{ $prop->nombres }} {{ $prop->apellido_paterno }} {{ $prop->apellido_materno }}</option>
                    @endforeach
                    </select>
                </div>

                <input type="hidden" name="edificio_id" value="{{ $edificio_id }}">

                <button type="submit" class="btn btn-success">Guardar Departamento</button>
            </form>
        </div>
    </div>
</x-app-layout>