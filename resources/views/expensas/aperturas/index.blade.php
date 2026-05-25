<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Apertura de Expensas
        </h2>
    </x-slot>

    <div class="container py-4">

        <div class="mb-3">
            <a href="{{ route('apertura-expensas.create') }}" class="btn btn-success">
                + Nueva Apertura
            </a>
        </div>

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <div class="card shadow">

            <div class="card-body">


                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Edificio</th>
                            <th>Mes</th>
                            <th>Gestión</th>
                            <th>Saldo Inicial</th>
                            <th>Efectivo Inicial</th>
                            <th>Expensas Departamentos Monto</th>
                            <th>Expensas Tiendas Monto</th>
                            <th>Expensas Parqueo Monto</th>
                            <th>Factura Agua Monto</th>
                            <th>Prorrateo Agua</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($aperturas as $apertura)
                            @if($apertura->edificio_id == session('edificio_id'))
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $apertura->edificio->nombre }}</td>
                                    <td>{{ $apertura->mes }}</td>
                                    <td>{{ $apertura->gestion }}</td>
                                    <td>{{ $apertura->saldo_inicial }}</td>
                                    <td>{{ $apertura->efectivo_inicial }}</td>
                                    <td>{{ $apertura->expensa_departamentos }}</td>
                                    <td>{{ $apertura->expensa_tiendas }}</td>
                                    <td>{{ $apertura->expensa_parqueo }}</td>
                                    <td>{{ $apertura->factura_agua }}</td>
                                    <td>{{ $apertura->prorrateo_agua }}</td>
                                    <td>
                                        <a href="{{ route('apertura-expensas.edit', $apertura) }}"
                                            class="btn btn-warning btn-sm" title="Editar Apertura">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <!--
                                                    <a href="" class="btn btn-info btn-sm" title="Gastos Fijos">
                                                        <i class="bi bi-pencil">Gastos Fijos</i>
                                                    </a>

                                                    <a href="" class="btn btn-secondary btn-sm" title="Gastos Variables">
                                                        <i class="bi bi-pencil">Gastos Variables</i>
                                                    </a>

                                                    <a href="" class="btn btn-success btn-sm" title="Gastos Extraordinarios">
                                                        <i class="bi bi-pencil">Gastos Extraordinarios</i>
                                                    </a>



                                                    SE DESABILITO ELIMINAR PORQUE HAUY RELACIONES
                                                    <form action="{{ route('apertura-expensas.destroy', $apertura) }}" method="POST"
                                                                style="display:inline-block">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    Eliminar
                                                                </button>

                                                            </form>-->

                                    </td>

                                </tr>
                            @endif
                        @empty

                            <tr>

                                <td colspan="12" class="text-center">
                                    No existen aperturas registradas
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>