<x-app-layout>

    <x-slot name="header">
        <h3>Pago Expensas</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-3">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th>Edificio</th>

                        <th>Mes</th>

                        <th>Gestión</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($aperturas as $apertura)

                        <tr>

                            <td>
                                {{ $apertura->edificio->nombre }}
                            </td>

                            <td>
                                {{ $apertura->mes }}
                            </td>

                            <td>
                                {{ $apertura->gestion }}
                            </td>

                            <td>

                                <a href="{{ route('pago-expensas.expensas', $apertura) }}" class="btn btn-success btn-sm">

                                    Expensas

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="mt-3">

                {{ $aperturas->links() }}

            </div>

        </div>

    </div>

</x-app-layout>