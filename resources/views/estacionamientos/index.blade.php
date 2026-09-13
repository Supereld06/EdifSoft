<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 fw-bold">
                    <i class="bi bi-car-front-fill text-primary"></i>
                    Lista de Estacionamientos
                </h3>

                <small class="text-muted">
                    Administración de estacionamientos del edificio
                </small>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- BOTONES --}}
        <div class="d-flex flex-wrap gap-2 mb-3">

            <a href="{{ route('estacionamientos.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-circle me-1"></i>
                Registrar Estacionamiento

            </a>


            <a href="#" class="btn btn-success">

                <i class="bi bi-file-earmark-excel-fill me-1"></i>
                Exportar Excel

            </a>


            <a href="#" class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf-fill me-1"></i>
                Exportar PDF

            </a>

        </div>


        {{-- MENSAJE DE ÉXITO --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-3" role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- CARD PRINCIPAL --}}
        <div class="card border-0 shadow-sm overflow-hidden">


            {{-- CABECERA --}}
            <div class="card-header bg-white py-3 border-0">

                <div class="row align-items-center">


                    {{-- TÍTULO Y BUSCADOR --}}
                    <div class="col-lg-8">

                        <h5 class="mb-1 fw-bold">

                            <i class="bi bi-car-front-fill text-primary me-2"></i>

                            Estacionamientos registrados

                        </h5>


                        <small class="text-muted d-block mb-3">

                            Información de los estacionamientos

                        </small>


                        {{-- BUSCADOR --}}
                        <div class="input-group" style="max-width: 650px;">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search text-primary"></i>

                            </span>


                            <input type="text" id="buscarEstacionamiento" class="form-control"
                                placeholder="Buscar por tipo, número, ubicación o propietario..." autocomplete="off">


                            <button type="button" id="btnBuscarEstacionamiento" class="btn btn-primary" title="Buscar">

                                <i class="bi bi-search"></i>

                            </button>


                            <button type="button" id="limpiarBusquedaEstacionamiento" class="btn btn-secondary"
                                title="Limpiar">

                                <i class="bi bi-x-circle"></i>

                            </button>

                        </div>

                    </div>


                    {{-- CANTIDAD --}}
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.95rem;">

                            {{ $estacionamientos->total() }} registrados

                        </span>

                    </div>

                </div>

            </div>


            {{-- TABLA --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">


                    <thead class="table-dark">

                        <tr>

                            <th>Tipo</th>

                            <th>Número</th>

                            <th>Ubicación</th>

                            <th>Detalle</th>

                            <th>Propietario</th>

                            <th>Edificio</th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody id="tablaEstacionamientos">


                        @forelse($estacionamientos as $estacionamiento)


                            <tr class="fila-estacionamiento">


                                {{-- TIPO --}}
                                <td>

                                    <span class="badge bg-primary">

                                        {{ $estacionamiento->tipo_estacionamiento }}

                                    </span>

                                </td>


                                {{-- NÚMERO --}}
                                <td>

                                    <strong>

                                        <i class="bi bi-p-square text-primary me-1"></i>

                                        {{ $estacionamiento->numero_estacionamiento }}

                                    </strong>

                                </td>


                                {{-- UBICACIÓN --}}
                                <td>

                                    <i class="bi bi-geo-alt text-danger me-1"></i>

                                    {{ $estacionamiento->ubicacion ?? '-' }}

                                </td>


                                {{-- DETALLE --}}
                                <td>

                                    {{ $estacionamiento->detalle ?? '-' }}

                                </td>


                                {{-- PROPIETARIO --}}
                                <td>

                                    @if($estacionamiento->propietario)

                                        <div class="d-flex align-items-center">

                                            <span class="rounded-circle bg-primary text-white
                                                                 d-inline-flex align-items-center
                                                                 justify-content-center me-2"
                                                style="width: 32px; height: 32px;">

                                                <i class="bi bi-person-fill"></i>

                                            </span>


                                            <span>

                                                {{ $estacionamiento->propietario->nombres }}
                                                {{ $estacionamiento->propietario->apellido_paterno }}

                                            </span>

                                        </div>

                                    @else

                                        <span class="text-muted">

                                            <i class="bi bi-person-x me-1"></i>

                                            Sin propietario

                                        </span>

                                    @endif

                                </td>


                                {{-- EDIFICIO --}}
                                <td>

                                    <span class="badge bg-light text-dark border">

                                        <i class="bi bi-buildings me-1"></i>

                                        {{ $estacionamiento->edificio->nombre ?? '-' }}

                                    </span>

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">


                                    {{-- EDITAR --}}
                                    <a href="{{ route('estacionamientos.edit', $estacionamiento->id) }}"
                                        class="btn btn-sm btn-outline-info" title="Editar">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('estacionamientos.destroy', $estacionamiento->id) }}"
                                        method="POST" class="d-inline">

                                        @csrf

                                        @method('DELETE')


                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar este estacionamiento?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="7" class="text-center py-5">

                                    <i class="bi bi-car-front fs-1 text-muted"></i>


                                    <h6 class="mt-3 text-muted">

                                        No hay estacionamientos registrados

                                    </h6>


                                    <small class="text-muted">

                                        Registra un estacionamiento para comenzar.

                                    </small>

                                </td>

                            </tr>


                        @endforelse


                        {{-- SIN RESULTADOS DE BÚSQUEDA --}}
                        <tr id="sinResultadosEstacionamientos" style="display: none;">

                            <td colspan="7" class="text-center py-4">

                                <i class="bi bi-search fs-2 text-muted"></i>


                                <p class="mb-0 mt-2 text-muted">

                                    No se encontraron estacionamientos
                                    con esa búsqueda.

                                </p>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>


            {{-- PAGINACIÓN --}}
            @if($estacionamientos->hasPages())

                <div class="card-footer bg-white border-0 py-3">

                    <div class="d-flex justify-content-center">

                        {{ $estacionamientos->links() }}

                    </div>

                </div>

            @endif


        </div>

    </div>


    {{-- BUSCADOR --}}
    <script>

        function normalizarTexto(texto) {

            return texto
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .trim();

        }


        const inputBusqueda =
            document.getElementById('buscarEstacionamiento');


        const btnBuscar =
            document.getElementById('btnBuscarEstacionamiento');


        const btnLimpiar =
            document.getElementById('limpiarBusquedaEstacionamiento');


        const filas =
            document.querySelectorAll('.fila-estacionamiento');


        const sinResultados =
            document.getElementById('sinResultadosEstacionamientos');


        function buscarEstacionamientos() {

            const texto =
                normalizarTexto(inputBusqueda.value);


            let encontrados = 0;


            filas.forEach(function (fila) {

                const contenido =
                    normalizarTexto(fila.textContent);


                if (contenido.includes(texto)) {

                    fila.style.display = '';

                    encontrados++;

                } else {

                    fila.style.display = 'none';

                }

            });


            if (sinResultados) {

                sinResultados.style.display =
                    texto !== '' && encontrados === 0
                        ? ''
                        : 'none';

            }

        }


        btnBuscar.addEventListener('click', function () {

            buscarEstacionamientos();

        });


        inputBusqueda.addEventListener('keyup', function (event) {

            if (event.key === 'Enter') {

                buscarEstacionamientos();

            }

        });


        btnLimpiar.addEventListener('click', function () {

            inputBusqueda.value = '';


            filas.forEach(function (fila) {

                fila.style.display = '';

            });


            if (sinResultados) {

                sinResultados.style.display = 'none';

            }


            inputBusqueda.focus();

        });

    </script>


</x-app-layout>