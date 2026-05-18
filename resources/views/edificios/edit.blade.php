<x-app-layout>

    <x-slot name="header">
        <h3>Editar Edificio</h3>
    </x-slot>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card shadow">

                    <div class="card-header text-center">
                        <h3>Editar Edificio</h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('edificios.update', $edificio->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">

                                <label class="form-label">
                                    Nombre del edificio
                                </label>

                                <input type="text" name="nombre" value="{{ $edificio->nombre }}" class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Dirección
                                </label>

                                <input type="text" name="direccion" value="{{ $edificio->direccion }}"
                                    class="form-control" required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Número de departamentos
                                </label>

                                <input type="number" name="numero_departamentos"
                                    value="{{ $edificio->numero_departamentos }}" class="form-control" required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    País
                                </label>

                                <input type="text" name="pais" value="{{ $edificio->pais }}" class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Ciudad
                                </label>

                                <input type="text" name="ciudad" value="{{ $edificio->ciudad }}" class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Zona
                                </label>

                                <input type="text" name="zona" value="{{ $edificio->zona }}" class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Imagen del edificio
                                </label>

                                <input type="file" name="imagen_edificio" class="form-control">

                            </div>

                            @if($edificio->imagen_edificio)

                                <div class="mb-3 text-center">

                                    <img src="{{ asset('storage/' . $edificio->imagen_edificio) }}" width="250"
                                        class="img-thumbnail">

                                </div>

                            @endif

                            <div class="mb-3">

                                <label class="form-label">
                                    Logo del edificio
                                </label>

                                <input type="file" name="logo_edificio" class="form-control">

                            </div>

                            @if($edificio->logo_edificio)

                                <div class="mb-3 text-center">

                                    <img src="{{ asset('storage/' . $edificio->logo_edificio) }}" width="120"
                                        class="img-thumbnail">

                                </div>

                            @endif

                            <div class="d-flex justify-content-between">

                                <a href="{{ route('edificios.index') }}" class="btn btn-secondary">
                                    Volver
                                </a>

                                <button type="submit" class="btn btn-success">
                                    Actualizar
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>