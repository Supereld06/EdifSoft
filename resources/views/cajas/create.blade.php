<x-app-layout>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>➕ Nueva Caja</h2>
            <p class="text-muted mb-0">
                Crear una nueva caja para el edificio actual
            </p>
        </div>

        <a href="{{ route('cajas.index') }}"
           class="btn btn-secondary">
            ← Volver
        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('cajas.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre de la caja
                        </label>

                        <input type="text"
                               name="nombre"
                               class="form-control"
                               value="{{ old('nombre') }}"
                               required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Saldo inicial
                        </label>

                        <input type="number"
                               name="saldo"
                               class="form-control"
                               step="0.01"
                               min="0"
                               value="{{ old('saldo', 0) }}">

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Descripción
                        </label>

                        <textarea name="descripcion"
                                  class="form-control"
                                  rows="3">{{ old('descripcion') }}</textarea>

                    </div>

                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('cajas.index') }}"
                       class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        💾 Guardar Caja
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>