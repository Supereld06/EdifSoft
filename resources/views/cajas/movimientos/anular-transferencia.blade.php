<x-app-layout>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">↩️ Anular transferencia</h2>

            <p class="text-muted mb-0">
                Se revertirán las dos operaciones de la transferencia.
            </p>
        </div>

        <a href="{{ route('cajas.movimientos', $movimiento->caja_id) }}"
           class="btn btn-secondary">
            ← Volver
        </a>

    </div>

    <div class="alert alert-danger">

        <strong>⚠️ Atención:</strong>

        esta operación anulará completamente la transferencia,
        tanto en la caja de origen como en la caja de destino.

    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>Transferencia</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>Tipo</th>
                            <th>Caja</th>
                            <th>Concepto</th>
                            <th class="text-end">Monto</th>
                            <th>Fecha</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($movimientosTransferencia as $item)

                            <tr>

                                <td>

                                    @if($item->tipo === 'egreso')

                                        <span class="badge bg-danger">
                                            SALIDA
                                        </span>

                                    @else

                                        <span class="badge bg-success">
                                            ENTRADA
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $item->caja->nombre ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $item->concepto }}
                                </td>

                                <td class="text-end">
                                    Bs.
                                    {{ number_format($item->monto, 2) }}
                                </td>

                                <td>
                                    {{ $item->fecha->format('d/m/Y H:i') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                <strong>Código:</strong>

                <span class="font-monospace">
                    {{ $movimiento->transferencia_id }}
                </span>

            </div>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

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
                        placeholder="Explique por qué se anula la transferencia..."
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
                            onclick="return confirm('¿Está seguro de anular toda la transferencia?');">
                        ↩️ Anular transferencia
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>