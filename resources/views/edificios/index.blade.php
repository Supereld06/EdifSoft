<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 fw-bold">
                    <i class="bi bi-buildings-fill text-primary"></i>
                    Lista de Edificios
                </h3>

                <small class="text-muted">
                    Administración de edificios registrados
                </small>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- BOTONES --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>

                <a href="{{ route('edificios.create') }}" class="btn btn-primary shadow-sm">

                    <i class="bi bi-building-add"></i>
                    Registrar Edificio

                </a>

            </div>

            <div class="text-muted">

                <i class="bi bi-info-circle"></i>
                Gestión de edificios

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
        <div class="card border-0 shadow-sm overflow-hidden edificios-contenedor">


            {{-- CABECERA --}}
            <div class="card-header bg-white py-3 border-0">

                <div class="row align-items-center">

                    {{-- TÍTULO Y BUSCADOR --}}
                    <div class="col-lg-7">

                        <h5 class="mb-1 fw-bold">

                            <i class="bi bi-buildings text-primary me-2"></i>

                            Edificios registrados

                        </h5>

                        <small class="text-muted d-block mb-3">

                            Información de los edificios

                        </small>


                        {{-- BUSCADOR --}}
                        <div class="input-group buscador-edificios">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search text-primary"></i>

                            </span>

                            <input type="text" id="buscarEdificio" class="form-control"
                                placeholder="Buscar por nombre, dirección o ciudad..." autocomplete="off">

                            <button type="button" id="btnBuscarEdificio" class="btn btn-primary" title="Buscar">

                                <i class="bi bi-search"></i>

                            </button>

                            <button type="button" id="limpiarBusquedaEdificio" class="btn btn-secondary"
                                title="Limpiar">

                                <i class="bi bi-x-circle"></i>

                            </button>

                        </div>

                    </div>


                    {{-- CANTIDAD --}}
                    <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">

                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.95rem;">

                            {{ $edificios->count() }}

                            {{ $edificios->count() == 1 ? 'edificio' : 'edificios' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- CONTENIDO DE EDIFICIOS --}}
            <div class="card-body edificios-body">

                <div class="row g-4" id="contenedorEdificios">

                    @forelse($edificios as $edificio)

                                        <div class="col-xl-4 col-lg-6 col-md-6 edificio-item" data-edificio="{{ strtolower(
                            $edificio->nombre . ' ' .
                            $edificio->direccion . ' ' .
                            $edificio->ciudad . ' ' .
                            $edificio->zona
                        ) }}">

                                            <div class="card edificio-card h-100 border-0 shadow-sm">


                                                {{-- IMAGEN DE FONDO --}}
                                                @if($edificio->imagen_edificio)

                                                    <div class="edificio-fondo"
                                                        style="background-image: url('{{ asset('storage/' . $edificio->imagen_edificio) }}');">
                                                    </div>

                                                @else

                                                    <div class="edificio-fondo edificio-fondo-default">
                                                    </div>

                                                @endif


                                                {{-- CONTENIDO --}}
                                                <div class="edificio-contenido">


                                                    {{-- LOGO --}}
                                                    <div class="edificio-logo-container">

                                                        @if($edificio->logo_edificio)

                                                            <img src="{{ asset('storage/' . $edificio->logo_edificio) }}"
                                                                alt="Logo {{ $edificio->nombre }}" class="edificio-logo">

                                                        @else

                                                            <div class="edificio-logo edificio-logo-default">

                                                                <i class="bi bi-building"></i>

                                                            </div>

                                                        @endif

                                                    </div>


                                                    {{-- INFORMACIÓN --}}
                                                    <div class="text-center edificio-info">

                                                        <h4 class="edificio-nombre">

                                                            {{ $edificio->nombre }}

                                                        </h4>

                                                        <div class="edificio-direccion">

                                                            <i class="bi bi-geo-alt-fill text-danger"></i>

                                                            {{ $edificio->direccion }}

                                                        </div>

                                                    </div>


                                                    {{-- UBICACIÓN --}}
                                                    <div class="edificio-ubicacion">

                                                        <span>
                                                            <i class="bi bi-flag-fill"></i>
                                                            {{ $edificio->pais }}
                                                        </span>

                                                        <span>
                                                            <i class="bi bi-buildings"></i>
                                                            {{ $edificio->ciudad }}
                                                        </span>

                                                        <span>
                                                            <i class="bi bi-geo"></i>
                                                            {{ $edificio->zona }}
                                                        </span>

                                                    </div>


                                                    {{-- ESTADÍSTICAS --}}
                                                    <div class="row g-2 edificio-estadisticas">

                                                        {{-- DEPARTAMENTOS --}}
                                                        <div class="col-4">

                                                            <div class="edificio-estadistica">

                                                                <i class="bi bi-house-door-fill text-primary"></i>

                                                                <strong>
                                                                    {{ $edificio->departamentos->count() }}
                                                                </strong>

                                                                <small>
                                                                    Departamentos
                                                                </small>

                                                            </div>

                                                        </div>


                                                        {{-- TIENDAS --}}
                                                        <div class="col-4">

                                                            <div class="edificio-estadistica">

                                                                <i class="bi bi-shop text-success"></i>

                                                                <strong>
                                                                    {{ $edificio->tiendas->count() }}
                                                                </strong>

                                                                <small>
                                                                    Tiendas
                                                                </small>

                                                            </div>

                                                        </div>


                                                        {{-- PROPIETARIOS --}}
                                                        <div class="col-4">

                                                            <div class="edificio-estadistica">

                                                                <i class="bi bi-people-fill text-warning"></i>

                                                                <strong>
                                                                    {{ $edificio->propietarios->count() }}
                                                                </strong>

                                                                <small>
                                                                    Propietarios
                                                                </small>

                                                            </div>

                                                        </div>

                                                    </div>


                                                    {{-- ACCIONES --}}
                                                    <div class="edificio-acciones">

                                                        <a href="{{ route('edificios.edit', $edificio->id) }}"
                                                            class="btn btn-info btn-sm shadow-sm">

                                                            <i class="bi bi-pencil-square"></i>

                                                            Editar edificio

                                                        </a>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                    @empty

                        {{-- SIN EDIFICIOS --}}
                        <div class="col-12">

                            <div class="text-center py-5 text-muted">

                                <i class="bi bi-buildings fs-1 d-block mb-3"></i>

                                <h5>
                                    No existen edificios registrados
                                </h5>

                                <p class="mb-0">
                                    Registra un edificio para comenzar.
                                </p>

                            </div>

                        </div>

                    @endforelse


                    {{-- SIN RESULTADOS DE BÚSQUEDA --}}
                    <div class="col-12" id="sinResultadosEdificios" style="display:none;">

                        <div class="text-center py-5 text-muted">

                            <i class="bi bi-search fs-1 d-block mb-3"></i>

                            <h5>
                                No se encontraron edificios
                            </h5>

                            <p class="mb-0">
                                Intenta buscar con otro nombre, dirección o ciudad.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- BUSCADOR --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buscador =
                document.getElementById('buscarEdificio');

            const btnBuscar =
                document.getElementById('btnBuscarEdificio');

            const btnLimpiar =
                document.getElementById('limpiarBusquedaEdificio');

            const edificios =
                document.querySelectorAll('.edificio-item');

            const sinResultados =
                document.getElementById('sinResultadosEdificios');


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


                edificios.forEach(function (edificio) {

                    const datos =
                        normalizarTexto(
                            edificio.getAttribute('data-edificio')
                        );


                    if (
                        texto === '' ||
                        datos.includes(texto)
                    ) {

                        edificio.style.display = '';

                        encontrados++;

                    } else {

                        edificio.style.display = 'none';

                    }

                });


                // MOSTRAR MENSAJE
                if (
                    encontrados === 0 &&
                    texto !== ''
                ) {

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


            // LIMPIAR
            btnLimpiar.addEventListener('click', function () {

                buscador.value = '';

                edificios.forEach(function (edificio) {

                    edificio.style.display = '';

                });

                sinResultados.style.display = 'none';

                buscador.focus();

            });

        });

    </script>

</x-app-layout>