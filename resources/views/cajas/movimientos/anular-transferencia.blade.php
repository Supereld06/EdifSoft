<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="mb-1 fw-bold">

                    <i class="bi bi-arrow-counterclockwise text-danger"></i>

                    Anular transferencia

                </h3>

                <small class="text-muted">

                    Reversión completa de la transferencia entre cajas

                </small>

            </div>

        </div>

    </x-slot>


    <div class="container-fluid py-3 px-4">


        {{-- =========================================================
        MENSAJES
        ========================================================== --}}

        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show shadow-sm py-2 mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-danger shadow-sm py-2 mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <strong>Revisa los datos:</strong>

                <ul class="mb-0 mt-1 small">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =========================================================
        ADVERTENCIA
        ========================================================== --}}

        <div class="alert alert-danger shadow-sm border-0 py-2 mb-2">

            <div class="d-flex align-items-start">

                <i class="bi bi-exclamation-octagon-fill fs-5 me-2"></i>

                <div>

                    <strong>Atención</strong>

                    <div class="small">

                        Esta operación anulará completamente la transferencia,
                        tanto en la caja de origen como en la caja de destino.

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        INFORMACIÓN DE LA TRANSFERENCIA
        ========================================================== --}}

        <div class="card border-0 shadow-sm mb-2">

            <div class="card-header bg-white border-0 py-2 px-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">

                        <i class="bi bi-arrow-left-right text-primary me-2"></i>

                        <strong>
                            Detalle de la transferencia
                        </strong>

                    </div>


                    @if($movimiento->transferencia_id)

                        <span class="badge bg-light text-dark border font-monospace">

                            {{ $movimiento->transferencia_id }}

                        </span>

                    @endif

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-dark">

                            <tr>

                                <th class="px-3">
                                    Operación
                                </th>

                                <th>
                                    Caja
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Concepto
                                </th>

                                <th class="text-end">
                                    Monto
                                </th>

                                <th>
                                    Fecha
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($movimientosTransferencia as $item)

                                <tr>


                                    {{-- OPERACIÓN --}}

                                    <td class="px-3">

                                        @if($item->tipo === 'egreso')

                                            <span class="badge bg-danger">

                                                <i class="bi bi-box-arrow-right me-1"></i>

                                                SALIDA

                                            </span>

                                        @else

                                            <span class="badge bg-success">

                                                <i class="bi bi-box-arrow-in-down-right me-1"></i>

                                                ENTRADA

                                            </span>

                                        @endif

                                    </td>


                                    {{-- CAJA --}}

                                    <td>

                                        <i class="bi bi-safe2-fill text-primary me-1"></i>

                                        {{ $item->caja->nombre ?? 'N/A' }}

                                    </td>


                                    {{-- TIPO --}}

                                    <td>

                                        @if($item->tipoMovimiento)

                                                                    <span class="badge
                                                                                {{ $item->tipo === 'ingreso'
                                            ? 'bg-success-subtle text-success border border-success-subtle'
                                            : 'bg-danger-subtle text-danger border border-danger-subtle' }}">

                                                                        <i class="bi bi-tag-fill me-1"></i>

                                                                        {{ $item->tipoMovimiento->nombre }}

                                                                    </span>

                                        @else

                                            <span class="text-muted small">

                                                Sin tipo

                                            </span>

                                        @endif

                                    </td>


                                    {{-- CONCEPTO --}}

                                    <td>

                                        <span class="small fw-semibold">

                                            {{ $item->concepto }}

                                        </span>

                                    </td>


                                    {{-- MONTO --}}

                                    <td class="text-end fw-bold">

                                        Bs. {{ number_format($item->monto, 2) }}

                                    </td>


                                    {{-- FECHA --}}

                                    <td>

                                        <span class="small">

                                            <i class="bi bi-calendar3 text-primary me-1"></i>

                                            {{ $item->fecha->format('d/m/Y') }}

                                        </span>

                                        <small class="text-muted d-block">

                                            <i class="bi bi-clock me-1"></i>

                                            {{ $item->fecha->format('H:i') }}

                                        </small>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- CÓDIGO --}}

                <div class="px-3 py-2 border-top bg-light">

                    <small class="text-muted">

                        <i class="bi bi-upc-scan me-1"></i>

                        Código de transferencia:

                    </small>

                    <strong class="font-monospace ms-1">

                        {{ $movimiento->transferencia_id }}

                    </strong>

                </div>

            </div>

        </div>


        {{-- =========================================================
        FORMULARIO
        ========================================================== --}}

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-2 px-3">

                <div class="d-flex align-items-center">

                    <i class="bi bi-arrow-counterclockwise text-danger me-2"></i>

                    <strong>
                        Confirmar anulación de transferencia
                    </strong>

                </div>

            </div>


            <div class="card-body py-3 px-3">

                <form method="POST" action="{{ route(
    'cajas.movimiento.anular.store',
    $movimiento->id
) }}">

                    @csrf


                    <div class="mb-3">

                        <label class="form-label fw-semibold small">

                            Motivo de la anulación

                            <span class="text-danger">*</span>

                        </label>

                        <textarea name="motivo_anulacion"
                            class="form-control @error('motivo_anulacion') is-invalid @enderror" rows="3"
                            maxlength="1000" required
                            placeholder="Explique por qué se está anulando esta transferencia...">{{ old('motivo_anulacion') }}</textarea>


                        @error('motivo_anulacion')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    <div class="alert alert-warning border py-2 mb-3">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-info-circle-fill me-2"></i>

                            <small>

                                Al confirmar, se revertirán las operaciones
                                correspondientes en las cajas de origen y destino.
                                El sistema verificará los saldos antes de realizar
                                la reversión.

                            </small>

                        </div>

                    </div>


                    <div class="d-flex justify-content-between align-items-center">

                        <a href="{{ route(
    'cajas.movimientos',
    $movimiento->caja_id
) }}" class="btn btn-secondary btn-sm">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>


                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Está seguro de anular toda la transferencia? Esta operación revertirá las dos operaciones y no se puede deshacer.');">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Anular transferencia

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>