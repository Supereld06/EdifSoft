<x-app-layout>

    <x-slot name="header">
        <h3>Generar Recibo</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('recibos_expensas.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Número</label>

                    <input type="text" name="numero" class="form-control">

                </div>

                <div class="mb-3">

                    <label>Fecha</label>

                    <input type="date" name="fecha" class="form-control">

                </div>

                <div class="mb-3">

                    <label>Propietario</label>

                    <select name="propietario_id" id="propietario" class="form-control">

                        <option value="">
                            Seleccione
                        </option>

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

                    <select name="expensa_id" id="expensa" class="form-control">

                    </select>

                </div>

                <div class="mb-3">

                    <label>Monto</label>

                    <input type="text" name="monto" id="monto" class="form-control" readonly>

                </div>

                <div class="mb-3">

                    <label>Mes</label>

                    <input type="text" id="mes" class="form-control" readonly>

                </div>

                <div class="mb-3">

                    <label>Gestión</label>

                    <input type="text" id="gestion" class="form-control" readonly>

                </div>

                <div class="mb-3">

                    <label>Moneda</label>

                    <select name="moneda" class="form-control">

                        <option>Bolivianos</option>

                        <option>Dolares</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Tipo Pago</label>

                    <select name="tipo_pago" class="form-control">

                        <option>Efectivo</option>

                        <option>Deposito</option>

                        <option>QR</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Número Depósito</label>

                    <input type="text" name="numero_deposito" class="form-control">

                </div>

                <button class="btn btn-primary">

                    Guardar

                </button>

            </form>

        </div>

    </div>

    <script>

        document.getElementById('propietario')
            .addEventListener('change', function () {

                let propietarioId = this.value;

                fetch('/obtener-expensas/' + propietarioId)

                    .then(response => response.json())

                    .then(data => {

                        let expensa = document.getElementById('expensa');

                        expensa.innerHTML = '';

                        /*
                        |--------------------------------------------------------------------------
                        | SI NO HAY EXPENSAS
                        |--------------------------------------------------------------------------
                        */

                        if (data.length == 0) {

                            expensa.innerHTML = `
                <option value="">
                    No hay expensas pendientes
                </option>
            `;

                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | CARGAR EXPENSAS
                        |--------------------------------------------------------------------------
                        */

                        data.forEach(item => {

                            expensa.innerHTML += `

                <option
                    value="${item.id}"

                    data-monto="${item.saldo}"

                    data-mes="${item.apertura.mes}"

                    data-gestion="${item.apertura.gestion}">

                    Departamento:
                    ${item.departamento.numero_departamento}

                    |

                    ${item.apertura.mes}
                    -
                    ${item.apertura.gestion}

                    |

                    Saldo:
                    ${item.saldo}

                </option>

            `;
                        });

                        cargarDatos();

                    })

                    .catch(error => {

                        console.log(error);

                    });

            });

        /*
        |--------------------------------------------------------------------------
        | AUTOCOMPLETAR DATOS
        |--------------------------------------------------------------------------
        */

        function cargarDatos() {

            let select =
                document.getElementById('expensa');

            /*
            |--------------------------------------------------------------------------
            | VALIDAR OPCIONES
            |--------------------------------------------------------------------------
            */

            if (select.selectedIndex == -1) {
                return;
            }

            let option =
                select.options[select.selectedIndex];

            document.getElementById('monto').value =
                option.getAttribute('data-monto');

            document.getElementById('mes').value =
                option.getAttribute('data-mes');

            document.getElementById('gestion').value =
                option.getAttribute('data-gestion');
        }

        /*
        |--------------------------------------------------------------------------
        | CAMBIO DE EXPENSA
        |--------------------------------------------------------------------------
        */

        document.getElementById('expensa')
            .addEventListener('change', cargarDatos);

    </script>
</x-app-layout>