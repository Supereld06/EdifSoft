<x-app-layout>

    <x-slot name="header">
        <h3>Lista de Edificios</h3>
    </x-slot>

    <div class="container">
        <div class="mb-3">
            <a href="{{ route('edificios.create') }}" class="btn btn-success">
                + Registrar Edificio
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>País</th>
                        <th>Ciudad</th>
                        <th>Zona</th>
                        <th>Departamentos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($edificios as $edificio)
                        <tr>
                            <td>{{ $edificio->id }}</td>
                            <td>
                                @if($edificio->logo_edificio)
                                    <img src="{{ asset('storage/' . $edificio->logo_edificio) }}" width="70"
                                        class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{ $edificio->nombre }}</td>
                            <td>{{ $edificio->direccion }}</td>
                            <td>{{ $edificio->pais }}</td>
                            <td>{{ $edificio->ciudad }}</td>
                            <td>{{ $edificio->zona }}</td>
                            <td>{{ $edificio->numero_departamentos }}</td>
                            <td>
                                <a href="{{ route('edificios.edit', $edificio->id) }}" class="btn btn-warning btn-sm"
                                    title="Editar edificio">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>