<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Apertura
        </h2>
    </x-slot>

    <div class="container py-4">

        <div class="card shadow">

            <div class="card-body">

                <form method="POST" action="{{ route('apertura-expensas.store') }}">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Mes
                        </label>

                        <input type="text" name="mes" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Gestión
                        </label>

                        <input type="number" name="gestion" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Saldo Inicial
                        </label>

                        <input type="number" step="0.01" name="saldo_inicial" class="form-control" required>

                    </div>

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