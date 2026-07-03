<x-app-layout>

    <x-slot name="header">
        <h3>Expensas Agua</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">

            <a href="{{ route('expensas_aguas.create') }}" class="btn btn-success">

                + Nueva Expensa

            </a>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <div class="card shadow p-3">

            <table class="table table-striped table-hover">

                <thead>

                    <tr>

                        <th>Departamento</th>

                        <th>Propietario</th>

                        <th>Mes</th>

                        <th>Gestión</th>

                        <th>Lectura Anterior</th>

                        <th>Lectura Actual</th>

                        <th>Lectura a Pagar</th>

                        <th>Prorrateo</th>

                        <th>Pago</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($expensas as $expensa)

                        <tr>

                            <td>

                                {{ $expensa->departamento->numero_departamento }}

                            </td>

                            <td>

                                {{ $expensa->propietario->nombres }}

                            </td>

                            <td>

                                {{ $expensa->apertura->mes }}

                            </td>

                            <td>

                                {{ $expensa->apertura->gestion }}

                            </td>

                            <td>

                                {{ $expensa->lectura_anterior ?? '-' }}

                            </td>

                            <td>

                                {{ $expensa->lectura_actual ?? '-' }}

                            </td>

                            <td>

                                {{ $expensa->lectura_pagar ?? '-' }}

                            </td>

                            <td>

                                {{ $expensa->prorrateo ?? '-' }}

                            </td>

                            <td>

                                {{ $expensa->pago ?? '-' }}

                            </td>

                            <td>

                                <a href="{{ route('expensas_aguas.edit', $expensa->id) }}" class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('expensas_aguas.destroy', $expensa->id) }}" method="POST"
                                    style="display:inline-block" onsubmit="return confirm('¿Eliminar registro?')">

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10" class="text-center">

                                No existen registros.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>