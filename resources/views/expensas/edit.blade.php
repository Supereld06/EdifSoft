<x-app-layout>

    <x-slot name="header">
        <h3>Editar Expensa</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form method="POST" action="{{ route('expensas.update', $expensa) }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Total</label>
                    <input type="number" step="0.01" name="total" value="{{ $expensa->total }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Pagado</label>
                    <input type="number" step="0.01" name="pagado" value="{{ $expensa->pagado }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    Actualizar
                </button>

                <button class="btn btn-secondary" type="button" onclick="window.history.back()">
                    Cancelar
                </button>

            </form>

        </div>

    </div>

</x-app-layout>