<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Apertura
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('apertura-expensas.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            Mes *
                        </label>
                        <input type="text" name="mes" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Gestión *
                        </label>
                        <input type="number" name="gestion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Saldo Inicial *
                        </label>
                        <input type="number" step="0.01" name="saldo_inicial" value="0,00" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Efectivo Inicial *
                        </label>
                        <input type="number" step="0.01" name="efectivo_inicial" value="0,00" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Expensa Departamentos Monto *
                        </label>
                        <input type="number" step="0.01" name="expensa_departamentos" value="0,00" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Expensa Tiendas Monto *
                        </label>
                        <input type="number" step="0.01" name="expensa_tiendas" value="0,00" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Expensa Parqueo Monto *
                        </label>
                        <input type="number" step="0.01" name="expensa_parqueo" value="0,00" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Monto Factura Agua *
                        </label>
                        <input type="number" step="0.01" name="factura_agua" value="0,00" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Prorrateo Agua *
                        </label>
                        <input type="number" step="0.01" name="prorrateo_agua" value="0,00" class="form-control"
                            required>
                    </div>

                    <input type="hidden" name="edificio_id" value="{{ $edificio_id }}">

                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>

                    <a href="{{ route('apertura-expensas.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>