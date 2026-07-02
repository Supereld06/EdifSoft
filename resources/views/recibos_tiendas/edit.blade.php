<x-app-layout>

    <x-slot name="header">
        <h3>Editar Recibo Tienda</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('recibos_tiendas.update', $recibo->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Monto</label>
                    <input type="number" step="0.01" name="monto" value="{{ $recibo->monto }}" class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Tipo Pago</label>
                    <select name="tipo_pago" class="form-control">

                        <option value="Efectivo" {{ $recibo->tipo_pago == 'Efectivo' ? 'selected' : '' }}>
                            Efectivo
                        </option>

                        <option value="Deposito" {{ $recibo->tipo_pago == 'Deposito' ? 'selected' : '' }}>
                            Deposito
                        </option>

                        <option value="QR" {{ $recibo->tipo_pago == 'QR' ? 'selected' : '' }}>
                            QR
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>Número Depósito</label>
                    <input type="text" name="numero_deposito" value="{{ $recibo->numero_deposito }}"
                        class="form-control">
                </div>

                <button class="btn btn-success" type="submit">
                    Actualizar
                </button>

                <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                    Cancelar
                </button>

            </form>

        </div>

    </div>

</x-app-layout>