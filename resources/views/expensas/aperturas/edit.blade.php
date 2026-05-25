<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Apertura
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('apertura-expensas.update', $apertura_expensa) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">
                            Mes *
                        </label>
                        <input type="text" name="mes" class="form-control" value="{{ $apertura_expensa->mes }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Gestión *
                        </label>
                        <input type="number" name="gestion" class="form-control"
                            value="{{ $apertura_expensa->gestion }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Saldo Inicial *
                        </label>
                        <input type="number" step="0.01" name="saldo_inicial" class="form-control"
                            value="{{ $apertura_expensa->saldo_inicial }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Efectivo Inicial *
                        </label>
                        <input type="number" step="0.01" name="efectivo_inicial" class="form-control"
                            value="{{ $apertura_expensa->efectivo_inicial }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Expensa Departamentos Monto *
                        </label>
                        <input type="number" step="0.01" name="expensa_departamentos" value="{{ $apertura_expensa->expensa_departamentos }}" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Expensa Tiendas Monto *
                        </label>
                        <input type="number" step="0.01" name="expensa_tiendas" value="{{ $apertura_expensa->expensa_tiendas }}" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Expensa Parqueo Monto *
                        </label>
                        <input type="number" step="0.01" name="expensa_parqueo" value="{{ $apertura_expensa->expensa_parqueo }}" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Monto Factura Agua *
                        </label>
                        <input type="number" step="0.01" name="factura_agua" value="{{ $apertura_expensa->factura_agua }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Prorrateo Agua *
                        </label>
                        <input type="number" step="0.01" name="prorrateo_agua" value="{{ $apertura_expensa->prorrateo_agua }}" class="form-control"
                            required>
                    </div>

                    <input type="hidden" name="edificio_id" value="{{ $edificio_id }}">

                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>

                    <a href="{{ route('apertura-expensas.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>