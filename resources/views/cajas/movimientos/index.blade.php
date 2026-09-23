<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h3 class="mb-1 fw-bold">
                    <i class="bi bi-arrow-left-right text-primary"></i>
                    Movimientos de Caja
                </h3>

                <small class="text-muted">
                    Registro y administración de movimientos —
                    <strong>{{ $caja->nombre }}</strong>
                </small>
            </div>

        </div>

    </x-slot>


    <div class="container-fluid py-2 px-4">


        {{-- =========================================================
             BOTONES
        ========================================================== --}}

        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">

            <div class="d-flex gap-1 flex-wrap">

                <a href="{{ route('cajas.index') }}"
                   class="btn btn-secondary btn-sm shadow-sm">

                    <i class="bi bi-arrow-left"></i>
                    Cajas

                </a>


                <a href="{{ route('cajas.ingreso.create', $caja->id) }}"
                   class="btn btn-success btn-sm shadow-sm">

                    <i class="bi bi-plus-circle-fill"></i>
                    Ingreso

                </a>


                <a href="{{ route('cajas.egreso.create', $caja->id) }}"
                   class="btn btn-danger btn-sm shadow-sm">

                    <i class="bi bi-dash-circle-fill"></i>
                    Egreso

                </a>


                <a href="{{ route('cajas.transferencia.create', $caja->id) }}"
                   class="btn btn-primary btn-sm shadow-sm">

                    <i class="bi bi-arrow-left-right"></i>
                    Transferencia

                </a>


                {{-- PDF --}}

                <a href="{{ route(
                    'cajas.movimientos.pdf',
                    array_merge(
                        ['id' => $caja->id],
                        request()->query()
                    )
                ) }}"
                   target="_blank"
                   class="btn btn-danger btn-sm">

                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    PDF

                </a>


                {{-- EXCEL --}}

                <a href="{{ route(
                    'cajas.movimientos.excel',
                    array_merge(
                        ['id' => $caja->id],
                        request()->query()
                    )
                ) }}"
                   class="btn btn-success btn-sm">

                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Excel

                </a>

            </div>


            <div class="text-muted small">

                <i class="bi bi-wallet2"></i>

                Caja:

                <strong>{{ $caja->nombre }}</strong>

            </div>

        </div>


        {{-- =========================================================
             MENSAJES
        ========================================================== --}}

        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm py-2 mb-2"
                 role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show shadow-sm py-2 mb-2"
                 role="alert">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- =========================================================
             RESUMEN
        ========================================================== --}}

        <div class="row g-2 mb-2">


            {{-- SALDO --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body py-2 px-3">

                        <div class="d-flex align-items-center">

                            <div class="rounded-circle bg-primary bg-opacity-10
                                        text-primary d-flex align-items-center
                                        justify-content-center me-2"
                                 style="width:40px;height:40px;min-width:40px;">

                                <i class="bi bi-wallet2"></i>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Saldo actual
                                </div>

                                <div class="fs-5 fw-bold">
                                    Bs. {{ number_format($caja->saldo, 2) }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- INGRESOS --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body py-2 px-3">

                        <div class="d-flex align-items-center">

                            <div class="rounded-circle bg-success bg-opacity-10
                                        text-success d-flex align-items-center
                                        justify-content-center me-2"
                                 style="width:40px;height:40px;min-width:40px;">

                                <i class="bi bi-arrow-down-circle-fill"></i>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Total ingresos activos
                                </div>

                                <div class="fs-5 fw-bold text-success">
                                    Bs. {{ number_format($totalIngresos, 2) }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- EGRESOS --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body py-2 px-3">

                        <div class="d-flex align-items-center">

                            <div class="rounded-circle bg-danger bg-opacity-10
                                        text-danger d-flex align-items-center
                                        justify-content-center me-2"
                                 style="width:40px;height:40px;min-width:40px;">

                                <i class="bi bi-arrow-up-circle-fill"></i>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Total egresos activos
                                </div>

                                <div class="fs-5 fw-bold text-danger">
                                    Bs. {{ number_format($totalEgresos, 2) }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             FILTROS
        ========================================================== --}}

        <div class="card border-0 shadow-sm overflow-hidden mb-2">

            <div class="card-header bg-white py-1 px-3 border-0">

                <div class="d-flex align-items-center gap-2">

                    <i class="bi bi-funnel-fill text-primary"></i>

                    <strong class="small">
                        Filtros
                    </strong>

                    <span class="text-muted small">
                        Tipo, categoría, estado y fecha
                    </span>

                </div>

            </div>


            <div class="card-body py-2 px-3">

                <form method="GET"
                      action="{{ route('cajas.movimientos', $caja->id) }}">

                    <div class="row g-2 align-items-end">


                        {{-- TIPO --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <label class="form-label small fw-semibold mb-1">
                                Tipo
                            </label>

                            <select name="tipo"
                                    class="form-select form-select-sm">

                                <option value="">
                                    Todos
                                </option>

                                <option value="ingreso"
                                    {{ request('tipo') === 'ingreso' ? 'selected' : '' }}>

                                    Ingresos

                                </option>

                                <option value="egreso"
                                    {{ request('tipo') === 'egreso' ? 'selected' : '' }}>

                                    Egresos

                                </option>

                            </select>

                        </div>


                        {{-- TIPO DE MOVIMIENTO --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <label class="form-label small fw-semibold mb-1">
                                Tipo de movimiento
                            </label>

                            <select name="tipo_movimiento_id"
                                    class="form-select form-select-sm">

                                <option value="">
                                    Todos
                                </option>


                                {{-- INGRESOS --}}

                                @if($tiposIngreso->count())

                                    <optgroup label="Ingresos">

                                        @foreach($tiposIngreso as $tipoIngreso)

                                            <option value="{{ $tipoIngreso->id }}"
                                                {{ request('tipo_movimiento_id') == $tipoIngreso->id ? 'selected' : '' }}>

                                                {{ $tipoIngreso->nombre }}

                                            </option>

                                        @endforeach

                                    </optgroup>

                                @endif


                                {{-- EGRESOS --}}

                                @if($tiposEgreso->count())

                                    <optgroup label="Egresos">

                                        @foreach($tiposEgreso as $tipoEgreso)

                                            <option value="{{ $tipoEgreso->id }}"
                                                {{ request('tipo_movimiento_id') == $tipoEgreso->id ? 'selected' : '' }}>

                                                {{ $tipoEgreso->nombre }}

                                            </option>

                                        @endforeach

                                    </optgroup>

                                @endif

                            </select>

                        </div>


                        {{-- ESTADO --}}

                        <div class="col-xl-1 col-lg-2 col-md-6">

                            <label class="form-label small fw-semibold mb-1">
                                Estado
                            </label>

                            <select name="estado"
                                    class="form-select form-select-sm">

                                <option value="">
                                    Todos
                                </option>

                                <option value="activo"
                                    {{ request('estado') === 'activo' ? 'selected' : '' }}>

                                    Activos

                                </option>

                                <option value="anulado"
                                    {{ request('estado') === 'anulado' ? 'selected' : '' }}>

                                    Anulados

                                </option>

                            </select>

                        </div>


                        {{-- DESDE --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <label class="form-label small fw-semibold mb-1">
                                Desde
                            </label>

                            <input type="date"
                                   name="fecha_desde"
                                   class="form-control form-control-sm"
                                   value="{{ request('fecha_desde') }}">

                        </div>


                        {{-- HASTA --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <label class="form-label small fw-semibold mb-1">
                                Hasta
                            </label>

                            <input type="date"
                                   name="fecha_hasta"
                                   class="form-control form-control-sm"
                                   value="{{ request('fecha_hasta') }}">

                        </div>


                        {{-- BUSCAR --}}

                        <div class="col-xl-2 col-lg-2 col-md-8">

                            <label class="form-label small fw-semibold mb-1">
                                Buscar
                            </label>

                            <input type="text"
                                   name="buscar"
                                   class="form-control form-control-sm"
                                   placeholder="Concepto, observación..."
                                   value="{{ request('buscar') }}">

                        </div>


                        {{-- BOTONES --}}

                        <div class="col-xl-1 col-lg-2 col-md-4">

                            <div class="d-flex gap-1">

                                <button type="submit"
                                        class="btn btn-primary btn-sm shadow-sm"
                                        title="Aplicar filtros">

                                    <i class="bi bi-search"></i>

                                </button>


                                <a href="{{ route('cajas.movimientos', $caja->id) }}"
                                   class="btn btn-secondary btn-sm shadow-sm"
                                   title="Limpiar filtros">

                                    <i class="bi bi-x-circle"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- =========================================================
             TABLA
        ========================================================== --}}

        <div class="card border-0 shadow-sm overflow-hidden">


            {{-- CABECERA --}}

            <div class="card-header bg-white py-2 px-3 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-arrow-left-right text-primary me-2"></i>

                            Movimientos registrados

                        </h5>

                        <small class="text-muted">
                            Historial de movimientos de la caja
                        </small>

                    </div>


                    <span class="badge bg-primary rounded-pill px-3 py-2"
                          style="font-size:0.85rem;">

                        {{ $movimientos->total() }}

                        movimientos

                    </span>

                </div>

            </div>


            {{-- TABLA --}}

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th class="px-3">
                                Fecha
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Tipo de movimiento
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

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($movimientos as $movimiento)

                            <tr @if($movimiento->estado === 'anulado')
                                    class="table-secondary"
                                @endif>


                                {{-- FECHA --}}

                                <td class="px-3">

                                    <div class="fw-semibold small">

                                        <i class="bi bi-calendar3 text-primary me-1"></i>

                                        {{ $movimiento->fecha->format('d/m/Y') }}

                                    </div>

                                    <small class="text-muted">

                                        <i class="bi bi-clock me-1"></i>

                                        {{ $movimiento->fecha->format('H:i') }}

                                    </small>

                                </td>


                                {{-- TIPO --}}

                                <td>

                                    @if($movimiento->tipo === 'ingreso')

                                        <span class="badge bg-success rounded-pill px-2 py-1">

                                            <i class="bi bi-arrow-down-circle-fill me-1"></i>

                                            INGRESO

                                        </span>

                                    @else

                                        <span class="badge bg-danger rounded-pill px-2 py-1">

                                            <i class="bi bi-arrow-up-circle-fill me-1"></i>

                                            EGRESO

                                        </span>

                                    @endif


                                    @if($movimiento->transferencia_id)

                                        <span class="badge bg-primary rounded-pill px-2 py-1 mt-1">

                                            <i class="bi bi-arrow-left-right me-1"></i>

                                            TRANSFERENCIA

                                        </span>

                                    @endif

                                </td>


                                {{-- TIPO DE MOVIMIENTO --}}

                                <td>

                                    @if($movimiento->tipoMovimiento)

                                        @if($movimiento->tipo === 'ingreso')

                                            <span class="badge bg-success-subtle text-success border border-success-subtle">

                                                <i class="bi bi-tag-fill me-1"></i>

                                                {{ $movimiento->tipoMovimiento->nombre }}

                                            </span>

                                        @else

                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">

                                                <i class="bi bi-tag-fill me-1"></i>

                                                {{ $movimiento->tipoMovimiento->nombre }}

                                            </span>

                                        @endif

                                    @else

                                        <span class="text-muted small">

                                            <i class="bi bi-dash-circle me-1"></i>

                                            Sin tipo

                                        </span>

                                    @endif

                                </td>


                                {{-- CONCEPTO --}}

                                <td>

                                    <div class="fw-semibold small">

                                        {{ $movimiento->concepto }}

                                    </div>


                                    @if($movimiento->transferencia_id)

                                        <small class="text-muted d-block">

                                            <i class="bi bi-link-45deg"></i>

                                            {{ $movimiento->transferencia_id }}

                                        </small>

                                    @endif


                                    @if($movimiento->observacion)

                                        <small class="text-muted d-block">

                                            <i class="bi bi-chat-left-text me-1"></i>

                                            {{ $movimiento->observacion }}

                                        </small>

                                    @endif

                                </td>


                                {{-- USUARIO --}}

                                <td>

                                    <span class="small">

                                        <i class="bi bi-person-fill text-primary me-1"></i>

                                        {{ $movimiento->usuario?->name ?? 'N/A' }}

                                    </span>

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

                                <td class="text-end small">

                                    Bs.

                                    {{ number_format($movimiento->saldo_anterior, 2) }}

                                </td>


                                {{-- SALDO NUEVO --}}

                                <td class="text-end small">

                                    Bs.

                                    {{ number_format($movimiento->saldo_nuevo, 2) }}

                                </td>


                                {{-- ESTADO --}}

                                <td>

                                    @if($movimiento->estado === 'activo')

                                        <span class="badge bg-success rounded-pill px-2 py-1">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            ACTIVO

                                        </span>

                                    @else

                                        <span class="badge bg-danger rounded-pill px-2 py-1">

                                            <i class="bi bi-x-circle-fill me-1"></i>

                                            ANULADO

                                        </span>


                                        @if($movimiento->anulado_en)

                                            <small class="text-muted d-block mt-1">

                                                {{ $movimiento->anulado_en->format('d/m/Y H:i') }}

                                            </small>

                                        @endif

                                    @endif

                                </td>


                                {{-- ACCIONES --}}

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">


                                        {{-- RECIBO --}}

                                        @if($movimiento->transferencia_id)

                                            <a href="{{ route(
                                                'cajas.transferencia.recibo',
                                                $movimiento->transferencia_id
                                            ) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Imprimir recibo de transferencia">

                                                <i class="bi bi-printer-fill"></i>

                                            </a>

                                        @else

                                            <a href="{{ route(
                                                'cajas.movimiento.recibo',
                                                $movimiento->id
                                            ) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Imprimir recibo">

                                                <i class="bi bi-printer-fill"></i>

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
                                            ) }}"
                                               class="btn btn-sm btn-outline-danger"
                                               title="Anular movimiento">

                                                <i class="bi bi-arrow-counterclockwise"></i>

                                            </a>

                                        @endif

                                    </div>


                                    {{-- INFORMACIÓN DE ANULACIÓN --}}

                                    @if($movimiento->estado === 'anulado')

                                        <div class="mt-1">

                                            <small class="text-danger d-block">

                                                <i class="bi bi-person-x-fill me-1"></i>

                                                Anulado por:

                                                {{ $movimiento->usuarioAnulacion?->name ?? 'N/A' }}

                                            </small>


                                            @if($movimiento->motivo_anulacion)

                                                <small class="text-muted d-block">

                                                    <i class="bi bi-chat-left-text me-1"></i>

                                                    {{ $movimiento->motivo_anulacion }}

                                                </small>

                                            @endif

                                        </div>

                                    @endif

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="10"
                                    class="text-center py-4">

                                    <div class="text-muted">

                                        <i class="bi bi-arrow-left-right fs-1 d-block mb-2"></i>

                                        <h5>
                                            No existen movimientos registrados
                                        </h5>

                                        <p class="mb-0">

                                            No hay movimientos que coincidan
                                            con los filtros seleccionados.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 PAGINACIÓN
            ====================================================== --}}

            @if($movimientos->hasPages())

                <div class="card-footer bg-white border-0 py-2">

                    <div class="d-flex justify-content-center">

                        {{ $movimientos->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>