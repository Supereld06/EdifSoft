<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="mb-1 fw-bold">

                    <i class="bi bi-shop-window text-primary"></i>

                    Lista de Tiendas

                </h3>

                <small class="text-muted">

                    Administración de tiendas del edificio

                </small>

            </div>

        </div>

    </x-slot>


    <div class="container-fluid py-4 px-4">


        {{-- BOTONES --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>

                {{-- REGISTRAR --}}
                <a href="{{ route('tiendas.create') }}" class="btn btn-primary shadow-sm">

                    <i class="bi bi-shop-window"></i>

                    Registrar Tienda

                </a>


                {{-- EXCEL --}}
                <a href="#" class="btn btn-success shadow-sm">

                    <i class="bi bi-file-earmark-excel-fill"></i>

                    Exportar Excel

                </a>


                {{-- PDF --}}
                <a href="#" class="btn btn-danger shadow-sm">

                    <i class="bi bi-file-earmark-pdf-fill"></i>

                    Exportar PDF

                </a>

            </div>


            <div class="text-muted">

                <i class="bi bi-info-circle"></i>

                Gestión de tiendas

            </div>

        </div>


        {{-- MENSAJE DE ÉXITO --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- TARJETA PRINCIPAL --}}
        <div class="card border-0 shadow-sm overflow-hidden">


            {{-- CABECERA --}}
            <div class="card-header bg-white py-3 border-0">

                <div class="row align-items-center">


                    {{-- TÍTULO Y BUSCADOR --}}
                    <div class="col-lg-8">

                        <h5 class="mb-1 fw-bold">

                            <i class="bi bi-shop text-primary me-2"></i>

                            Tiendas registradas

                        </h5>


                        <small class="text-muted d-block mb-3">

                            Información de las tiendas

                        </small>


                        {{-- BUSCADOR --}}
                        <div class="input-group" style="max-width: 650px;">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search text-primary"></i>

                            </span>


                            <input type="text" id="buscarTienda" class="form-control"
                                placeholder="Buscar por tipo, número, ubicación o propietario..." autocomplete="off">


                            <button type="button" id="btnBuscarTienda" class="btn btn-primary" title="Buscar">

                                <i class="bi bi-search"></i>

                            </button>


                            <button type="button" id="limpiarBusquedaTienda" class="btn btn-secondary" title="Limpiar">

                                <i class="bi bi-x-circle"></i>

                            </button>

                        </div>

                    </div>


                    {{-- CANTIDAD --}}
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.95rem;">

                            {{ $tiendas->total() }} registradas

                        </span>

                    </div>

                </div>

            </div>


            {{-- TABLA --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0" id="tablaTiendas">

                    <thead class="table-dark">

                        <tr>

                            <th class="px-4">
                                Tipo
                            </th>

                            <th>
                                Número
                            </th>

                            <th>
                                Ubicación
                            </th>

                            <th>
                                Detalles
                            </th>

                            <th>
                                Propietario
                            </th>

                            <th>
                                Edificio
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($tiendas as $tienda)

                            @if($tienda->edificio_id == session('edificio_id'))

                                <tr class="fila-tienda">


                                    {{-- TIPO --}}
                                    <td class="px-4">

                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">

                                            <i class="bi bi-shop me-1"></i>

                                            {{ $tienda->tipo_tienda }}

                                        </span>

                                    </td>


                                    {{-- NÚMERO --}}
                                    <td>

                                        <span class="fw-semibold numero-tienda">

                                            <i class="bi bi-hash text-primary"></i>

                                            {{ $tienda->numero_tienda }}

                                        </span>

                                    </td>


                                    {{-- UBICACIÓN --}}
                                    <td>

                                        <span class="text-muted ubicacion-tienda">

                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>

                                            {{ $tienda->ubicacion }}

                                        </span>

                                    </td>


                                    {{-- DETALLES --}}
                                    <td>

                                        @if($tienda->detalles_tienda)

                                            <span class="detalles-tienda">

                                                {{ $tienda->detalles_tienda }}

                                            </span>

                                        @else

                                            <span class="text-muted">

                                                Sin detalles

                                            </span>

                                        @endif

                                    </td>


                                    {{-- PROPIETARIO --}}
                                    <td>

                                        @if($tienda->propietario)

                                            <div class="d-flex align-items-center">

                                                <div class="rounded-circle bg-primary bg-opacity-10
                                                                    text-primary d-flex align-items-center
                                                                    justify-content-center me-2"
                                                    style="width:38px;height:38px;min-width:38px;">

                                                    <i class="bi bi-person-fill"></i>

                                                </div>


                                                <div>

                                                    <div class="fw-semibold propietario-tienda">

                                                        {{ $tienda->propietario->nombres }}

                                                        {{ $tienda->propietario->apellido_paterno }}

                                                    </div>

                                                </div>

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

                                        <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2">

                                            <i class="bi bi-building me-1"></i>

                                            {{ $tienda->edificio->nombre ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- ACCIONES --}}
                                    <td class="text-center">

                                        <a href="{{ route('tiendas.edit', $tienda->id) }}"
                                            class="btn btn-sm btn-outline-info" title="Editar tienda">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    </td>

                                </tr>

                            @endif

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-shop fs-1 d-block mb-2"></i>

                                        <h5>
                                            No existen tiendas registradas
                                        </h5>

                                        <p class="mb-0">

                                            Registra una tienda para comenzar.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse


                        {{-- SIN RESULTADOS --}}
                        <tr id="sinResultadosTiendas" style="display:none;">

                            <td colspan="7" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-search fs-1 d-block mb-2"></i>

                                    <h5>
                                        No se encontraron tiendas
                                    </h5>

                                    <p class="mb-0">

                                        Intenta buscar con otro dato.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- PAGINACIÓN --}}
            @if($tiendas->hasPages())

                <div class="card-footer bg-white border-0 py-3">

                    <div class="d-flex justify-content-center">

                        {{ $tiendas->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- BUSCADOR --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buscador =
                document.getElementById('buscarTienda');

            const btnBuscar =
                document.getElementById('btnBuscarTienda');

            const btnLimpiar =
                document.getElementById('limpiarBusquedaTienda');

            const filas =
                document.querySelectorAll('.fila-tienda');

            const sinResultados =
                document.getElementById('sinResultadosTiendas');


            // NORMALIZAR TEXTO
            function normalizarTexto(texto) {

                return texto
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .trim();

            }


            // REALIZAR BÚSQUEDA
            function realizarBusqueda() {

                const texto =
                    normalizarTexto(buscador.value);

                let encontrados = 0;


                filas.forEach(function (fila) {

                    const textoFila =
                        normalizarTexto(fila.textContent);


                    if (
                        texto === '' ||
                        textoFila.includes(texto)
                    ) {

                        fila.style.display = '';

                        encontrados++;

                    } else {

                        fila.style.display = 'none';

                    }

                });


                // MOSTRAR MENSAJE SI NO HAY RESULTADOS
                if (encontrados === 0 && texto !== '') {

                    sinResultados.style.display = '';

                } else {

                    sinResultados.style.display = 'none';

                }

            }


            // BOTÓN BUSCAR
            btnBuscar.addEventListener('click', function () {

                realizarBusqueda();

            });


            // ENTER
            buscador.addEventListener('keydown', function (evento) {

                if (evento.key === 'Enter') {

                    evento.preventDefault();

                    realizarBusqueda();

                }

            });


            // BOTÓN LIMPIAR
            btnLimpiar.addEventListener('click', function () {

                buscador.value = '';


                filas.forEach(function (fila) {

                    fila.style.display = '';

                });


                sinResultados.style.display = 'none';

                buscador.focus();

            });

        });

    </script>

</x-app-layout>