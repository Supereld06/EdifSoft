<x-app-layout>

    <x-slot name="header">
        <h3>Recibos de Expensas</h3>
    </x-slot>

    <div class="container">

        <a href="{{ route('recibos_expensas.create') }}" class="btn btn-success mb-3">

            + Nuevo Recibo

        </a>

        <div class="card shadow p-3">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th>Número</th>
                        <th>Fecha</th>
                        <th>Propietario</th>
                        <th>Monto</th>
                        <th>Mes</th>
                        <th>Gestión</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($recibos as $recibo)

                        @if($recibo->edificio_id == session('edificio_id'))

                            <tr>

                                <td>{{ $recibo->numero }}</td>

                                <td>{{ $recibo->fecha }}</td>

                                <td>
                                    {{ $recibo->propietario->nombres }}
                                </td>

                                <td>{{ $recibo->monto }}</td>

                                <td>{{ $recibo->mes }}</td>

                                <td>{{ $recibo->gestion }}</td>

                            </tr>

                        @endif

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>