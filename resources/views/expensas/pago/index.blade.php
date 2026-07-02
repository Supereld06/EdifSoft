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
                                <td> </td>
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