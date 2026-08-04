<x-app-layout>

    <x-slot name="header">
        <h3>
            Lecturas de Agua
            <small class="text-muted">
                {{ $apertura->mes }} / {{ $apertura->gestion }}
            </small>
        </h3>
    </x-slot>

    <div class="container py-4">

        <div class="mb-3">
            <form action="{{ route('expensas_aguas.calcularProrrateo', $apertura->id) }}" method="POST">

                @csrf

                <button class="btn btn-success">

                    <i class="bi bi-calculator"></i>

                    Calcular Prorrateo

                </button>
            </form>
            <a href="{{ route('pago-expensas.index') }}" class="btn btn-secondary">
                Atras
            </a>
                <div class="text-end mt-2">

                    @if($apertura->prorrateo_agua > 0)

                        <div>

                            <span class="badge bg-success fs-6">

                                <i class="bi bi-calculator"></i>

                                Prorrateo:
                                 {{ number_format($apertura->prorrateo_agua, 4) }}

                            </span>

                        </div>

                    @else

                        <div>

                            <span class="badge bg-warning text-dark fs-6">

                                <i class="bi bi-exclamation-circle"></i>

                                Prorrateo aún no definido

                            </span>

                        </div>

                    @endif

                    <div class="mt-2">

                        <span class="badge bg-info fs-6">

                            <i class="bi bi-droplet-half"></i>

                            Consumo Total:
                            {{ number_format($consumoTotal, 2) }} m³

                        </span>

                    </div>

                </div>

       



        </div>

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

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-striped table-hover">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Departamento</th>
                            <th>Propietario</th>
                            <th>Lectura Anterior</th>
                            <th>Lectura Actual</th>
                            <th>Consumo</th>
                            <th>Estado</th>
                            <th width="120">Acción</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($expensas as $expensa)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $expensa->departamento->numero_departamento }}
                                </td>

                                <td>
                                    {{ $expensa->propietario->nombres }} {{ $expensa->propietario->apellido_paterno }}
                                </td>

                                <td class="text-center">
                                    {{ number_format($expensa->lectura_anterior, 2) }}
                                </td>

                                <td class="text-center">

                                    @if($expensa->lectura_actual != 0)

                                        <strong class="text-primary">
                                            {{ number_format($expensa->lectura_actual, 2) }}
                                        </strong>

                                    @else

                                        <span class="text-danger">
                                            Sin lectura
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    @if($expensa->lectura_pagar)

                                        {{ number_format($expensa->lectura_pagar, 2) }}

                                    @else

                                        --

                                    @endif

                                </td>

                                <td class="text-center">

                                    @if($expensa->lectura_actual != 0)

                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i>
                                            Leído
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock"></i>
                                            Pendiente
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <button class="btn btn-info btn-sm btnLectura" data-bs-toggle="modal"
                                        data-bs-target="#modalLectura" data-id="{{ $expensa->id }}"
                                        data-departamento="{{ $expensa->departamento->numero_departamento }}"
                                        data-propietario="{{ $expensa->propietario->nombres }}"
                                        data-anterior="{{ $expensa->lectura_anterior }}"
                                        data-actual="{{ $expensa->lectura_actual }}">

                                        @if($expensa->lectura_actual != 0)

                                            <i class="bi bi-pencil-square"></i>
                                            Editar

                                        @else

                                            <i class="bi bi-droplet"></i>
                                            Registrar

                                        @endif

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center">

                                    <div class="alert alert-warning mb-0">

                                        No existen registros para este mes.

                                    </div>

                                </td>

                            </tr>


                        @endforelse

                    </tbody>

                </table>


                <!-- Modal Lectura -->
                <div class="modal fade" id="modalLectura" tabindex="-1">

                    <div class="modal-dialog">

                        <form id="formLectura" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="modal-content">

                                <div class="modal-header bg-primary text-white">

                                    <h5 class="modal-title">

                                        Registrar Lectura

                                    </h5>

                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">

                                        <label>Departamento</label>

                                        <input type="text" id="departamento" class="form-control" readonly>

                                    </div>

                                    <div class="mb-3">

                                        <label>Propietario</label>

                                        <input type="text" id="propietario" class="form-control" readonly>

                                    </div>

                                    <div class="mb-3">

                                        <label>Lectura anterior</label>

                                        <input type="number" step="0.01" name="lectura_anterior" id="lectura_anterior"
                                            class="form-control">

                                    </div>

                                    <div class="mb-3">

                                        <label>Lectura actual</label>

                                        <input type="number" step="0.01" name="lectura_actual" id="lectura_actual"
                                            class="form-control">

                                    </div>

                                    <div class="mb-3">

                                        <label>Consumo</label>

                                        <input type="number" step="0.01" name="lectura_pagar" id="lectura_pagar"
                                            class="form-control" readonly>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                        Cancelar

                                    </button>

                                    <button type="submit" class="btn btn-success">

                                        <i class="bi bi-check-circle"></i>
                                        Guardar

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>

        document.querySelectorAll(".btnLectura").forEach(function (boton) {

            boton.addEventListener("click", function () {

                let id = this.dataset.id;

                document.getElementById("departamento").value = this.dataset.departamento;

                document.getElementById("propietario").value = this.dataset.propietario;

                document.getElementById("lectura_anterior").value = this.dataset.anterior;

                document.getElementById("lectura_actual").value = this.dataset.actual;

                calcular();

                let url = "{{ url('/expensas-aguas/actualizar-lectura') }}/" + id;

                document.getElementById("formLectura").action = url;

            });

        });

        function calcular() {

            let anterior = parseFloat(document.getElementById("lectura_anterior").value) || 0;

            let actual = parseFloat(document.getElementById("lectura_actual").value) || 0;

            let consumo = actual - anterior;

            if (consumo < 0) {

                consumo = 0;

            }

            document.getElementById("lectura_pagar").value = consumo;

        }

        document.getElementById("lectura_anterior")
            .addEventListener("keyup", calcular);

        document.getElementById("lectura_actual")
            .addEventListener("keyup", calcular);

        document.getElementById("lectura_anterior")
            .addEventListener("change", calcular);

        document.getElementById("lectura_actual")
            .addEventListener("change", calcular);

    </script>

</x-app-layout>