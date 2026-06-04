<x-app-layout>

    <x-slot name="header">
        <h3>Listado de Estacionamientos</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">
            <a href="{{ route('estacionamientos.create') }}" class="btn btn-success">
                + Registrar Estacionamiento
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
                        <th>Detalle</th>
                        <th>Propietario</th>
                        <th>Edificio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($estacionamientos as $estacionamiento)

                    <tr>

                        <td>{{ $estacionamiento->tipo_estacionamiento }}</td>

                        <td>{{ $estacionamiento->numero_estacionamiento }}</td>

                        <td>{{ $estacionamiento->ubicacion }}</td>

                        <td>{{ $estacionamiento->detalle }}</td>

                        <td>
                            {{ $estacionamiento->propietario
                                    ? $estacionamiento->propietario->nombres . ' ' .
                                      $estacionamiento->propietario->apellido_paterno
                                    : '-' }}
                        </td>

                        <td>
                            {{ $estacionamiento->edificio->nombre ?? '-' }}
                        </td>

                        <td>

                            <a href="{{ route('estacionamientos.edit', $estacionamiento->id) }}"
                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('estacionamientos.destroy', $estacionamiento->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar estacionamiento?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>