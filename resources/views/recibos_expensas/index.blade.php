<x-app-layout>

    <x-slot name="header">
        <h3>Recibos de Expensas</h3>
    </x-slot>

    <div class="container">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

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
                        <th width="250">Acciones</th>

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

                                    {{ $recibo->propietario->apellido_paterno }}

                                </td>

                                <td>

                                    Bs.
                                    {{ number_format($recibo->monto, 2) }}

                                </td>

                                <td>{{ $recibo->mes }}</td>

                                <td>{{ $recibo->gestion }}</td>

                                <td>

                                    <a href="{{ route('recibos_expensas.edit', $recibo->id) }}" class="btn btn-warning btn-sm">

                                        Editar

                                    </a>

                                    <form action="{{ route('recibos_expensas.destroy', $recibo->id) }}" method="POST"
                                        style="display:inline-block">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar recibo?')">

                                            Eliminar

                                        </button>

                                    </form>

                                    <a href="{{ route('recibos_expensas.pdf', $recibo->id) }}" target="_blank"
                                        class="btn btn-primary btn-sm">

                                        PDF

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