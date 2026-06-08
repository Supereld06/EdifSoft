<x-app-layout>

    ```
    <x-slot name="header">
        <h3>Nueva Expensa Estacionamiento</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('expensas_estacionamientos.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Propietario</label>

                    <select name="propietario_id" class="form-control" required>

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($propietarios as $p)

                            <option value="{{ $p->id }}">

                                {{ $p->nombres }}
                                {{ $p->apellido_paterno }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Estacionamiento</label>

                    <select name="estacionamiento_id" class="form-control" required>

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($estacionamientos as $e)

                            <option value="{{ $e->id }}">

                                {{ $e->numero_estacionamiento }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Apertura Expensa</label>

                    <select name="apertura_expensa_id" class="form-control" required>

                        @foreach($aperturas as $a)

                            <option value="{{ $a->id }}">

                                {{ $a->mes }}
                                -
                                {{ $a->gestion }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Total</label>

                    <input type="number" step="0.01" name="total" class="form-control" required>

                </div>

                <button class="btn btn-success">

                    Guardar

                </button>

                <a href="{{ route('expensas_estacionamientos.index') }}" class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>
    ```

</x-app-layout>