<x-app-layout>

    <x-slot name="header">
        <h3>Expensas Tiendas</h3>
    </x-slot>

    <div class="container">

        <div class="mb-3">

            <a href="{{ route('expensas_tiendas.create') }}" class="btn btn-success">
                + Nueva Expensa
            </a>

            <a href="{{ route('pago-expensas.index') }}" class="btn btn-secondary">
                Atras
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
                <thead>
                    <tr>
                        <th>Tienda</th>
                        <th>Propietario</th>
                        <th>Total</th>
                        <th>Pagado</th>
                        <th>Saldo</th>
                        <th>Estado</th>
                        <th>Mes</th>
                        <th>Gestión</th>
                        <th>Pago</th>
                        <th>Recibos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($expensas as $expensa)

                        <tr>

                            <td>
                                {{ $expensa->tienda->numero_tienda }}
                            </td>

                            <td>
                                {{ $expensa->propietario->nombres }} {{ $expensa->propietario->apellido_paterno }} {{ $expensa->propietario->apellido_materno }}
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
                                {{ $expensa->apertura->gestion }}
                            </td>

                            <td>

                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalPago{{ $expensa->id }}">

                                    <i class="bi bi-cash-coin"></i>

                                </button>

                            </td>

                            <td>

                                @foreach($expensa->recibos as $recibo)

                                    <a href="{{ route('recibos_tiendas.pdf', $recibo->id) }}" target="_blank"
                                        class="badge bg-danger text-decoration-none" title="{{ $recibo->numero }}">

                                        <i class="bi bi-file-pdf"></i>

                                    </a>

                                @endforeach

                            </td>

                            <td>

                                <a href="{{ route('expensas_tiendas.edit', $expensa) }}" class="btn btn-warning btn-sm"
                                    title="Editar">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                @if($expensa->recibos->count() == 0)

                                    <form action="{{ route('expensas_tiendas.destroy', $expensa) }}" method="POST"
                                        style="display:inline-block" onsubmit="return confirm('¿Eliminar expensa?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                @else

                                    <button class="btn btn-secondary btn-sm" disabled
                                        title="La expensa tiene pagos registrados">

                                        <i class="bi bi-lock-fill"></i>

                                    </button>

                                @endif

                            </td>

                        </tr>

                        <!-- Modal Pago -->

                        <div class="modal fade" id="modalPago{{ $expensa->id }}" tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <form action="{{ route('recibos_tiendas.store') }}" method="POST">

                                        @csrf

                                        <div class="modal-header">

                                            <h5 class="modal-title">

                                                Registrar Pago

                                            </h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <input type="hidden" name="propietario_id"
                                                value="{{ $expensa->propietario_id }}">

                                            <input type="hidden" name="expensa_tienda_id" value="{{ $expensa->id }}">

                                            <div class="mb-3">

                                                <label>Fecha</label>

                                                <input type="date" name="fecha" value="{{ date('Y-m-d') }}"
                                                    class="form-control" required>

                                            </div>

                                            <div class="mb-3">

                                                <label>Propietario</label>

                                                <input type="text" class="form-control" readonly
                                                    value="{{ $expensa->propietario->nombres }}">

                                            </div>

                                            <div class="mb-3">

                                                <label>Tienda</label>

                                                <input type="text" class="form-control" readonly
                                                    value="{{ $expensa->tienda->numero_tienda }}">

                                            </div>

                                            <div class="mb-3">

                                                <label>Saldo Pendiente</label>

                                                <input type="text" class="form-control" readonly
                                                    value="{{ $expensa->saldo }}">

                                            </div>

                                            <div class="mb-3">

                                                <label>Monto</label>

                                                <input type="number" step="0.01" min="0.01" max="{{ $expensa->saldo }}"
                                                    name="monto" value="{{ $expensa->saldo }}" class="form-control"
                                                    required>

                                            </div>

                                            <input type="hidden" name="mes" value="{{ $expensa->apertura->mes }}">

                                            <input type="hidden" name="gestion" value="{{ $expensa->apertura->gestion }}">

                                            <div class="mb-3">

                                                <label>Moneda</label>

                                                <select name="moneda" class="form-control">

                                                    <option>Bolivianos</option>
                                                    <option>Dolares</option>

                                                </select>

                                            </div>

                                            <div class="mb-3">

                                                <label>Tipo Pago</label>

                                                <select name="tipo_pago" class="form-control">

                                                    <option>Efectivo</option>
                                                    <option>Deposito</option>
                                                    <option>QR</option>

                                                </select>

                                            </div>

                                            <div class="mb-3">

                                                <label>Nro. Depósito</label>

                                                <input type="text" name="numero_deposito" class="form-control">

                                            </div>

                                        </div>

                                        <input type="hidden" name="origen" value="tiendas">

                                        <div class="modal-footer">

                                            <button class="btn btn-success">

                                                Guardar Pago

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>