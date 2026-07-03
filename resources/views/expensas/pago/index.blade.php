<x-app-layout>

    <x-slot name="header">
        <h3>Pago Expensas</h3>
    </x-slot>

    <div class="container">
        <div class="card shadow p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Gestión</th>
                        <th>Saldo a Cobrar</th>
                        <th>Departamentos</th>
                        <th>Tiendas</th>
                        <th>Estacionamientos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aperturas as $apertura)
                        @if($apertura->edificio_id == session('edificio_id'))
                            <tr>
                                <td>
                                    {{ $apertura->mes }}
                                </td>
                                <td>
                                    {{ $apertura->gestion }}
                                </td>
                                <td>

                                    @if($apertura->saldo_cobrar > 0)

                                        <span class="badge bg-danger fs-6">

                                            Bs. {{ number_format($apertura->saldo_cobrar, 2) }}

                                        </span>

                                    @else

                                        <span class="badge bg-success fs-6">

                                            Bs. 0.00

                                        </span>

                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('pago-expensas.expensas', $apertura) }}" class="btn btn-info  "
                                        title="Expensas Departamentos">
                                        <i class="bi bi-cash-coin"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('pago-expensas.tiendas', $apertura) }}" class="btn btn-warning"
                                        title="Expensas Tiendas">
                                        <i class="bi bi-cash-coin"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('pago-expensas.estacionamientos', $apertura) }}" class="btn btn-dark"
                                        title="Expensas Estacionamientos">
                                        <i class="bi bi-cash-coin"></i>
                                    </a>
                                </td>

                            </tr>

                        @endif
                    @endforeach

                </tbody>

            </table>

            <div class="mt-3">

                {{ $aperturas->links() }}

            </div>

        </div>

    </div>

</x-app-layout>