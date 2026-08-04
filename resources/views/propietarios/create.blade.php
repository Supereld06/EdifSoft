<x-app-layout>

    <x-slot name="header">
        <h3>👤 Registrar Propietario</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="bi bi-person-plus"></i>
                    Nuevo Propietario
                </h5>

            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('propietarios.store') }}">

                    @csrf

                    <!-- FILA 1 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Nombres
                            </label>

                            <input type="text" name="nombres" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Apellido Paterno
                            </label>

                            <input type="text" name="apellido_paterno" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Apellido Materno
                            </label>

                            <input type="text" name="apellido_materno" class="form-control" required>

                        </div>

                    </div>

                    <!-- FILA 2 -->

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Nº de Carnet
                            </label>

                            <input type="text" name="carnet" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Celular
                            </label>

                            <input type="text" name="celular" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label fw-bold">
                                Correo Electrónico
                            </label>

                            <input type="email" name="correo" value="{{ old('correo') }}"
                                class="form-control @error('correo') is-invalid @enderror" required>

                            @error('correo')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>

                    <!-- FILA 3 -->

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">
                                Dirección
                            </label>

                            <input type="text" name="direccion" class="form-control" required>

                        </div>

                    </div>

                    <input type="hidden" name="edificio_id" value="{{ $edificio_id }}">

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('propietarios.index') }}" class="btn btn-secondary me-2">

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