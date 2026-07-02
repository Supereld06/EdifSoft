<x-app-layout>

    <x-slot name="header">
        <h3>Editar Recibo Estacionamiento</h3>
    </x-slot>

    <div class="container">

        <div class="card p-4">

            <form action="{{ route('recibos_estacionamientos.update', $recibo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Monto</label>
                    <input type="number" name="monto" value="{{ $recibo->monto }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tipo Pago</label>
                    <select name="tipo_pago" class="form-control">
                        <option {{ $recibo->tipo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option {{ $recibo->tipo_pago == 'Deposito' ? 'selected' : '' }}>Deposito</option>
                        <option {{ $recibo->tipo_pago == 'QR' ? 'selected' : '' }}>QR</option>
                    </select>
                </div>

                <button class="btn btn-primary">Actualizar</button>

            </form>

        </div>

    </div>

</x-app-layout>