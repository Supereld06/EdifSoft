<x-app-layout>

    ```
    <x-slot name="header">
        <h3>Editar Expensa Tienda</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form action="{{ route('expensas_tiendas.update', $expensa->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Propietario</label>

                    <select name="propietario_id" class="form-control">

                        @foreach($propietarios as $p)

                            <option value="{{ $p->id }}" {{ $expensa->propietario_id == $p->id ? 'selected' : '' }}>

                                {{ $p->nombres }}
                                {{ $p->apellido_paterno }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Tienda</label>

                    <select name="tienda_id" class="form-control">

                        @foreach($tiendas as $t)

                            <option value="{{ $t->id }}" {{ $expensa->tienda_id == $t->id ? 'selected' : '' }}>

                                {{ $t->numero_tienda }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Apertura Expensa</label>

                    <select name="apertura_expensa_id" class="form-control">

                        @foreach($aperturas as $a)

                            <option value="{{ $a->id }}" {{ $expensa->apertura_expensa_id == $a->id ? 'selected' : '' }}>

                                {{ $a->mes }}
                                -
                                {{ $a->gestion }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Total</label>

                    <input type="number" step="0.01" name="total" value="{{ $expensa->total }}" class="form-control">

                </div>

                <button class="btn btn-warning">

                    Actualizar

                </button>

                <a href="{{ route('expensas_tiendas.index') }}" class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>
    ```

</x-app-layout>