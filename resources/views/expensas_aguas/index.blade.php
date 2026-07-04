<x-app-layout>

    <x-slot name="header">
        <h3>Expensas de Agua</h3>
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

            <table class="table table-striped">

                <thead class="">

                    <tr>
                        <th>Departamento</th>
                        <th>Propietario</th>
                        <th>Mes</th>
                        <th>Gestión</th>
                        <th>Lectura Ant.</th>
                        <th>Lectura Act.</th>
                        <th>Consumo</th>
                        <th>Prorrateo</th>
                        <th>Total</th>
                        <th>Pagado</th>
                        <th>Saldo</th>
                        <th>Estado</th>
                        <th>Pago</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($expensas as $expensa)

                        @php
                            $estado = $expensa->estado;
                        @endphp

                        <tr>
                            <td>{{ $expensa->departamento->numero_departamento }}</td>
                            <td>{{ $expensa->propietario->nombres }}
                                {{ $expensa->propietario->apellido_paterno }}
                                {{ $expensa->propietario->apellido_materno }}
                            </td>
                            <td>{{ $expensa->apertura->mes }}</td>
                            <td>{{ $expensa->apertura->gestion }}</td>
                            <td>{{ $expensa->lectura_anterior ?? '-' }}</td>
                            <td>{{ $expensa->lectura_actual ?? '-' }}</td>
                            <td>{{ $expensa->lectura_pagar ?? '-' }}</td>
                            <td>{{ $expensa->prorrateo ?? '-' }}</td>
                            <td>{{ number_format($expensa->total, 2) }}</td>
                            <td>{{ number_format($expensa->pagado, 2) }}</td>
                            <td>{{ number_format($expensa->saldo, 2) }}</td>

                            {{-- ESTADO COLORES --}}
                            <td>

                                @if($estado == 'PAGADO')
                                    <span class="badge bg-success">PAGADO</span>

                                @elseif($estado == 'PARCIAL')
                                    <span class="badge bg-warning text-dark">PARCIAL</span>

                                @else
                                    <span class="badge bg-danger">PENDIENTE</span>
                                @endif

                            </td>

                            <td>
                                {{-- BOTÓN PAGO (NO FUNCIONAL AÚN) --}}
                                <a class="btn btn-success btn-sm">
                                    <i class="bi bi-cash-stack"></i>
                                </a>
                            </td>
                            <td>

                                {{-- EDITAR --}}
                                <a href="{{ route('expensas_aguas.edit', $expensa->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>



                                {{-- ELIMINAR --}}
                                <form action="{{ route('expensas_aguas.destroy', $expensa->id) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar registro?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"">
                                            <i class=" bi bi-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="14" class="text-center">
                                No existen registros
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $expensas->links() }}
            </div>

        </div>

    </div>

</x-app-layout>