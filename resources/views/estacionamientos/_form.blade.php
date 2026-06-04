<div class="mb-3">
    <label>Tipo</label>

    <input type="text"
        name="tipo_estacionamiento"
        class="form-control"
        value="{{ old('tipo_estacionamiento', $estacionamiento->tipo_estacionamiento ?? '') }}">
</div>

<div class="mb-3">
    <label>Número</label>

    <input type="text"
        name="numero_estacionamiento"
        class="form-control"
        value="{{ old('numero_estacionamiento', $estacionamiento->numero_estacionamiento ?? '') }}">
</div>

<div class="mb-3">
    <label>Ubicación</label>

    <input type="text"
        name="ubicacion"
        class="form-control"
        value="{{ old('ubicacion', $estacionamiento->ubicacion ?? '') }}">
</div>

<div class="mb-3">
    <label>Detalle</label>

    <textarea
        name="detalle"
        class="form-control">{{ old('detalle', $estacionamiento->detalle ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Propietario</label>

    <select
        name="propietario_id"
        class="form-select">

        <option value="">
            Seleccione
        </option>

        @foreach($propietarios as $propietario)

        <option
            value="{{ $propietario->id }}"
            {{ old('propietario_id',
                $estacionamiento->propietario_id ?? '')
                == $propietario->id
                ? 'selected' : '' }}>

            {{ $propietario->nombre }}

        </option>

        @endforeach

    </select>
</div>

<button class="btn btn-primary">
    Guardar
</button>