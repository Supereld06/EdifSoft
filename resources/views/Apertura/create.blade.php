<x-app-layout>
    <x-slot name="header">
        <h3>Aperturar Mes</h3>
    </x-slot>

    <div class="container">
        <div class="card shadow p-4">
            <h4 class="mb-4">Nuevo Apertura de Mes</h4>

            <form method="POST" action="">
                @csrf

                <div class="mb-3">
                    <label class="form-label">MES</label>
                    <input type="text" name="mes" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">GESTION</label>
                    <input type="text" name="numero_departamento" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Aperturar Mes</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
            </form>
        </div>
    </div>
</x-app-layout>