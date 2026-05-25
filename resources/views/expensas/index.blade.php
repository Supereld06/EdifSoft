<x-app-layout>

    <x-slot name="header">
        <h3>

    Expensas -
    {{ $expensas->first()?->apertura?->mes }}
    {{ $expensas->first()?->apertura?->gestion }}

</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">

            <a href="{{ route('expensas.create') }}" class="btn btn-success">
                + Nueva Expensa
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

                        <th>Departamento</th>

                        <th>Propietario</th>

                        <th>Total</th>

                        <th>Pagado</th>

                        <th>Saldo</th>

                        <th>Estado</th>

                        <th>Mes</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($expensas as $expensa)

                        <tr>

                            <td>
                                {{ $expensa->departamento->numero_departamento }}
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

                                <a href="#" class="btn btn-success btn-sm">

                                    Pago Expensa

                                </a>

                                <a href="{{ route('expensas.edit', $expensa) }}" class="btn btn-warning btn-sm">

                                    Editar

                                </a>

                                <form action="{{ route('expensas.destroy', $expensa) }}" method="POST"
                                    style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        Eliminar

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