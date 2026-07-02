<x-app-layout>

    <x-slot name="header">
        <h3>Expensas Estacionamientos</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">

            <a href="{{ route('expensas_estacionamientos.create') }}" class="btn btn-success">

                Nueva Expensa

            </a>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <div class="card shadow p-3">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th>Estacionamiento</th>

                        <th>Propietario</th>

                        <th>Total</th>

                        <th>Pagado</th>

                        <th>Saldo</th>

                        <th>Estado</th>

                        <th>Mes</th>

                        <th>Gestión</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($expensas as $expensa)

                        <tr>

                            <td>
                                {{ $expensa->estacionamiento->numero_estacionamiento }}
                            </td>

                            <td>
                                {{ $expensa->propietario->nombres }}
                            </td>

                            <td>
                                {{ $expensa->total }}
                            </td>

                            <td>
                                {{ $expensa->pagado }}
                            </td>

                            <td>
                                {{ $expensa->saldo }}
                            </td>

                            <td>

                                @if($expensa->estado == 'PAGADO')

                                    <span class="badge bg-success">
                                        PAGADO
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        PENDIENTE
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $expensa->apertura->mes }}
                            </td>

                            <td>
                                {{ $expensa->apertura->gestion }}
                            </td>

                            <td>

                                <a href="{{ route('expensas_estacionamientos.edit', $expensa->id) }}" class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('expensas_estacionamientos.destroy', $expensa->id) }}" method="POST"
                                    style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar registro?')">

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