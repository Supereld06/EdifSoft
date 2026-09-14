<x-app-layout>

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2>🔄 Transferir entre Cajas</h2>

                <p class="text-muted mb-0">
                    Desde: <strong>{{ $caja->nombre }}</strong>
                </p>
            </div>

            <a href="{{ route('cajas.movimientos', $caja->id) }}"
               class="btn btn-secondary">
                ← Volver
            </a>

        </div>


        {{-- MENSAJE DE ERROR GENERAL --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        {{-- MENSAJE DE ÉXITO --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- ERRORES DE VALIDACIÓN --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <strong>Se encontraron los siguientes errores:</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card shadow-sm">

            <div class="card-header">
                <strong>Nueva transferencia</strong>
            </div>

            <div class="card-body">

                {{-- SALDO DISPONIBLE --}}
                <div class="alert alert-light border">

                    <strong>Saldo disponible:</strong>

                    <span class="text-success fw-bold">
                        Bs {{ number_format($caja->saldo, 2) }}
                    </span>

                </div>


                <form action="{{ route('cajas.transferencia.store', $caja->id) }}"
                      method="POST">

                    @csrf


                    {{-- CAJA DESTINO --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Caja destino <span class="text-danger">*</span>
                        </label>

                        <select name="caja_destino_id"
                                class="form-select @error('caja_destino_id') is-invalid @enderror"
                                required>

                            <option value="">
                                -- Seleccione una caja --
                            </option>

                            @foreach($cajasDestino as $destino)

                                <option value="{{ $destino->id }}"
                                    {{ old('caja_destino_id') == $destino->id ? 'selected' : '' }}>

                                    {{ $destino->nombre }}
                                    — Bs {{ number_format($destino->saldo, 2) }}

                                </option>

                            @endforeach

                        </select>

                        @error('caja_destino_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CONCEPTO --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Concepto <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="concepto"
                               class="form-control @error('concepto') is-invalid @enderror"
                               value="{{ old('concepto') }}"
                               placeholder="Ej.: Transferencia de fondos"
                               maxlength="255"
                               required>

                        @error('concepto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- MONTO --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Monto <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Bs
                            </span>

                            <input type="number"
                                   name="monto"
                                   class="form-control @error('monto') is-invalid @enderror"
                                   step="0.01"
                                   min="0.01"
                                   max="{{ $caja->saldo }}"
                                   value="{{ old('monto') }}"
                                   required>

                            @error('monto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- OBSERVACIÓN --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Observación
                        </label>

                        <textarea name="observacion"
                                  class="form-control @error('observacion') is-invalid @enderror"
                                  rows="3"
                                  maxlength="1000"
                                  placeholder="Observaciones opcionales">{{ old('observacion') }}</textarea>

                        @error('observacion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ADVERTENCIA --}}
                    <div class="alert alert-warning">

                        <strong>Importante:</strong>

                        esta operación generará automáticamente:

                        <ul class="mb-0 mt-2">

                            <li>
                                Un egreso en
                                <strong>{{ $caja->nombre }}</strong>.
                            </li>

                            <li>
                                Un ingreso en la caja destino.
                            </li>

                        </ul>

                    </div>


                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('cajas.movimientos', $caja->id) }}"
                           class="btn btn-secondary">

                            Cancelar

                        </a>

                        <button type="submit"
                                class="btn btn-warning">

                            🔄 Realizar Transferencia

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>