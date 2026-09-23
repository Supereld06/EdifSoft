<x-app-layout>

    <x-slot name="header">

        <div>
            <h3 class="mb-1 fw-bold">
                <i class="bi bi-arrow-down-circle-fill text-success"></i>
                Registrar Ingreso
            </h3>

            <small class="text-muted">
                Registra un nuevo ingreso en la caja seleccionada
            </small>
        </div>

    </x-slot>


    <div class="container-fluid py-4 px-4">

        {{-- MENSAJE DE ERROR DE SESIÓN --}}
        @if(session('error'))

            <div class="alert alert-danger shadow-sm border-0 mb-4">

                <div class="d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>

                        <strong>
                            No se pudo registrar el ingreso
                        </strong>

                        <div class="small mt-1">
                            {{ session('error') }}
                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- MENSAJE GENERAL DE ERRORES --}}
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
            <div class="card-header bg-success text-white py-3 border-0">

                <div class="d-flex align-items-center">

                    <div class="icon-header me-3">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>

                    <div>

                        <h5 class="mb-0 fw-bold">
                            Nuevo Ingreso
                        </h5>

                        <small class="opacity-75">
                            Caja: {{ $caja->nombre }}
                        </small>

                    </div>

                </div>

            </div>


            {{-- CUERPO --}}
            <div class="card-body p-4">

                {{-- SALDO ACTUAL --}}
                <div class="alert alert-light border shadow-sm mb-4">

                    <div class="d-flex align-items-center">

                        <div class="me-3">
                            <i class="bi bi-wallet2 fs-3 text-primary"></i>
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Saldo actual de la caja
                            </small>

                            <span class="text-success fw-bold fs-4">
                                Bs {{ number_format($caja->saldo, 2) }}
                            </span>

                        </div>

                    </div>

                </div>


                <form action="{{ route('cajas.ingreso.store', $caja->id) }}"
                      method="POST">

                    @csrf


                    {{-- DATOS DEL INGRESO --}}
                    <div class="section-title mb-3">

                        <i class="bi bi-cash-coin text-success"></i>

                        <span>
                            Información del ingreso
                        </span>

                    </div>


                    <div class="row">

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
                                       placeholder="Ej. Pago de cuota de mantenimiento">

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
                                       placeholder="0.00">

                            </div>

                            @error('monto')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- OBSERVACIÓN --}}
                        <div class="col-12 mb-3">

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
                                          placeholder="Ingrese una observación o detalle del ingreso">{{ old('observacion') }}</textarea>

                            </div>

                            @error('observacion')

                                <div class="mensaje-error">

                                    <i class="bi bi-exclamation-circle"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- NOTA --}}
                    <div class="nota-obligatorios mt-2 mb-3">

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
                                class="btn btn-success">

                            <i class="bi bi-check-circle-fill"></i>
                            Registrar Ingreso

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>

