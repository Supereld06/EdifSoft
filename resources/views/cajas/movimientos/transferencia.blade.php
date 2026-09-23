<x-app-layout>

    <x-slot name="header">

        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-arrow-left-right text-warning"></i>
                Transferir entre Cajas
            </h3>

            <small class="text-muted">
                Transfiere fondos desde la caja seleccionada hacia otra caja
            </small>
        </div>

    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- MENSAJE DE ERROR GENERAL --}}
        @if(session('error'))

            <div class="alert alert-danger shadow-sm border-0 mb-4">

                <div class="d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>

                        <strong>
                            No se pudo realizar la transferencia
                        </strong>

                        <div class="small mt-1">
                            {{ session('error') }}
                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- MENSAJE DE ÉXITO --}}
        @if(session('success'))

            <div class="alert alert-success shadow-sm border-0 mb-4">

                <div class="d-flex align-items-start">

                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>

                    <div>

                        <strong>
                            Transferencia realizada correctamente
                        </strong>

                        <div class="small mt-1">
                            {{ session('success') }}
                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- ERRORES DE VALIDACIÓN --}}
        @if($errors->any())

            <div class="alert alert-danger shadow-sm border-0 mb-4">

                <div class="d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>

                        <strong>
                            Revisa los datos del formulario
                        </strong>

                        <div class="small mt-1">
                            Por favor completa o corrige los campos
                            marcados antes de continuar.
                        </div>

                    </div>

                </div>

            </div>

        @endif


        <div class="card border-0 shadow-sm formulario-propietario">

            {{-- CABECERA --}}
            <div class="card-header bg-warning text-dark py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Nueva Transferencia
                        </h5>

                        <small class="opacity-75">
                            Desde: {{ $caja->nombre }}
                        </small>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                {{-- SALDO DISPONIBLE --}}
                <div class="alert alert-light border shadow-sm mb-4">

                    <div class="d-flex align-items-center">

                        <div class="me-3">
                            <i class="bi bi-wallet2 fs-3 text-primary"></i>
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Saldo disponible de la caja
                            </small>

                            <span class="text-success fw-bold fs-4">
                                Bs {{ number_format($caja->saldo, 2) }}
                            </span>

                        </div>

                    </div>

                </div>


                <form action="{{ route('cajas.transferencia.store', $caja->id) }}"
                      method="POST">

                    @csrf


                    {{-- INFORMACIÓN DE LA TRANSFERENCIA --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-arrow-left-right text-warning"></i>

                        <span>
                            Información de la transferencia
                        </span>

                    </div>


                    <div class="row">

                        {{-- CAJA DESTINO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Caja destino
                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-edificio">
                                    <i class="bi bi-safe2-fill"></i>
                                </span>

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

                            </div>

                            @error('caja_destino_id')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- CONCEPTO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Concepto
                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-nombre">
                                    <i class="bi bi-receipt"></i>
                                </span>

                                <input type="text"
                                       name="concepto"
                                       value="{{ old('concepto') }}"
                                       class="form-control @error('concepto') is-invalid @enderror"
                                       placeholder="Ej. Transferencia de fondos"
                                       maxlength="255">

                            </div>

                            @error('concepto')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- MONTO --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Monto
                                <span class="campo-obligatorio">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-celular">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>

                                <input type="number"
                                       name="monto"
                                       value="{{ old('monto') }}"
                                       class="form-control @error('monto') is-invalid @enderror"
                                       step="0.01"
                                       min="0.01"
                                       max="{{ $caja->saldo }}"
                                       placeholder="0.00">

                            </div>

                            @error('monto')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                            <small class="text-muted mt-1 d-block">
                                El monto no puede superar el saldo disponible.
                            </small>

                        </div>


                        {{-- OBSERVACIÓN --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Observación

                                <span class="text-muted small">
                                    (opcional)
                                </span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text icono-direccion align-items-start pt-3">
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </span>

                                <textarea name="observacion"
                                          class="form-control @error('observacion') is-invalid @enderror"
                                          rows="4"
                                          maxlength="1000"
                                          placeholder="Observaciones opcionales">{{ old('observacion') }}</textarea>

                            </div>

                            @error('observacion')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ADVERTENCIA --}}
                    <div class="alert alert-warning border shadow-sm mt-2">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                            <div>

                                <strong>
                                    Importante
                                </strong>

                                <div class="small mt-1">
                                    Esta operación generará automáticamente:
                                </div>

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

                        </div>

                    </div>


                    {{-- NOTA --}}
                    <div class="nota-obligatorios mt-3 mb-3">

                        <i class="bi bi-info-circle-fill"></i>

                        Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>


                    <hr class="my-4">


                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('cajas.movimientos', $caja->id) }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Cancelar

                        </a>


                        <button type="submit"
                                class="btn btn-warning">

                            <i class="bi bi-arrow-left-right"></i>
                            Realizar Transferencia

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>

