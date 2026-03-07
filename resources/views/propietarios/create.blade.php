<x-app-layout>

<x-slot name="header">
    <div class="header-fondo">
        <h3>Registrar Propietario</h3>
    </div>
</x-slot>

<div class="container">

    <div class="card shadow p-4">

        <h4 class="mb-4">Nuevo Propietario</h4>

        <form method="POST" action="{{ route('propietarios.store') }}">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombres del Propietario</label>
                    <input 
                        type="text"
                        name="nombres"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido Paterno</label>
                    <input 
                        type="text"
                        name="apellido_paterno"
                        class="form-control"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido Materno</label>
                    <input 
                        type="text"
                        name="apellido_materno"
                        class="form-control"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Numero de Carnet</label>
                    <input 
                        type="text"
                        name="carnet"
                        class="form-control"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Direccion</label>
                    <input 
                        type="text"
                        name="direccion"
                        class="form-control"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Correo</label>
                    <input 
                        type="text"
                        name="correo"
                        class="form-control"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Celular</label>
                    <input 
                        type="text"
                        name="celular"
                        class="form-control"
                    >
                </div>

            </div>

            <input 
                type="hidden"
                name="edificio_id"
                value="{{ $edificio_id }}"
            >

            <button class="btn btn-success">
                💾 Guardar
            </button>

            <a href="{{ route('propietarios.index') }}" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>

</div>

</x-app-layout>