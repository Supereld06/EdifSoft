<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 fw-bold">
                    <i class="bi bi-people-fill text-primary"></i>
                    Lista de Propietarios
                </h3>

                <small class="text-muted">
                    Administración de propietarios del edificio
                </small>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- BOTONES --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>

                <a href="{{ route('propietarios.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-person-plus-fill"></i>
                    Registrar Propietario
                </a>

                <a href="{{ route('propietarios.pdf') }}" class="btn btn-danger shadow-sm" target="_blank">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    Exportar PDF
                </a>

            </div>

            <div class="text-muted">
                <i class="bi bi-info-circle"></i>
                Gestión de propietarios
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

                    {{-- TÍTULO E INFORMACIÓN --}}
                    <div class="col-lg-7">

                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-person-lines-fill text-primary me-2"></i>
                            Propietarios registrados
                        </h5>

                        <small class="text-muted d-block mb-3">
                            Información de los propietarios
                        </small>


                        {{-- BUSCADOR --}}
                        <div class="input-group" style="max-width: 600px;">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search text-primary"></i>
                            </span>

                            <input type="text" id="buscarPropietario" class="form-control"
                                placeholder="Buscar por nombre o apellido..." autocomplete="off">

                            <button type="button" id="btnBuscar" class="btn btn-primary" title="Buscar">

                                <i class="bi bi-search"></i>

                            </button>

                            <button type="button" id="limpiarBusqueda" class="btn btn-secondary" title="Limpiar">

                                <i class="bi bi-x-circle"></i>

                            </button>

                        </div>
                    </div>


                    {{-- CANTIDAD --}}
                    <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">

                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.95rem;">

                            {{ $propietarios->total() }} registrados

                        </span>

                    </div>

                </div>

            </div>

            {{-- TABLA --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0" id="tablaPropietarios">

                    <thead class="table-dark">

                        <tr>

                            <th class="px-4">Propietario</th>
                            <th>Propiedades</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Edificio</th>
                            <th class="text-center">Deuda</th>
                            <th class="text-center">Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($propietarios as $prop)

                            @if($prop->edificio_id == session('edificio_id'))

                                <tr class="fila-propietario">

                                    {{-- PROPIETARIO --}}
                                    <td class="px-4">

                                        <div class="d-flex align-items-center">

                                            <div class="rounded-circle bg-primary bg-opacity-10
                                text-primary d-flex align-items-center
                                justify-content-center me-3" style="width:46px;height:46px;min-width:46px;">

                                                <i class="bi bi-person-fill fs-5"></i>

                                            </div>

                                            <div>

                                                <div class="fw-semibold nombre-propietario">

                                                    {{ $prop->nombres }}
                                                    {{ $prop->apellido_paterno }}
                                                    {{ $prop->apellido_materno }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- DEPARTAMENTOS --}}
                                    <td>

                                        @if($prop->departamentos->count())

                                            @foreach($prop->departamentos as $departamento)

                                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 mb-1">

                                                    <i class="bi bi-house-door-fill me-1"></i>

                                                    Dpto. {{ $departamento->numero_departamento }}

                                                </span>

                                            @endforeach

                                        @else

                                            <span class="text-muted">
                                                Sin departamentos
                                            </span>

                                        @endif

                                    </td>


                                    {{-- CELULAR --}}
                                    <td>

                                        @if($prop->celular)

                                            <i class="bi bi-telephone-fill text-success me-1"></i>

                                            {{ $prop->celular }}

                                        @else

                                            <span class="text-muted">
                                                No registrado
                                            </span>

                                        @endif

                                    </td>


                                    {{-- CORREO --}}
                                    <td>

                                        @if($prop->correo)

                                            <i class="bi bi-envelope-fill text-primary me-1"></i>

                                            {{ $prop->correo }}

                                        @else

                                            <span class="text-muted">
                                                No registrado
                                            </span>

                                        @endif

                                    </td>


                                    {{-- EDIFICIO --}}
                                    <td>

                                        <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2">

                                            <i class="bi bi-building me-1"></i>

                                            {{ $prop->edificio->nombre ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- DEUDA --}}
                                    <td class="text-center">

                                        @if($prop->deuda_total > 0)

                                            <span class="badge bg-danger rounded-pill px-3 py-2">

                                                <i class="bi bi-exclamation-circle-fill me-1"></i>

                                                {{ number_format($prop->deuda_total, 2) }} Bs

                                            </span>

                                        @else

                                            <span class="badge bg-success rounded-pill px-3 py-2">

                                                <i class="bi bi-check-circle-fill me-1"></i>

                                                0.00 Bs

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACCIONES --}}
                                    <td class="text-center">

                                        <a href="{{ route('propietarios.edit', $prop->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Editar propietario">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    </td>

                                </tr>

                            @endif

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-people fs-1 d-block mb-2"></i>

                                        <h5>No existen propietarios registrados</h5>

                                        <p class="mb-0">
                                            Registra un propietario para comenzar.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse


                        {{-- MENSAJE CUANDO NO HAY RESULTADOS --}}
                        <tr id="sinResultados" style="display:none;">

                            <td colspan="6" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-search fs-1 d-block mb-2"></i>

                                    <h5>No se encontraron propietarios</h5>

                                    <p class="mb-0">
                                        Intenta buscar con otro nombre o apellido.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- PAGINACIÓN --}}
            @if($propietarios->hasPages())

                <div class="card-footer bg-white border-0 py-3">

                    <div class="d-flex justify-content-center">

                        {{ $propietarios->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>

    {{-- BUSCADOR --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buscador = document.getElementById('buscarPropietario');
            const btnBuscar = document.getElementById('btnBuscar');
            const btnLimpiar = document.getElementById('limpiarBusqueda');
            const filas = document.querySelectorAll('.fila-propietario');
            const sinResultados = document.getElementById('sinResultados');


            // FUNCIÓN PARA NORMALIZAR TEXTO
            function normalizarTexto(texto) {

                return texto
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .trim();

            }


            // FUNCIÓN PARA REALIZAR LA BÚSQUEDA
            function realizarBusqueda() {

                const texto = normalizarTexto(buscador.value);

                let encontrados = 0;


                filas.forEach(function (fila) {

                    const nombre = fila.querySelector('.nombre-propietario');

                    if (!nombre) {
                        return;
                    }


                    const textoPropietario = normalizarTexto(
                        nombre.textContent
                    );


                    if (texto === '' || textoPropietario.includes(texto)) {

                        fila.style.display = '';
                        encontrados++;

                    } else {

                        fila.style.display = 'none';

                    }

                });


                // Mostrar mensaje cuando no existen resultados
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


            // BUSCAR AL PRESIONAR ENTER
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