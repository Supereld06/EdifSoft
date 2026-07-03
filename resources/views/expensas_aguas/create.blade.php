<x-app-layout>

    <x-slot name="header">
        <h3>Nueva Expensa de Agua</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('expensas_aguas.store') }}" method="POST">

                @csrf

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

                    <div class="col-md-6 mb-3">

                        <label>Propietario</label>

                        <input type="text" id="propietario" class="form-control" readonly>

                    </div>



                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Mes</label>

                        <select name="apertura_expensa_id" class="form-control" required>

                            <option value="">
                                Seleccione...
                            </option>

                            @foreach($aperturas as $apertura)

                                <option value="{{ $apertura->id }}">

                                    {{ $apertura->mes }}
                                    -
                                    {{ $apertura->gestion }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Lectura Anterior</label>

                        <input type="number" step="0.01" class="form-control" value="" >

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Lectura Actual</label>

                        <input type="number" step="0.01" class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Lectura a Pagar</label>

                        <input type="number" step="0.01" class="form-control">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Prorrateo</label>

                        <input type="number" step="0.01" class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Pago</label>

                        <input type="number" step="0.01" class="form-control">

                    </div>

                </div>

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


    <script>
        document.getElementById('departamento_id').addEventListener('change', function () {

            let id = this.value;

            if (!id) return;

            fetch(`/expensas-aguas/departamento/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById('propietario').value = data.propietario;

                });

        });
    </script>
</x-app-layout>