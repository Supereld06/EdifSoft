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
                            {{ $dep->propietario 
                                ? $dep->propietario->nombres . ' ' . $dep->propietario->apellido_paterno  : '-'  
                                }}
                            </td>
                        <td>{{ $dep->edificio->nombre ?? '-' }}</td>
                    <td>
                    <a href="#" 
                        class="btn btn-warning btn-sm"
                        title="Editar edificio">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                </tr>
                @endif
                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>


