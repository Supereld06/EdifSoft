<x-app-layout>

    <x-slot name="header">
        <h3>🏢 Editar Edificio</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Editar Edificio
                </h5>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('edificios.update', $edificio->id) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Nombre del edificio
                            </label>

                            <input type="text" name="nombre" value="{{ $edificio->nombre }}" class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Dirección
                            </label>

                            <input type="text" name="direccion" value="{{ $edificio->direccion }}" class="form-control"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Nº Departamentos
                            </label>

                            <input type="number" name="numero_departamentos"
                                value="{{ $edificio->numero_departamentos }}" class="form-control" required>

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                País
                            </label>

                            <input type="text" name="pais" value="{{ $edificio->pais }}" class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Ciudad
                            </label>

                            <input type="text" name="ciudad" value="{{ $edificio->ciudad }}" class="form-control">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Zona
                            </label>

                            <input type="text" name="zona" value="{{ $edificio->zona }}" class="form-control">

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

                    <!-- FILA 4 -->

                    <div class="row">

                        <div class="col-md-6 text-center">

                            @if($edificio->imagen_edificio)

                                <label class="form-label d-block">
                                    Imagen Actual
                                </label>

                                <img src="{{ asset('storage/' . $edificio->imagen_edificio) }}" class="img-thumbnail"
                                    style="max-height:180px;">

                            @endif

                        </div>

                        <div class="col-md-6 text-center">

                            @if($edificio->logo_edificio)

                                <label class="form-label d-block">
                                    Logo Actual
                                </label>

                                <img src="{{ asset('storage/' . $edificio->logo_edificio) }}" class="img-thumbnail"
                                    style="max-height:180px;">

                            @endif

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

                            Actualizar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>