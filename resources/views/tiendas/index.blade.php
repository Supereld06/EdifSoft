<x-app-layout>

    <x-slot name="header">
        <h3>Listado de Tiendas</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">
            <a href="{{ route('tiendas.create') }}" class="btn btn-success">
                + Registrar Tienda
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
                        <th>Ubicación</th>
                        <th>Detalles</th>
                        <th>Propietario</th>
                        <th>Edificio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tiendas as $tienda)

                        @if($tienda->edificio_id == session('edificio_id'))

                                    <tr>

                                        <td>{{ $tienda->tipo_tienda }}</td>

                                        <td>{{ $tienda->numero_tienda }}</td>

                                        <td>{{ $tienda->ubicacion }}</td>

                                        <td>{{ $tienda->detalles_tienda }}</td>

                                        <td>
                                            {{ $tienda->propietario
                            ? $tienda->propietario->nombres . ' ' .
                            $tienda->propietario->apellido_paterno
                            : '-' }}
                                        </td>

                                        <td>{{ $tienda->edificio->nombre ?? '-' }}</td>

                                        <td>

                                            <a href="{{ route('tiendas.edit', $tienda->id) }}" class="btn btn-warning btn-sm">

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