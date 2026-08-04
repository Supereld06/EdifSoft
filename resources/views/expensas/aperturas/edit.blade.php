<x-app-layout>

    <x-slot name="header">
        <h3>✏️ Editar Apertura de Expensas</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">

                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Modificar Apertura
                </h5>

            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('apertura-expensas.update', $apertura_expensa) }}">

                    @csrf
                    @method('PUT')

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Mes
                            </label>

                            <input type="text" name="mes" class="form-control" value="{{ $apertura_expensa->mes }}"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Gestión
                            </label>

                            <input type="number" name="gestion" class="form-control"
                                value="{{ $apertura_expensa->gestion }}" required>

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

                            <input type="number" step="0.01" name="saldo_inicial" class="form-control"
                                value="{{ $apertura_expensa->saldo_inicial }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Efectivo Inicial (Bs.)
                            </label>

                            <input type="number" step="0.01" name="efectivo_inicial" class="form-control"
                                value="{{ $apertura_expensa->efectivo_inicial }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Factura Agua (Bs.)
                            </label>

                            <input type="number" step="0.01" name="factura_agua" class="form-control"
                                value="{{ $apertura_expensa->factura_agua }}" required>

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Expensa Departamentos (Bs.)
                            </label>

                            <input type="number" step="0.01" name="expensa_departamentos" class="form-control"
                                value="{{ $apertura_expensa->expensa_departamentos }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Expensa Tiendas (Bs.)
                            </label>

                            <input type="number" step="0.01" name="expensa_tiendas" class="form-control"
                                value="{{ $apertura_expensa->expensa_tiendas }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Expensa Parqueos (Bs.)
                            </label>

                            <input type="number" step="0.01" name="expensa_parqueo" class="form-control"
                                value="{{ $apertura_expensa->expensa_parqueo }}" required>

                        </div>

                    </div>

                    <!-- FILA 4 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Prorrateo Agua
                            </label>

                            <input type="number" step="0.0001" name="prorrateo_agua" class="form-control"
                                value="{{ $apertura_expensa->prorrateo_agua }}" readonly>

                            <small class="text-muted">
                                Se calcula automáticamente desde Lecturas de Agua.
                            </small>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('apertura-expensas.index') }}" class="btn btn-secondary me-2">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-warning">

                            <i class="bi bi-check-circle"></i>
                            Actualizar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>