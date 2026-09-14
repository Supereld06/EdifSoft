<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 fw-bold">
                    <i class="bi bi-calendar2-check-fill text-primary"></i>
                    Apertura de Expensas
                </h3>

                <small class="text-muted">
                    Administración y control de aperturas de expensas
                </small>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- BOTONES --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>

                {{-- NUEVA APERTURA --}}
                <a href="{{ route('apertura-expensas.create') }}" class="btn btn-success shadow-sm">

                    <i class="bi bi-plus-circle-fill"></i>
                    Nueva Apertura
                </a>


                {{-- PDF --}}
                <a href="" class="btn btn-danger shadow-sm" target="_blank">

                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    Generar PDF
                </a>

            </div>


            <div class="text-muted">

                <i class="bi bi-info-circle"></i>
                Gestión de aperturas de expensas

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

                            <i class="bi bi-calendar3 text-primary me-2"></i>

                            Aperturas registradas

                        </h5>

                        <small class="text-muted d-block mb-3">

                            Consulta las aperturas de expensas por mes o gestión

                        </small>


                        {{-- BUSCADOR --}}
                        <div class="input-group" style="max-width: 650px;">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search text-primary"></i>

                            </span>


                            <input type="text" id="buscarApertura" class="form-control"
                                placeholder="Buscar por mes o gestión..." autocomplete="off">


                            {{-- BOTÓN BUSCAR --}}
                            <button type="button" id="btnBuscar" class="btn btn-primary" title="Buscar">

                                <i class="bi bi-search"></i>

                            </button>


                            {{-- BOTÓN LIMPIAR --}}
                            <button type="button" id="limpiarBusqueda" class="btn btn-secondary" title="Limpiar">

                                <i class="bi bi-x-circle"></i>

                            </button>

                        </div>

                    </div>


                    {{-- CANTIDAD --}}
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.95rem;">

                            {{ $aperturas->total() }}

                            {{ $aperturas->total() == 1 ? 'apertura' : 'aperturas' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- TABLA --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0" id="tablaAperturas">

                    <thead class="table-dark">

                        <tr>

                            <th class="px-4">
                                N°
                            </th>

                            <th>
                                Edificio
                            </th>

                            <th>
                                Mes
                            </th>

                            <th>
                                Gestión
                            </th>

                            <th>
                                Saldo Inicial
                            </th>

                            <th>
                                Efectivo Inicial
                            </th>

                            <th>
                                Exp. Departamentos
                            </th>

                            <th>
                                Exp. Tiendas
                            </th>

                            <th>
                                Exp. Parqueo
                            </th>

                            <th>
                                Factura Agua
                            </th>

                            <th>
                                Prorrateo Agua
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($aperturas as $apertura)

                            <tr class="fila-apertura">

                                {{-- NÚMERO --}}
                                <td class="px-4">

                                    <span class="fw-semibold">

                                        {{ $aperturas->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                {{-- EDIFICIO --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="rounded-circle bg-primary bg-opacity-10
                                                    text-primary d-flex align-items-center
                                                    justify-content-center me-2"
                                            style="width:40px;height:40px;min-width:40px;">

                                            <i class="bi bi-building-fill"></i>

                                        </div>

                                        <div>

                                            <div class="fw-semibold edificio-apertura">

                                                {{ $apertura->edificio->nombre ?? '-' }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- MES --}}
                                <td>

                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mes-apertura">

                                        <i class="bi bi-calendar-month me-1"></i>

                                        {{ $apertura->mes }}

                                    </span>

                                </td>


                                {{-- GESTIÓN --}}
                                <td>

                                    <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2 gestion-apertura">

                                        <i class="bi bi-calendar3 me-1"></i>

                                        {{ $apertura->gestion }}

                                    </span>

                                </td>


                                {{-- SALDO INICIAL --}}
                                <td>

                                    <span class="fw-semibold">

                                        {{ number_format($apertura->saldo_inicial, 2) }} Bs

                                    </span>

                                </td>


                                {{-- EFECTIVO INICIAL --}}
                                <td>

                                    <span class="fw-semibold">

                                        {{ number_format($apertura->efectivo_inicial, 2) }} Bs

                                    </span>

                                </td>


                                {{-- EXPENSAS DEPARTAMENTOS --}}
                                <td>

                                    <span class="text-primary fw-semibold">

                                        {{ number_format($apertura->expensa_departamentos, 2) }} Bs

                                    </span>

                                </td>


                                {{-- EXPENSAS TIENDAS --}}
                                <td>

                                    <span class="text-primary fw-semibold">

                                        {{ number_format($apertura->expensa_tiendas, 2) }} Bs

                                    </span>

                                </td>


                                {{-- EXPENSAS PARQUEO --}}
                                <td>

                                    <span class="text-primary fw-semibold">

                                        {{ number_format($apertura->expensa_parqueo, 2) }} Bs

                                    </span>

                                </td>


                                {{-- FACTURA AGUA --}}
                                <td>

                                    <span class="text-danger fw-semibold">

                                        {{ number_format($apertura->factura_agua, 2) }} Bs

                                    </span>

                                </td>


                                {{-- PRORRATEO AGUA --}}
                                <td>

                                    <span class="badge bg-info text-white px-3 py-2">

                                        {{ $apertura->prorrateo_agua }}

                                    </span>

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <a href="{{ route('apertura-expensas.edit', $apertura) }}"
                                        class="btn btn-sm btn-outline-info" title="Editar apertura">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{--

                                    SE DESHABILITÓ ELIMINAR
                                    PORQUE EXISTEN RELACIONES

                                    <form action="{{ route('apertura-expensas.destroy', $apertura) }}" method="POST"
                                        style="display:inline-block">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                    --}}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="12" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>

                                        <h5>
                                            No existen aperturas registradas
                                        </h5>

                                        <p class="mb-0">
                                            Registra una apertura para comenzar.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse


                        {{-- SIN RESULTADOS DE BÚSQUEDA --}}
                        <tr id="sinResultados" style="display:none;">

                            <td colspan="12" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-search fs-1 d-block mb-2"></i>

                                    <h5>
                                        No se encontraron aperturas
                                    </h5>

                                    <p class="mb-0">
                                        Intenta buscar con otro mes o gestión.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- PAGINACIÓN --}}
            @if($aperturas->hasPages())

                <div class="card-footer bg-white border-0 py-3">

                    <div class="d-flex justify-content-center">

                        {{ $aperturas->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- BUSCADOR --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buscador = document.getElementById('buscarApertura');

            const btnBuscar = document.getElementById('btnBuscar');

            const btnLimpiar = document.getElementById('limpiarBusqueda');

            const filas = document.querySelectorAll('.fila-apertura');

            const sinResultados = document.getElementById('sinResultados');


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

                const texto = normalizarTexto(buscador.value);

                let encontrados = 0;


                filas.forEach(function (fila) {

                    const mes = fila.querySelector('.mes-apertura');

                    const gestion = fila.querySelector('.gestion-apertura');


                    if (!mes || !gestion) {

                        return;

                    }


                    const textoMes = normalizarTexto(
                        mes.textContent
                    );


                    const textoGestion = normalizarTexto(
                        gestion.textContent
                    );


                    /*
                     * BUSCA EN:
                     * - MES
                     * - GESTIÓN
                     *
                     * También permite buscar números
                     * como 2026.
                     */

                    if (
                        texto === '' ||
                        textoMes.includes(texto) ||
                        textoGestion.includes(texto)
                    ) {

                        fila.style.display = '';

                        encontrados++;

                    } else {

                        fila.style.display = 'none';

                    }

                });


                // MOSTRAR MENSAJE SIN RESULTADOS
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