<x-app-layout>

    <x-slot name="header">
        <h3>Nueva Expensa de Agua</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('expensas_aguas.store') }}" method="POST">
                @csrf

                {{-- DEPARTAMENTO --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Departamento</label>

                        <select name="departamento_id" id="departamento_id" class="form-control" required>
                            <option value="">Seleccione...</option>

                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">
                                    {{ $departamento->numero_departamento }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- PROPIETARIO --}}
                    <div class="col-md-6 mb-3">
                        <label>Propietario</label>
                        <input type="text" id="propietario" class="form-control" readonly>
                        <input type="hidden" name="propietario_id" id="propietario_id">
                    </div>

                </div>

                {{-- APERTURA --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Mes / Gestión</label>

                        <select name="apertura_expensa_id" id="apertura_expensa_id" class="form-control"
                            required>
                        <option value="">Seleccione...</option>

                        @foreach($aperturas as $apertura)
                            <option value="{{ $apertura->id }}">
                                {{ $apertura->mes }} - {{ $apertura->gestion }}
                            </option>
                        @endforeach
                        </select>
                    </div>

                </div>

                {{-- LECTURAS --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Lectura Anterior</label>
                        <input type="number" step="0.01" class="form-control" name="lectura_anterior"
                            id="lectura_anterior" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Lectura Actual</label>
                        <input type="number" step="0.01" class="form-control" name="lectura_actual" id="lectura_actual"
                            required>
                    </div>

                </div>

                {{-- CALCULOS --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Lectura a Pagar</label>
                        <input type="number" step="0.01" class="form-control" name="lectura_pagar" id="lectura_pagar" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Prorrateo</label>
                        <input type="number" step="0.01" class="form-control" id="prorrateo" name="prorrateo" >
                    </div>

                </div>

                {{-- TOTAL --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Total</label>
                        <input type="number" step="0.01" class="form-control" id="total" readonly>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="mt-3">

                    <button class="btn btn-success">
                        Guardar
                    </button>

                    <a href="{{ route('expensas_aguas.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

    {{-- JAVASCRIPT --}}
    <script>

        const departamento = document.getElementById('departamento_id');
        const propietario = document.getElementById('propietario');
        const propietario_id = document.getElementById('propietario_id');

        const lecturaAnterior = document.getElementById('lectura_anterior');
        const lecturaActual = document.getElementById('lectura_actual');
        const lecturaPagar = document.getElementById('lectura_pagar');
        const prorrateo = document.getElementById('prorrateo');
        const total = document.getElementById('total');
        const apertura = document.getElementById('apertura_expensa_id');

        // CARGAR DATOS DEL DEPARTAMENTO
        departamento.addEventListener('change', function () {

            if (!this.value) return;

            fetch('/expensas-aguas/departamento/' + this.value)
                .then(res => res.json())
                .then(data => {

                    propietario.value = data.propietario;
                    propietario_id.value = data.propietario_id;

                    if (data.existe_lectura) {

                        lecturaAnterior.value = data.lectura_anterior;
                        lecturaAnterior.readOnly = true;

                    } else {

                        lecturaAnterior.value = '';
                        lecturaAnterior.readOnly = false;
                        lecturaAnterior.focus();
                    }

                    calcular();

                });

        });

        // EVENTOS DE CÁLCULO
        lecturaAnterior.addEventListener('input', calcular);
        lecturaActual.addEventListener('input', calcular);
        prorrateo.addEventListener('input', calcular);

        apertura.addEventListener('change', function () {

            if (!this.value) return;

            fetch('/expensas-aguas/apertura/' + this.value)
                .then(res => res.json())
                .then(data => {

                    prorrateo.value = data.prorrateo_agua;

                    calcular(); // recalcula automáticamente

                });

        });

        function calcular() {

            let anterior = parseFloat(lecturaAnterior.value) || 0;
            let actual = parseFloat(lecturaActual.value) || 0;
            let precio = parseFloat(prorrateo.value) || 0;

            let consumo = actual - anterior;

            if (consumo < 0) consumo = 0;

            lecturaPagar.value = consumo.toFixed(2);
            total.value = (consumo * precio).toFixed(2);
        }

    </script>

</x-app-layout>