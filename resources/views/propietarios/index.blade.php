<x-app-layout>

<x-slot name="header">
    <h3>Lista de Propietarios</h3>
</x-slot>

<div class="container">

    <div class="mb-3">
        <a href="{{ route('propietarios.create') }}" class="btn btn-success">
            + Registrar Propietario
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
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Edificio</th>
                    <th>Acciones</th>
                    <th>Deuda</th>
                </tr>
            </thead>

            <tbody>

                @foreach($propietarios as $prop)
                @if($prop->edificio_id == session('edificio_id'))
                <tr>
                    <td>{{ $prop->nombres }}</td>
                    <td>{{ $prop->apellido_paterno }}</td>
                    <td>{{ $prop->apellido_materno }}</td>
                    <td>{{ $prop->celular }}</td>
                    <td>{{ $prop->correo }}</td>
                    <td>{{ $prop->edificio->nombre ?? '-' }}</td>
                    <td>
                        <a href="#" 
                            class="btn btn-warning btn-sm"
                            title="Editar Propietario">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td>0 Bs</td>
                </tr>
                @endif
                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>







