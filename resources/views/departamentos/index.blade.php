<x-app-layout>

    <x-slot name="header">
        <h3>Listado de Departamentos</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">
            <a href="{{ route('departamentos.create') }}" class="btn btn-success">
                + Registrar Departamento
            </a>
            <a href="" class="btn btn-success">
                📊 Exportar Excel
            </a>

            <a href="{{ route('departamentos.pdf') }}" class="btn btn-danger" target="_blank">
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
                        <th>Tipo</th>
                        <th>Número</th>
                        <th>Piso</th>
                        <th>Propietario</th>
                        <th>Edificio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($departamentos as $dep)
                        @if($dep->edificio_id == session('edificio_id'))
                            <tr>
                                <td>{{ $dep->tipo_departamento }}</td>
                                <td>{{ $dep->numero_departamento }}</td>
                                <td>{{ $dep->piso }}</td>
                                <td>
                                    {{ $dep->propietario ? $dep->propietario->nombres . ' ' . $dep->propietario->apellido_paterno : '-'}}
                                    /
                                    {{ $dep->co_propietario}}
                                </td>
                                <td>{{ $dep->edificio->nombre ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('departamentos.edit', $dep->id) }}" class="btn btn-warning btn-sm"
                                        title="Editar edificio">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>

            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $departamentos->links() }}
            </div>
        </div>

    </div>

</x-app-layout>