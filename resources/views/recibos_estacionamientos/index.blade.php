<x-app-layout>

    <x-slot name="header">
        <h3>Recibos Estacionamientos</h3>
    </x-slot>

    <div class="container py-4">

        <div class="mb-3">
            <a href="{{ route('recibos_estacionamientos.create', 0) }}" class="btn btn-success">
                + Nuevo Recibo
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Fecha</th>
                            <th>Propietario</th>
                            <th>Estacionamiento</th>
                            <th>Monto</th>
                            <th>Mes</th>
                            <th>Gestión</th>
                            <th>Tipo Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recibos as $recibo)

                            <tr>
                                <td>{{ $recibo->numero }}</td>
                                <td>{{ $recibo->fecha }}</td>

                                <td>
                                    {{ $recibo->propietario->nombres }}
                                    {{ $recibo->propietario->apellido_paterno }}
                                </td>

                                <td>
                                    {{ $recibo->estacionamiento->numero_estacionamiento }}
                                </td>

                                <td>Bs {{ number_format($recibo->monto, 2) }}</td>
                                <td>{{ $recibo->mes }}</td>
                                <td>{{ $recibo->gestion }}</td>
                                <td>{{ $recibo->tipo_pago }}</td>

                                <td>

                                    <a href="{{ route('recibos_estacionamientos.edit', $recibo->id) }}"
                                        class="btn btn-warning btn-sm">
                                        ✏
                                    </a>

                                    <a href="{{ route('recibos_estacionamientos.pdf', $recibo->id) }}"
                                        class="btn btn-danger btn-sm" target="_blank">
                                        PDF
                                    </a>

                                    <form action="{{ route('recibos_estacionamientos.destroy', $recibo->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-secondary btn-sm" onclick="return confirm('¿Eliminar?')">
                                            🗑
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No hay recibos</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>