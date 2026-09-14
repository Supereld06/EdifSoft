<x-app-layout>

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2>⬇️ Registrar Egreso</h2>

                <p class="text-muted mb-0">
                    Caja: <strong>{{ $caja->nombre }}</strong>
                </p>
            </div>

            <a href="{{ route('cajas.movimientos', $caja->id) }}" class="btn btn-secondary">
                ← Volver
            </a>

        </div>


        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card shadow-sm">

            <div class="card-header">
                <strong>Nuevo egreso</strong>
            </div>

            <div class="card-body">

                <div class="alert alert-light border">

                    <strong>Saldo disponible:</strong>

                    <span class="text-success fw-bold">
                        Bs {{ number_format($caja->saldo, 2) }}
                    </span>

                </div>


                <form action="{{ route('cajas.egreso.store', $caja->id) }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Concepto
                        </label>

                        <input type="text" name="concepto" class="form-control" value="{{ old('concepto') }}"
                            placeholder="Ej.: Compra de materiales" required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Monto
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Bs
                            </span>

                            <input type="number" name="monto" class="form-control" step="0.01" min="0.01"
                                max="{{ $caja->saldo }}" value="{{ old('monto') }}" required>

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Observación
                        </label>

                        <textarea name="observacion" class="form-control" rows="3">{{ old('observacion') }}</textarea>

                    </div>


                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('cajas.movimientos', $caja->id) }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-danger">
                            ⬇️ Registrar Egreso
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>