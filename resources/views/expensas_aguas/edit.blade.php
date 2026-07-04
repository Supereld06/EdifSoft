<x-app-layout>

    <x-slot name="header">
        <h3>Editar Expensa de Agua</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('expensas_aguas.update', $expensa->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- DEPARTAMENTO --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Departamento</label>

                        <select class="form-control" disabled>
                            <option>
                                {{ $expensa->departamento->numero_departamento }}
                            </option>
                        </select>

                        <input type="hidden" name="departamento_id" value="{{ $expensa->departamento_id }}">
                    </div>

                    {{-- PROPIETARIO --}}
                    <div class="col-md-6 mb-3">
                        <label>Propietario</label>
                        <input type="text" class="form-control" readonly value="{{ $expensa->propietario->nombres }}">
                    </div>

                </div>

                {{-- APERTURA --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Mes / Gestión</label>

                        <select name="apertura_expensa_id" class="form-control" required>

                            @foreach($aperturas as $apertura)
                                <option value="{{ $apertura->id }}" {{ $apertura->id == $expensa->apertura_expensa_id ? 'selected' : '' }}>
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
                        <input type="number" step="0.01" name="lectura_anterior" id="lectura_anterior"
                            class="form-control" value="{{ $expensa->lectura_anterior }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Lectura Actual</label>
                        <input type="number" step="0.01" name="lectura_actual" id="lectura_actual" class="form-control"
                            value="{{ $expensa->lectura_actual }}">
                    </div>

                </div>

                {{-- CALCULOS --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Lectura a Pagar</label>
                        <input type="number" step="0.01" name="lectura_pagar" id="lectura_pagar" class="form-control"
                            value="{{ $expensa->lectura_pagar }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Prorrateo</label>
                        <input type="number" step="0.01" name="prorrateo" id="prorrateo" class="form-control"
                            value="{{ $expensa->prorrateo }}">
                    </div>

                </div>

                {{-- TOTAL --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Total</label>
                        <input type="number" step="0.01" id="total" class="form-control" value="{{ $expensa->total }}"
                            readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Saldo</label>
                        <input type="number" step="0.01" id="saldo" class="form-control" value="{{ $expensa->saldo }}"
                            readonly>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="mt-3">

                    <button class="btn btn-success">
                        Actualizar
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

        const lecturaAnterior = document.getElementById('lectura_anterior');
        const lecturaActual = document.getElementById('lectura_actual');
        const lecturaPagar = document.getElementById('lectura_pagar');
        const prorrateo = document.getElementById('prorrateo');
        const total = document.getElementById('total');
        const saldo = document.getElementById('saldo');

        lecturaAnterior.addEventListener('input', calcular);
        lecturaActual.addEventListener('input', calcular);
        prorrateo.addEventListener('input', calcular);

        function calcular() {

            let anterior = parseFloat(lecturaAnterior.value) || 0;
            let actual = parseFloat(lecturaActual.value) || 0;
            let precio = parseFloat(prorrateo.value) || 0;

            let consumo = actual - anterior;

            if (consumo < 0) consumo = 0;

            let totalCalc = consumo * precio;

            lecturaPagar.value = consumo.toFixed(2);
            total.value = totalCalc.toFixed(2);
            saldo.value = totalCalc.toFixed(2);
        }

    </script>

</x-app-layout>