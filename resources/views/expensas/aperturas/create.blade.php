<x-app-layout>

    <x-slot name="header">
        <h3>📅 Registrar Apertura de Expensas</h3>
    </x-slot>

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Se encontraron errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-calendar-plus"></i>
                    Nueva Apertura
                </h5>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('apertura-expensas.store') }}">

                    @csrf

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Mes
                            </label>

                            <input type="text" name="mes" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Gestión
                            </label>

                            <input type="number" name="gestion" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Edificio
                            </label>

                            <input type="text" class="form-control" value="{{ session('edificio_nombre') }}" readonly>

                            <input type="hidden" name="edificio_id" value="{{ session('edificio_id') }}">

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Saldo Inicial (Bs.)
                            </label>

                            <input type="number" step="0.01" name="saldo_inicial" value="0.00" class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Efectivo Inicial (Bs.)
                            </label>

                            <input type="number" step="0.01" name="efectivo_inicial" value="0.00" class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Factura de Agua (Bs.)
                            </label>

                            <input type="number" step="0.01" name="factura_agua" value="0.00" class="form-control"
                                required>

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Expensa Departamentos
                            </label>

                            <input type="number" step="0.01" name="expensa_departamentos" value="0.00"
                                class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Expensa Tiendas
                            </label>

                            <input type="number" step="0.01" name="expensa_tiendas" value="0.00" class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Expensa Parqueos
                            </label>

                            <input type="number" step="0.01" name="expensa_parqueo" value="0.00" class="form-control"
                                required>

                        </div>

                    </div>

                    <!-- FILA 4 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Prorrateo Agua
                            </label>

                            <input type="number" class="form-control bg-light" value="0.00" readonly>

                            <small class="text-muted">
                                Se calculará automáticamente cuando todas las lecturas estén registradas.
                            </small>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('apertura-expensas.index') }}" class="btn btn-secondary me-2">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle"></i>
                            Guardar Apertura

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>