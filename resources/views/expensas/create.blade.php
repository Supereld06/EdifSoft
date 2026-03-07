<x-app-layout>
    <x-slot name="header">
        <h3>Registro de Pagos</h3>
    </x-slot>

    <div class="container">
        <div class="card shadow p-4">
            <h4 class="mb-4">Generar Recibo</h4>

            <form method="POST" action="">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Numero de Recibo</label>
                    <input type="text" name="mes" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Recibimos de</label>
                    <input type="text" name="mes" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Monto Total</label>
                    <input type="text" name="mes" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo Moneda</label>
                    <select name="" id=""><option value="">Bolivianos</option>
                <option value="">Dolares</option></select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Concepto</label>
                    <input type="text" name="mes" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="mes" class="form-control" required>
                </div>


                <button type="submit" class="btn btn-success">Registrar Recibo</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
            </form>
        </div>
    </div>
</x-app-layout>