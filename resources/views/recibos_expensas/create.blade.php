<x-app-layout>

    <x-slot name="header">
        <h3>Recibos Expensas</h3>
    </x-slot>

    <div class="container">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="card shadow p-4">

            <form action="{{ route('recibos_expensas.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Número</label>
                    <input type="text"
                        name="numero"
                        class="form-control"
                        value="{{ $numero }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date"
                        name="fecha"
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label>Propietario</label>

                    <select name="propietario_id"
                        id="propietario"
                        class="form-control"
                        required>

                        <option value="">Seleccione un propietario</option>

                        @foreach($propietarios as $p)

                        <option value="{{ $p->id }}">
                            {{ $p->nombres }}
                            {{ $p->apellido_paterno }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Expensa</label>

                    <select name="expensa_id"
                        id="expensa"
                        class="form-control"
                        required>

                        <option value="">
                            Seleccione una expensa
                        </option>

                    </select>

                </div>

                <div class="mb-3">
                    <label>Monto a pagar</label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="monto"
                        id="monto"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Mes</label>

                    <input type="text"
                        id="mes"
                        name="mes"
                        class="form-control"
                        readonly>
                </div>

                <div class="mb-3">
                    <label>Gestión</label>

                    <input type="text"
                        id="gestion"
                        name="gestion"
                        class="form-control"
                        readonly>
                </div>

                <div class="mb-3">

                    <label>Moneda</label>

                    <select name="moneda"
                        class="form-control">

                        <option>Bolivianos</option>
                        <option>Dolares</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Tipo Pago</label>

                    <select name="tipo_pago"
                        class="form-control">

                        <option>Efectivo</option>
                        <option>Deposito</option>
                        <option>QR</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Número Depósito</label>

                    <input type="text"
                        name="numero_deposito"
                        class="form-control">

                </div>

                <button class="btn btn-success">
                    Guardar
                </button>

                <button class="btn btn-secondary"
                    type="button"
                    onclick="history.back()">

                    Cancelar

                </button>

            </form>

        </div>

    </div>

    <script>
        document.getElementById('propietario').addEventListener('change', function() {

            let propietarioId = this.value;

            let expensa = document.getElementById('expensa');

            expensa.innerHTML = '<option>Cargando...</option>';

            fetch('/obtener-expensas/' + propietarioId)

                .then(response => response.json())

                .then(data => {

                    expensa.innerHTML = '';

                    if (data.length === 0) {

                        expensa.innerHTML =
                            '<option value="">No hay expensas pendientes</option>';

                        document.getElementById('monto').value = '';
                        document.getElementById('mes').value = '';
                        document.getElementById('gestion').value = '';

                        return;
                    }

                    data.forEach(item => {

                        expensa.innerHTML += `
                    <option
                        value="${item.id}"
                        data-saldo="${item.saldo}"
                        data-mes="${item.apertura.mes}"
                        data-gestion="${item.apertura.gestion}">

                        Departamento ${item.departamento.numero_departamento}
                        | ${item.apertura.mes}
                        ${item.apertura.gestion}
                        | Saldo Bs. ${item.saldo}

                    </option>
                `;

                    });

                    cargarDatos();

                })

                .catch(error => {

                    console.log(error);

                });

        });

        function cargarDatos() {

            let select = document.getElementById('expensa');

            if (select.selectedIndex < 0) {
                return;
            }

            let option = select.options[select.selectedIndex];

            document.getElementById('monto').value =
                option.dataset.saldo;

            document.getElementById('monto').max =
                option.dataset.saldo;

            document.getElementById('mes').value =
                option.dataset.mes;

            document.getElementById('gestion').value =
                option.dataset.gestion;

        }

        document.getElementById('expensa')
            .addEventListener('change', cargarDatos);
    </script>

</x-app-layout>