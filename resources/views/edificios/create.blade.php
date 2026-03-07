<x-app-layout>

<x-slot name="header">
    <h3>Registrar Edificio</h3>
</x-slot>

<div class="container">

    <div class="card shadow p-4">

        <h4 class="mb-4">Nuevo Edificio</h4>

        <form method="POST" action="{{ route('edificios.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del edificio</label>

                <input 
                    type="text"
                    name="nombre"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>

                <input 
                    type="text"
                    name="direccion"
                    class="form-control"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Número de departamentos</label>

                <input 
                    type="number"
                    name="numero_departamentos"
                    class="form-control"
                >
            </div>

            <button class="btn btn-primary">
                Guardar
            </button>

            <a href="{{ route('edificios.index') }}" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>

</div>

</x-app-layout>