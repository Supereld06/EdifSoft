<x-app-layout>

    <x-slot name="header">
        <h3>Recibos Estacionamientos - Nuevo</h3>
    </x-slot>

    <div class="container">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow p-4">

            <form action="{{ route('recibos_estacionamientos.store') }}" method="POST">
                @csrf

                {{-- NÚMERO --}}
                <div class="mb-3">
                    <label>Número</label>
                    <input type="text" name="numero" value="{{ $numero }}" class="form-control bg-light fw-bold"
                        readonly>
                </div>

                {{-- FECHA --}}
                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>

                {{-- PROPIETARIO --}}
                <div class="mb-3">
                    <label>Propietario</label>

                    <select name="propietario_id" id="propietario" class="form-control" required>
                        <option value="">Seleccione</option>

                        @foreach($propietarios as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nombres }} {{ $p->apellido_paterno }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- EXPENSAS --}}
                <div class="mb-3">
                    <label>Expensa Estacionamiento</label>

                    <select name="expensa_estacionamiento_id" id="expensa" class="form-control" required>
                        <option value="">Seleccione expensa</option>
                    </select>
                </div>

                {{-- MONTO --}}
                <div class="mb-3">
                    <label>Monto</label>
                    <input type="number" step="0.01" name="monto" id="monto" class="form-control" required>
                </div>

                {{-- MES --}}
                <div class="mb-3">
                    <label>Mes</label>
                    <input type="text" id="mes" class="form-control" readonly>
                </div>

                {{-- GESTIÓN --}}
                <div class="mb-3">
                    <label>Gestión</label>
                    <input type="text" id="gestion" class="form-control" readonly>
                </div>

                {{-- MONEDA --}}
                <div class="mb-3">
                    <label>Moneda</label>
                    <select name="moneda" class="form-control">
                        <option>Bolivianos</option>
                        <option>Dolares</option>
                    </select>
                </div>

                {{-- TIPO PAGO --}}
                <div class="mb-3">
                    <label>Tipo Pago</label>
                    <select name="tipo_pago" class="form-control">
                        <option>Efectivo</option>
                        <option>Deposito</option>
                        <option>QR</option>
                    </select>
                </div>

                {{-- DEPÓSITO --}}
                <div class="mb-3">
                    <label>Número Depósito</label>
                    <input type="text" name="numero_deposito" class="form-control">
                </div>

                <button class="btn btn-success" type="submit">Guardar</button>
                <button class="btn btn-secondary" type="button" onclick="window.history.back();">
                    Cancelar
                </button>

            </form>

        </div>
    </div>

    {{-- JS (MISMO ESTILO QUE TIENDAS) --}}
    <script>

        document.getElementById('propietario')
            .addEventListener('change', function () {

                let propietarioId = this.value;

                fetch('/obtener-expensas-estacionamientos/' + propietarioId)

                    .then(res => res.json())
                    .then(data => {

                        let expensa = document.getElementById('expensa');

                        expensa.innerHTML = '';

                        if (data.length == 0) {

                            expensa.innerHTML = `
                                <option value="">
                                    No hay expensas pendientes
                                </option>
                            `;
                            return;
                        }

                        data.forEach(item => {

                            expensa.innerHTML += `
                                <option
                                    value="${item.id}"
                                    data-saldo="${item.saldo}"
                                    data-mes="${item.apertura.mes}"
                                    data-gestion="${item.apertura.gestion}"
                                >
                                    Estacionamiento: ${item.estacionamiento.numero_estacionamiento}
                                    |
                                    ${item.apertura.mes} - ${item.apertura.gestion}
                                    |
                                    Saldo: ${item.saldo}
                                </option>
                            `;
                        });

                        cargarDatos();
                    });

            });

        function cargarDatos() {

            let select = document.getElementById('expensa');

            if (select.selectedIndex == -1) return;

            let option = select.options[select.selectedIndex];

            document.getElementById('monto').value =
                option.getAttribute('data-saldo');

            document.getElementById('mes').value =
                option.getAttribute('data-mes');

            document.getElementById('gestion').value =
                option.getAttribute('data-gestion');
        }

        document.getElementById('expensa')
            .addEventListener('change', cargarDatos);

    </script>

</x-app-layout>