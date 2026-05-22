<x-app-layout>

    <x-slot name="header">
        <h3>Registrar Expensa</h3>
    </x-slot>

    <div class="container">

        <div class="card shadow p-4">

            <form method="POST" action="{{ route('expensas.store') }}">

                @csrf

                <div class="mb-3">

                    <label>Total</label>

                    <input type="number" step="0.01" name="total" class="form-control" required>

                </div>

                <div class="mb-3">

                    <label>Pagado</label>

                    <input type="number" step="0.01" name="pagado" value="0" class="form-control">

                </div>

                <div class="mb-3">

                    <label>Departamento</label>

                    <select name="departamento_id" class="form-control" required>

                        @foreach($departamentos as $departamento)

                            <option value="{{ $departamento->id }}">

                                {{ $departamento->numero_departamento }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Propietario</label>

                    <select name="propietario_id" class="form-control" required>

                        @foreach($propietarios as $propietario)

                            <option value="{{ $propietario->id }}">

                                {{ $propietario->nombres }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Apertura</label>

                    <select name="apertura_expensa_id" class="form-control" required>

                        @foreach($aperturas as $apertura)

                            <option value="{{ $apertura->id }}">

                                {{ $apertura->mes }}
                                -
                                {{ $apertura->gestion }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button type="submit" class="btn btn-success">

                    Guardar

                </button>

            </form>

        </div>

    </div>

</x-app-layout>