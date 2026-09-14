<x-app-layout>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">↩️ Anular movimiento</h2>

            <p class="text-muted mb-0">
                Esta operación no eliminará el movimiento.
            </p>
        </div>

        <a href="{{ route('cajas.movimientos', $movimiento->caja_id) }}"
           class="btn btn-secondary">
            ← Volver
        </a>

    </div>

    <div class="alert alert-warning">
        <strong>⚠️ Atención:</strong>
        al anular este movimiento se generará automáticamente
        una operación de reversión para corregir el saldo de la caja.
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Información del movimiento</strong>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">
                    <strong>Caja</strong>
                    <div>
                        {{ $movimiento->caja->nombre }}
                    </div>
                </div>

                <div class="col-md-4">
                    <strong>Tipo</strong>
                    <div>
                        @if($movimiento->tipo === 'ingreso')
                            <span class="badge bg-success">
                                INGRESO
                            </span>
                        @else
                            <span class="badge bg-danger">
                                EGRESO
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <strong>Monto</strong>
                    <div class="fs-5">
                        Bs. {{ number_format($movimiento->monto, 2) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <strong>Fecha</strong>
                    <div>
                        {{ $movimiento->fecha->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="col-md-6">
                    <strong>Usuario</strong>
                    <div>
                        {{ $movimiento->usuario?->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-12">
                    <strong>Concepto</strong>
                    <div>
                        {{ $movimiento->concepto }}
                    </div>
                </div>

            </div>

            <hr>

            <form method="POST"
                  action="{{ route('cajas.movimiento.anular.store', $movimiento->id) }}">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Motivo de la anulación
                    </label>

                    <textarea
                        name="motivo_anulacion"
                        class="form-control"
                        rows="4"
                        required
                        placeholder="Explique por qué se está anulando este movimiento..."
                    >{{ old('motivo_anulacion') }}</textarea>

                    @error('motivo_anulacion')
                        <div class="text-danger small">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('cajas.movimientos', $movimiento->caja_id) }}"
                       class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('¿Está seguro de anular este movimiento?');">
                        ↩️ Confirmar anulación
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>