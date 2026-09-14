<x-app-layout>

    <div class="container-fluid">

        {{-- ENCABEZADO --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="mb-1">
                    📋 Movimientos de Caja
                </h2>

                <p class="text-muted mb-0">
                    Caja:
                    <strong>
                        {{ $caja->nombre }}
                    </strong>
                </p>

            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('cajas.index') }}" class="btn btn-secondary">
                    ← Cajas
                </a>

                <a href="{{ route('cajas.ingreso.create', $caja->id) }}" class="btn btn-success">
                    ➕ Ingreso
                </a>

                <a href="{{ route('cajas.egreso.create', $caja->id) }}" class="btn btn-danger">
                    ➖ Egreso
                </a>

                <a href="{{ route('cajas.transferencia.create', $caja->id) }}" class="btn btn-primary">
                    🔄 Transferencia
                </a>

                <a href="{{ route('cajas.movimientos.pdf', array_merge(
    ['id' => $caja->id],
    request()->query()
)) }}" target="_blank" class="btn btn-dark">
                    📄 PDF
                </a>

            </div>

        </div>


        {{-- MENSAJES --}}

        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show">

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- RESUMEN --}}

        <div class="row g-3 mb-4">

            <div class="col-md-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <div class="text-muted small">
                            Saldo actual
                        </div>

                        <div class="fs-3 fw-bold">
                            Bs.
                            {{ number_format($caja->saldo, 2) }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <div class="text-muted small">
                            Total ingresos activos
                        </div>

                        <div class="fs-3 fw-bold text-success">
                            Bs.
                            {{ number_format($totalIngresos, 2) }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <div class="text-muted small">
                            Total egresos activos
                        </div>

                        <div class="fs-3 fw-bold text-danger">
                            Bs.
                            {{ number_format($totalEgresos, 2) }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FILTROS --}}

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('cajas.movimientos', $caja->id) }}">

                    <div class="row g-2 align-items-end">

                        <div class="col-md-2">

                            <label class="form-label">
                                Tipo
                            </label>

                            <select name="tipo" class="form-select">

                                <option value="">
                                    Todos
                                </option>

                                <option value="ingreso" {{ request('tipo') === 'ingreso' ? 'selected' : '' }}>
                                    Ingresos
                                </option>

                                <option value="egreso" {{ request('tipo') === 'egreso' ? 'selected' : '' }}>
                                    Egresos
                                </option>

                            </select>

                        </div>


                        <div class="col-md-2">

                            <label class="form-label">
                                Estado
                            </label>

                            <select name="estado" class="form-select">

                                <option value="">
                                    Todos
                                </option>

                                <option value="activo" {{ request('estado') === 'activo' ? 'selected' : '' }}>
                                    Activos
                                </option>

                                <option value="anulado" {{ request('estado') === 'anulado' ? 'selected' : '' }}>
                                    Anulados
                                </option>

                            </select>

                        </div>


                        <div class="col-md-2">

                            <label class="form-label">
                                Desde
                            </label>

                            <input type="date" name="fecha_desde" class="form-control"
                                value="{{ request('fecha_desde') }}">

                        </div>


                        <div class="col-md-2">

                            <label class="form-label">
                                Hasta
                            </label>

                            <input type="date" name="fecha_hasta" class="form-control"
                                value="{{ request('fecha_hasta') }}">

                        </div>


                        <div class="col-md-3">

                            <label class="form-label">
                                Buscar
                            </label>

                            <input type="text" name="buscar" class="form-control"
                                placeholder="Concepto, observación, transferencia..." value="{{ request('buscar') }}">

                        </div>


                        <div class="col-md-1">

                            <button class="btn btn-dark w-100">
                                🔎
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- TABLA --}}

        <div class="card shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle mb-0">

                        <thead class="table-dark">

                            <tr>

                                <th>
                                    Fecha
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Concepto
                                </th>

                                <th>
                                    Usuario
                                </th>

                                <th class="text-end">
                                    Monto
                                </th>

                                <th class="text-end">
                                    Saldo anterior
                                </th>

                                <th class="text-end">
                                    Saldo nuevo
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Usuario
                                </th>

                                <th class="text-center">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($movimientos as $movimiento)

                                <tr @if($movimiento->estado === 'anulado') class="table-secondary" @endif>

                                    {{-- FECHA --}}

                                    <td>

                                        {{ $movimiento->fecha->format('d/m/Y') }}

                                        <br>

                                        <small class="text-muted">
                                            {{ $movimiento->fecha->format('H:i') }}
                                        </small>

                                    </td>


                                    {{-- TIPO --}}

                                    <td>

                                        @if($movimiento->tipo === 'ingreso')

                                            <span class="badge bg-success">
                                                INGRESO
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                EGRESO
                                            </span>

                                        @endif


                                        @if($movimiento->transferencia_id)

                                            <br>

                                            <span class="badge bg-primary mt-1">
                                                🔄 TRANSFERENCIA
                                            </span>

                                        @endif

                                    </td>


                                    {{-- CONCEPTO --}}

                                    <td>

                                        <strong>
                                            {{ $movimiento->concepto }}
                                        </strong>

                                        @if($movimiento->transferencia_id)

                                            <br>

                                            <small class="text-muted">
                                                {{ $movimiento->transferencia_id }}
                                            </small>

                                        @endif


                                        @if($movimiento->observacion)

                                            <br>

                                            <small class="text-muted">
                                                {{ $movimiento->observacion }}
                                            </small>

                                        @endif

                                    </td>


                                    {{-- USUARIO --}}

                                    <td>

                                        {{ $movimiento->usuario?->name ?? 'N/A' }}

                                    </td>


                                    {{-- MONTO --}}

                                    <td class="text-end fw-bold">

                                        @if($movimiento->tipo === 'ingreso')

                                            <span class="text-success">
                                                + Bs.
                                                {{ number_format($movimiento->monto, 2) }}
                                            </span>

                                        @else

                                            <span class="text-danger">
                                                - Bs.
                                                {{ number_format($movimiento->monto, 2) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- SALDO ANTERIOR --}}

                                    <td class="text-end">

                                        Bs.
                                        {{ number_format($movimiento->saldo_anterior, 2) }}

                                    </td>


                                    {{-- SALDO NUEVO --}}

                                    <td class="text-end">

                                        Bs.
                                        {{ number_format($movimiento->saldo_nuevo, 2) }}

                                    </td>


                                    {{-- ESTADO --}}

                                    <td>

                                        @if($movimiento->estado === 'activo')

                                            <span class="badge bg-success">
                                                ACTIVO
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                ANULADO
                                            </span>

                                            @if($movimiento->anulado_en)

                                                <br>

                                                <small class="text-muted">
                                                    {{ $movimiento->anulado_en->format('d/m/Y H:i') }}
                                                </small>

                                            @endif

                                        @endif

                                    </td>

                                    <td class="">
                                        {{ $movimiento->usuario?->name ?? 'N/A' }}
                                    </td>


                                    {{-- ACCIONES --}}

                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-1 flex-wrap">

                                            {{-- RECIBO --}}

                                            @if($movimiento->transferencia_id)

                                                                                <a href="{{ route(
                                                    'cajas.transferencia.recibo',
                                                    $movimiento->transferencia_id
                                                ) }}" target="_blank" class="btn btn-sm btn-outline-primary"
                                                                                    title="Imprimir recibo de transferencia">

                                                                                    🖨️

                                                                                </a>

                                            @else

                                                                                <a href="{{ route(
                                                    'cajas.movimiento.recibo',
                                                    $movimiento->id
                                                ) }}" target="_blank" class="btn btn-sm btn-outline-primary"
                                                                                    title="Imprimir recibo">

                                                                                    🖨️

                                                                                </a>

                                            @endif


                                            {{-- ANULAR --}}

                                            @if(
                                                                                    $movimiento->estado === 'activo'
                                                                                    &&
                                                                                    $movimiento->referencia_tipo !== 'anulacion_movimiento'
                                                                                    &&
                                                                                    $movimiento->referencia_tipo !== 'anulacion_transferencia'
                                                                                )

                                                                                <a href="{{ route(
                                                    'cajas.movimiento.anular',
                                                    $movimiento->id
                                                ) }}" class="btn btn-sm btn-outline-danger" title="Anular movimiento">

                                                                                    ↩️

                                                                                </a>

                                            @endif

                                        </div>


                                        {{-- INFORMACIÓN DE ANULACIÓN --}}

                                        @if($movimiento->estado === 'anulado')

                                            <div class="mt-2">

                                                <small class="text-danger">

                                                    Anulado por:
                                                    {{ $movimiento->usuarioAnulacion?->name ?? 'N/A' }}

                                                </small>

                                                @if($movimiento->motivo_anulacion)

                                                    <br>

                                                    <small class="text-muted">

                                                        {{ $movimiento->motivo_anulacion }}

                                                    </small>

                                                @endif

                                            </div>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center py-5 text-muted">

                                        No existen movimientos para mostrar.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            @if($movimientos->hasPages())

                <div class="card-footer">

                    {{ $movimientos->links() }}

                </div>

            @endif

        </div>

    </div>

</x-app-layout>