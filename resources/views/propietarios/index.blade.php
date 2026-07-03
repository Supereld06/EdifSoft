<x-app-layout>

    <x-slot name="header">
        <h3>Lista de Propietarios</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">
            <a href="{{ route('propietarios.create') }}" class="btn btn-success">
                + Registrar Propietario
            </a>

            <!--  <a href="" class="btn btn-success">
                📊 Exportar Excel
            </a>-->

            <a href="{{ route('propietarios.pdf') }}" class="btn btn-danger" target="_blank">
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

                    @forelse($propietarios as $prop)
                    @if($prop->edificio_id == session('edificio_id'))
                    <tr>
                        <td>{{ $prop->nombres }}</td>
                        <td>{{ $prop->apellido_paterno }}</td>
                        <td>{{ $prop->apellido_materno }}</td>
                        <td>{{ $prop->celular }}</td>
                        <td>{{ $prop->correo }}</td>
                        <td>{{ $prop->edificio->nombre ?? '-' }}</td>
                        <td>
                            <a href="{{ route('propietarios.edit', $prop->id) }}" class="btn btn-warning btn-sm"
                                title="Editar Propietario">
                                <i class="bi bi-pencil-square"></i>
                        </td>
                        <td> @if($prop->deuda_total > 0)
                            <span class="badge bg-danger">
                                {{ number_format($prop->deuda_total, 2) }} Bs
                            </span>
                            @else
                            <span class="badge bg-success">
                                {{ number_format($prop->deuda_total, 2) }} Bs
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @empty

                    <tr>

                        <td colspan="8" class="text-center">
                            No existen propietarios registrados
                        </td>

                    </tr>

                    @endforelse


                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>