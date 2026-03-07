<x-app-layout>

<x-slot name="header">
    <h3>Editar Edificio</h3>
</x-slot>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Editar Edificio</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('edificios.update', $edificio->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre del edificio</label>
                            <input 
                                type="text" 
                                name="nombre" 
                                value="{{ $edificio->nombre }}" 
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input 
                                type="text" 
                                name="direccion" 
                                value="{{ $edificio->direccion }}" 
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Número de departamentos</label>
                            <input 
                                type="number" 
                                name="numero_departamentos" 
                                value="{{ $edificio->numero_departamentos }}" 
                                class="form-control"
                                required
                            >
                        </div>

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