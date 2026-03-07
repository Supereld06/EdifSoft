<x-app-layout>

<x-slot name="header">
    <h3>Lista de Edificios</h3>
</x-slot>

<div class="container">

    <div class="mb-3">
        <a href="{{ route('edificios.create') }}" class="btn btn-success">
            + Registrar Edificio
        </a>
        <a href="" class="btn btn-success">
            📊 Exportar Excel
        </a>

        <a href="" class="btn btn-danger">
            📄 Exportar PDF
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
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Departamentos</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($edificios as $edificio)

                <tr>
                    <td>{{ $edificio->id }}</td>
                    <td>{{ $edificio->nombre }}</td>
                    <td>{{ $edificio->direccion }}</td>
                    <td>{{ $edificio->numero_departamentos }}</td>
                    <td>
                    <a href="{{ route('edificios.edit', $edificio->id) }}" 
                        class="btn btn-warning btn-sm"
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