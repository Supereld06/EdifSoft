<x-app-layout>

    <x-slot name="header">
        <h3>Recibos Expensas Tiendas</h3>
    </x-slot>

    <div class="container py-4">

        <div class="mb-3">

            <a href="{{ route('recibos_tiendas.create') }}" class="btn btn-success">
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

                    <thead class="">

                        <tr>

                            <th>N°</th>
                            <th>Fecha</th>
                            <th>Propietario</th>
                            <th>Tienda</th>
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

                                    {{ $recibo->propietario->apellidos }}

                                </td>

                                <td>

                                    {{ $recibo->tienda->numero_tienda }}

                                </td>

                                <td>

                                    Bs {{ number_format($recibo->monto, 2) }}

                                </td>

                                <td>

                                    {{ $recibo->mes }}

                                </td>

                                <td>

                                    {{ $recibo->gestion }}

                                </td>

                                <td>

                                    {{ $recibo->tipo_pago }}

                                </td>

                                <td width="180">

                                    <a href="{{ route('recibos_tiendas.edit', $recibo->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <a href="{{ route('recibos_tiendas.pdf', $recibo->id) }}" target="_blank"
                                        class="btn btn-danger btn-sm">

                                        <i class="bi bi-file-earmark-pdf"></i>

                                    </a>

                                    <form action="{{ route('recibos_tiendas.destroy', $recibo->id) }}" method="POST"
                                        style="display:inline">

                                        @csrf

                                        @method('DELETE')

                                        <button class="btn btn-secondary btn-sm"
                                            onclick="return confirm('¿Eliminar recibo?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">

                                    No existen recibos registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>