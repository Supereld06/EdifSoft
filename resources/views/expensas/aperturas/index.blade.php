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
                            <th>ID</th>
                            <th>Edificio</th>
                            <th>Mes</th>
                            <th>Gestión</th>
                            <th>Saldo Inicial</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($aperturas as $apertura)

                            <tr>

                                <td>{{ $apertura->id }}</td>
                                 <td>{{ $apertura->edificio->nombre }}</td>
                                <td>{{ $apertura->mes }}</td>
                                <td>{{ $apertura->gestion }}</td>
                                <td>{{ $apertura->saldo_inicial }}</td>
                                <td>
                                    <a href="{{ route('apertura-expensas.edit', $apertura) }}"
                                        class="btn btn-warning btn-sm" title="Editar Apertura">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="" class="btn btn-info btn-sm" title="Gastos Fijos">
                                        <i class="bi bi-pencil">Gastos Fijos</i>
                                    </a>

                                    <a href="" class="btn btn-secondary btn-sm" title="Gastos Variables">
                                        <i class="bi bi-pencil">Gastos Variables</i>
                                    </a>

                                    <a href="" class="btn btn-success btn-sm" title="Gastos Extraordinarios">
                                        <i class="bi bi-pencil">Gastos Extraordinarios</i>
                                    </a>


                                    <!--       <form action="{{ route('apertura-expensas.destroy', $apertura) }}" method="POST"
                                                style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Eliminar
                                                </button>

                                            </form>-->

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">
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