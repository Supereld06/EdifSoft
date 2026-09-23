<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="mb-1 fw-bold">

                    <i class="bi bi-arrow-counterclockwise text-danger"></i>

                    Anular movimiento

                </h3>

                <small class="text-muted">

                    Reversión de un movimiento de caja

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

        <div class="alert alert-warning shadow-sm border-0 py-2 mb-2">

            <div class="d-flex align-items-start">

                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>

                <div>

                    <strong>Atención</strong>

                    <div class="small">

                        El movimiento no será eliminado.
                        Se generará automáticamente una operación
                        de reversión para corregir el saldo de la caja.

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        INFORMACIÓN DEL MOVIMIENTO
        ========================================================== --}}

        <div class="card border-0 shadow-sm mb-2">

            <div class="card-header bg-white border-0 py-2 px-3">

                <div class="d-flex align-items-center">

                    <i class="bi bi-info-circle-fill text-primary me-2"></i>

                    <strong>
                        Información del movimiento
                    </strong>

                </div>

            </div>


            <div class="card-body py-3 px-3">

                <div class="row g-2">


                    {{-- CAJA --}}

                    <div class="col-lg-3 col-md-6">

                        <div class="small text-muted">
                            Caja
                        </div>

                        <div class="fw-semibold">

                            <i class="bi bi-safe2-fill text-primary me-1"></i>

                            {{ $movimiento->caja->nombre }}

                        </div>

                    </div>


                    {{-- TIPO --}}

                    <div class="col-lg-2 col-md-6">

                        <div class="small text-muted">
                            Tipo
                        </div>

                        @if($movimiento->tipo === 'ingreso')

                            <span class="badge bg-success">

                                <i class="bi bi-arrow-down-circle-fill me-1"></i>

                                INGRESO

                            </span>

                        @else

                            <span class="badge bg-danger">

                                <i class="bi bi-arrow-up-circle-fill me-1"></i>

                                EGRESO

                            </span>

                        @endif

                    </div>


                    {{-- TIPO DE MOVIMIENTO --}}

                    <div class="col-lg-3 col-md-6">

                        <div class="small text-muted">
                            Tipo de movimiento
                        </div>

                        @if($movimiento->tipoMovimiento)

                                            <span class="badge
                                                    {{ $movimiento->tipo === 'ingreso'
                            ? 'bg-success-subtle text-success border border-success-subtle'
                            : 'bg-danger-subtle text-danger border border-danger-subtle' }}">

                                                <i class="bi bi-tag-fill me-1"></i>

                                                {{ $movimiento->tipoMovimiento->nombre }}

                                            </span>

                        @else

                            <span class="text-muted small">
                                Sin tipo
                            </span>

                        @endif

                    </div>


                    {{-- MONTO --}}

                    <div class="col-lg-2 col-md-6">

                        <div class="small text-muted">
                            Monto
                        </div>

                        <div class="fs-5 fw-bold
                            {{ $movimiento->tipo === 'ingreso'
    ? 'text-success'
    : 'text-danger' }}">

                            Bs. {{ number_format($movimiento->monto, 2) }}

                        </div>

                    </div>


                    {{-- FECHA --}}

                    <div class="col-lg-2 col-md-6">

                        <div class="small text-muted">
                            Fecha
                        </div>

                        <div class="small fw-semibold">

                            <i class="bi bi-calendar3 text-primary me-1"></i>

                            {{ $movimiento->fecha->format('d/m/Y H:i') }}

                        </div>

                    </div>


                    {{-- USUARIO --}}

                    <div class="col-lg-3 col-md-6">

                        <div class="small text-muted">
                            Registrado por
                        </div>

                        <div class="small fw-semibold">

                            <i class="bi bi-person-fill text-primary me-1"></i>

                            {{ $movimiento->usuario?->name ?? 'N/A' }}

                        </div>

                    </div>


                    {{-- SALDO ANTERIOR --}}

                    <div class="col-lg-2 col-md-6">

                        <div class="small text-muted">
                            Saldo anterior
                        </div>

                        <div class="small fw-semibold">

                            Bs. {{ number_format($movimiento->saldo_anterior, 2) }}

                        </div>

                    </div>


                    {{-- SALDO NUEVO --}}

                    <div class="col-lg-2 col-md-6">

                        <div class="small text-muted">
                            Saldo nuevo
                        </div>

                        <div class="small fw-semibold">

                            Bs. {{ number_format($movimiento->saldo_nuevo, 2) }}

                        </div>

                    </div>


                    {{-- CONCEPTO --}}

                    <div class="col-lg-5 col-md-12">

                        <div class="small text-muted">
                            Concepto
                        </div>

                        <div class="fw-semibold">

                            <i class="bi bi-receipt text-primary me-1"></i>

                            {{ $movimiento->concepto }}

                        </div>

                    </div>


                    {{-- OBSERVACIÓN --}}

                    @if($movimiento->observacion)

                        <div class="col-12">

                            <div class="small text-muted">
                                Observación
                            </div>

                            <div class="small">

                                <i class="bi bi-chat-left-text text-muted me-1"></i>

                                {{ $movimiento->observacion }}

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =========================================================
        FORMULARIO DE ANULACIÓN
        ========================================================== --}}

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-2 px-3">

                <div class="d-flex align-items-center">

                    <i class="bi bi-arrow-counterclockwise text-danger me-2"></i>

                    <strong>
                        Confirmar anulación
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
                            placeholder="Explique por qué se está anulando este movimiento...">{{ old('motivo_anulacion') }}</textarea>


                        @error('motivo_anulacion')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    <div class="alert alert-light border py-2 mb-3">

                        <small>

                            <i class="bi bi-info-circle-fill text-primary me-1"></i>

                            Al confirmar, el sistema intentará revertir el
                            movimiento y actualizar el saldo de la caja.

                        </small>

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
                            onclick="return confirm('¿Está seguro de anular este movimiento? Esta operación no se puede deshacer.');">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Confirmar anulación

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>