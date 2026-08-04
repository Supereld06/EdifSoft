<x-app-layout>

    <x-slot name="header">
        <h3>🏢 Registrar Edificio</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-building"></i>
                    Nuevo Edificio
                </h5>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('edificios.store') }}" enctype="multipart/form-data">

                    @csrf

                   

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Nombre del edificio
                            </label>

                            <input type="text" name="nombre" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Dirección
                            </label>

                            <input type="text" name="direccion" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Nº Departamentos
                            </label>

                            <input type="number" name="numero_departamentos" class="form-control" required>

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                País
                            </label>

                            <input type="text" name="pais" class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Ciudad
                            </label>

                            <input type="text" name="ciudad" class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Zona
                            </label>

                            <input type="text" name="zona" class="form-control">

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Imagen del edificio
                            </label>

                            <input type="file" name="imagen_edificio" class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Logo del edificio
                            </label>

                            <input type="file" name="logo_edificio" class="form-control">

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('edificios.index') }}" class="btn btn-secondary me-2">

                            <i class="bi bi-arrow-left"></i>

                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Guardar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>