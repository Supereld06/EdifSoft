<x-app-layout>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>✏️ Editar Caja</h2>

            <p class="text-muted mb-0">
                {{ $caja->nombre }}
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

            <form action="{{ route('cajas.update', $caja->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input type="text"
                               name="nombre"
                               class="form-control"
                               value="{{ old('nombre', $caja->nombre) }}"
                               required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Estado
                        </label>

                        <select name="estado"
                                class="form-select">

                            <option value="1"
                                {{ $caja->estado ? 'selected' : '' }}>
                                Activa
                            </option>

                            <option value="0"
                                {{ !$caja->estado ? 'selected' : '' }}>
                                Inactiva
                            </option>

                        </select>

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Descripción
                        </label>

                        <textarea name="descripcion"
                                  class="form-control"
                                  rows="3">{{ old('descripcion', $caja->descripcion) }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Saldo actual
                        </label>

                        <input type="text"
                               class="form-control"
                               value="Bs {{ number_format($caja->saldo, 2) }}"
                               disabled>

                        <small class="text-muted">
                            El saldo se modifica mediante movimientos.
                        </small>

                    </div>

                </div>


                <div class="d-flex justify-content-end mt-4">

                    <button type="submit"
                            class="btn btn-primary">
                        💾 Actualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>