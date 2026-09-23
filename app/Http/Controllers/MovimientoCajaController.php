<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\MovimientoCaja;
use App\Models\TipoMovimiento;
use App\Services\CajaService;
use App\Exports\MovimientoCajaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class MovimientoCajaController extends Controller
{
    public function __construct(
        private CajaService $cajaService
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | LISTADO DE MOVIMIENTOS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request, $id)
    {
        $caja = $this->obtenerCaja($id);

        /*
        |--------------------------------------------------------------------------
        | CONSULTA DE MOVIMIENTOS
        |--------------------------------------------------------------------------
        */

        $query = MovimientoCaja::with([
            'usuario',
            'usuarioAnulacion',
            'tipoMovimiento'
        ])
            ->where('caja_id', $caja->id);


        /*
        |--------------------------------------------------------------------------
        | FILTRO POR TIPO GENERAL
        | ingreso / egreso
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tipo')) {

            $query->where(
                'tipo',
                $request->tipo
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTRO POR TIPO DE MOVIMIENTO
        | Ejemplo: Expensas, Multas, Servicios, etc.
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tipo_movimiento_id')) {

            $query->where(
                'tipo_movimiento_id',
                $request->tipo_movimiento_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTRO POR ESTADO
        | activo / anulado
        |--------------------------------------------------------------------------
        */

        if ($request->filled('estado')) {

            $query->where(
                'estado',
                $request->estado
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTRO DESDE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_desde')) {

            $query->whereDate(
                'fecha',
                '>=',
                $request->fecha_desde
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTRO HASTA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_hasta')) {

            $query->whereDate(
                'fecha',
                '<=',
                $request->fecha_hasta
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BÚSQUEDA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('buscar')) {

            $buscar = trim($request->buscar);

            $query->where(function ($q) use ($buscar) {

                $q->where(
                    'concepto',
                    'like',
                    "%{$buscar}%"
                )
                    ->orWhere(
                        'observacion',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'transferencia_id',
                        'like',
                        "%{$buscar}%"
                    );
            });
        }


        /*
        |--------------------------------------------------------------------------
        | MOVIMIENTOS
        |--------------------------------------------------------------------------
        */

        $movimientos = $query
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | TOTAL INGRESOS
        |--------------------------------------------------------------------------
        */

        $totalIngresos = MovimientoCaja::where(
            'caja_id',
            $caja->id
        )
            ->where('tipo', 'ingreso')
            ->where('estado', 'activo')
            ->sum('monto');


        /*
        |--------------------------------------------------------------------------
        | TOTAL EGRESOS
        |--------------------------------------------------------------------------
        */

        $totalEgresos = MovimientoCaja::where(
            'caja_id',
            $caja->id
        )
            ->where('tipo', 'egreso')
            ->where('estado', 'activo')
            ->sum('monto');


        /*
        |--------------------------------------------------------------------------
        | EDIFICIO ACTUAL
        |--------------------------------------------------------------------------
        */

        $edificioId = session('edificio_id');


        /*
        |--------------------------------------------------------------------------
        | CATÁLOGO DE INGRESOS
        |--------------------------------------------------------------------------
        */

        $tiposIngreso = TipoMovimiento::where(
            'edificio_id',
            $edificioId
        )
            ->where('tipo', 'ingreso')
            ->where('estado', true)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CATÁLOGO DE EGRESOS
        |--------------------------------------------------------------------------
        */

        $tiposEgreso = TipoMovimiento::where(
            'edificio_id',
            $edificioId
        )
            ->where('tipo', 'egreso')
            ->where('estado', true)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */

        return view(
            'cajas.movimientos.index',
            compact(
                'caja',
                'movimientos',
                'totalIngresos',
                'totalEgresos',
                'tiposIngreso',
                'tiposEgreso'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | INGRESOS
    |--------------------------------------------------------------------------
    */

    public function createIngreso($id)
    {
        $caja = $this->obtenerCaja($id);

        $tiposIngreso = TipoMovimiento::where(
            'edificio_id',
            session('edificio_id')
        )
            ->where('tipo', 'ingreso')
            ->where('estado', true)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();

        return view(
            'cajas.movimientos.ingreso',
            compact(
                'caja',
                'tiposIngreso'
            )
        );
    }

    public function storeIngreso(Request $request, $id)
    {
        $caja = $this->obtenerCaja($id);

        $validated = $request->validate(
            [
                'concepto' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'tipo_movimiento_id' => [
                    'required',
                    'integer',
                ],

                'monto' => [
                    'required',
                    'numeric',
                    'gt:0',
                ],

                'observacion' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'concepto.required' =>
                    'El concepto es obligatorio.',

                'concepto.string' =>
                    'El concepto debe ser un texto.',

                'concepto.max' =>
                    'El concepto no puede superar los 255 caracteres.',

                'tipo_movimiento_id.required' =>
                    'Debe seleccionar un tipo de ingreso.',

                'tipo_movimiento_id.integer' =>
                    'El tipo de ingreso seleccionado no es válido.',

                'monto.required' =>
                    'El monto es obligatorio.',

                'monto.numeric' =>
                    'El monto debe ser un número válido.',

                'monto.gt' =>
                    'El monto debe ser mayor a cero.',

                'observacion.string' =>
                    'La observación debe ser un texto.',

                'observacion.max' =>
                    'La observación no puede superar los 1000 caracteres.',
            ]
        );

        try {

            $tipoMovimiento = TipoMovimiento::where(
                'id',
                $validated['tipo_movimiento_id']
            )
                ->where(
                    'edificio_id',
                    session('edificio_id')
                )
                ->where('tipo', 'ingreso')
                ->where('estado', true)
                ->first();

            if (!$tipoMovimiento) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'El tipo de ingreso seleccionado no es válido.'
                    );
            }

            $this->cajaService->ingresar(
                $caja,
                (float) $validated['monto'],
                $validated['concepto'],
                null,
                null,
                $validated['observacion'] ?? null,
                $tipoMovimiento->id
            );

            return redirect()
                ->route(
                    'cajas.movimientos',
                    $caja->id
                )
                ->with(
                    'success',
                    'Ingreso registrado correctamente.'
                );

        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EGRESOS
    |--------------------------------------------------------------------------
    */

    public function createEgreso($id)
    {
        $caja = $this->obtenerCaja($id);

        /*
        |--------------------------------------------------------------------------
        | CATÁLOGO DE EGRESOS
        |--------------------------------------------------------------------------
        */

        $tiposEgreso = TipoMovimiento::where(
            'edificio_id',
            session('edificio_id')
        )
            ->where('tipo', 'egreso')
            ->where('estado', true)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();

        return view(
            'cajas.movimientos.egreso',
            compact(
                'caja',
                'tiposEgreso'
            )
        );
    }

    public function storeEgreso(Request $request, $id)
    {
        $caja = $this->obtenerCaja($id);

        $validated = $request->validate(
            [
                'concepto' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'tipo_movimiento_id' => [
                    'required',
                    'integer',
                ],

                'monto' => [
                    'required',
                    'numeric',
                    'gt:0',
                ],

                'observacion' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'concepto.required' =>
                    'El concepto es obligatorio.',

                'concepto.string' =>
                    'El concepto debe ser un texto.',

                'concepto.max' =>
                    'El concepto no puede superar los 255 caracteres.',

                'tipo_movimiento_id.required' =>
                    'Debe seleccionar un tipo de egreso.',

                'tipo_movimiento_id.integer' =>
                    'El tipo de egreso seleccionado no es válido.',

                'monto.required' =>
                    'El monto es obligatorio.',

                'monto.numeric' =>
                    'El monto debe ser un número válido.',

                'monto.gt' =>
                    'El monto debe ser mayor a cero.',

                'observacion.string' =>
                    'La observación debe ser un texto.',

                'observacion.max' =>
                    'La observación no puede superar los 1000 caracteres.',
            ]
        );

        $tipoMovimiento = TipoMovimiento::where(
            'id',
            $validated['tipo_movimiento_id']
        )
            ->where(
                'edificio_id',
                session('edificio_id')
            )
            ->where('tipo', 'egreso')
            ->where('estado', true)
            ->first();

        if (!$tipoMovimiento) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'El tipo de egreso seleccionado no es válido.'
                );
        }

        try {

            $this->cajaService->egresar(
                $caja,
                (float) $validated['monto'],
                $validated['concepto'],
                null,
                null,
                $validated['observacion'] ?? null,
                $tipoMovimiento->id
            );

            return redirect()
                ->route(
                    'cajas.movimientos',
                    $caja->id
                )
                ->with(
                    'success',
                    'Egreso registrado correctamente.'
                );

        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSFERENCIAS
    |--------------------------------------------------------------------------
    */

    public function createTransferencia($id)
    {
        $caja = $this->obtenerCaja($id);

        $cajasDestino = Caja::where(
            'edificio_id',
            session('edificio_id')
        )
            ->where('estado', true)
            ->where('id', '!=', $caja->id)
            ->orderBy('nombre')
            ->get();

        return view(
            'cajas.movimientos.transferencia',
            compact(
                'caja',
                'cajasDestino'
            )
        );
    }

    public function storeTransferencia(
        Request $request,
        $id
    ) {
        $cajaOrigen = $this->obtenerCaja($id);

        $validated = $request->validate(
            [
                'caja_destino_id' => [
                    'required',
                    'integer',
                ],

                'monto' => [
                    'required',
                    'numeric',
                    'gt:0',
                ],

                'concepto' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'observacion' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'caja_destino_id.required' =>
                    'Debe seleccionar una caja de destino.',

                'caja_destino_id.integer' =>
                    'La caja de destino seleccionada no es válida.',

                'monto.required' =>
                    'El monto es obligatorio.',

                'monto.numeric' =>
                    'El monto debe ser un número válido.',

                'monto.gt' =>
                    'El monto debe ser mayor a cero.',

                'concepto.required' =>
                    'El concepto de la transferencia es obligatorio.',

                'concepto.string' =>
                    'El concepto debe ser un texto.',

                'concepto.max' =>
                    'El concepto no puede superar los 255 caracteres.',

                'observacion.string' =>
                    'La observación debe ser un texto.',

                'observacion.max' =>
                    'La observación no puede superar los 1000 caracteres.',
            ]
        );

        $cajaDestino = Caja::where(
            'id',
            $validated['caja_destino_id']
        )
            ->where(
                'edificio_id',
                session('edificio_id')
            )
            ->where('estado', true)
            ->first();

        if (!$cajaDestino) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'La caja de destino no es válida.'
                );
        }

        try {

            $resultado = $this->cajaService->transferir(
                $cajaOrigen,
                $cajaDestino,
                (float) $validated['monto'],
                $validated['concepto'],
                $validated['observacion'] ?? null
            );

            return redirect()
                ->route(
                    'cajas.movimientos',
                    $cajaOrigen->id
                )
                ->with(
                    'success',
                    'Transferencia registrada correctamente. Código: ' .
                    $resultado['transferencia_id']
                );

        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RECIBO DE INGRESO / EGRESO
    |--------------------------------------------------------------------------
    */

    public function recibo($id)
    {
        $movimiento = MovimientoCaja::with([
            'caja.edificio',
            'usuario',
            'usuarioAnulacion',
        ])
            ->where('id', $id)
            ->firstOrFail();

        $this->verificarEdificioCaja(
            $movimiento->caja
        );

        if (
            $movimiento->referencia_tipo === 'transferencia' ||
            $movimiento->transferencia_id
        ) {
            return redirect()->route(
                'cajas.transferencia.recibo',
                $movimiento->transferencia_id
            );
        }

        $pdf = Pdf::loadView(
            'cajas.movimientos.recibos.movimiento',
            compact('movimiento')
        );

        $nombre =
            'recibo-' .
            strtolower($movimiento->tipo) .
            '-' .
            $movimiento->id .
            '.pdf';

        return $pdf->stream($nombre);
    }

    /*
    |--------------------------------------------------------------------------
    | RECIBO DE TRANSFERENCIA
    |--------------------------------------------------------------------------
    */

    public function reciboTransferencia(
        string $transferenciaId
    ) {
        $movimientos = MovimientoCaja::with([
            'caja.edificio',
            'usuario',
            'usuarioAnulacion',
        ])
            ->where(
                'transferencia_id',
                $transferenciaId
            )
            ->where(
                'referencia_tipo',
                'transferencia'
            )
            ->orderBy('tipo')
            ->get();

        if ($movimientos->count() !== 2) {
            abort(
                404,
                'Transferencia no encontrada.'
            );
        }

        foreach ($movimientos as $movimiento) {
            $this->verificarEdificioCaja(
                $movimiento->caja
            );
        }

        $origen = $movimientos->firstWhere(
            'tipo',
            'egreso'
        );

        $destino = $movimientos->firstWhere(
            'tipo',
            'ingreso'
        );

        $pdf = Pdf::loadView(
            'cajas.movimientos.recibos.transferencia',
            compact(
                'movimientos',
                'origen',
                'destino',
                'transferenciaId'
            )
        );

        return $pdf->stream(
            'transferencia-' .
            $transferenciaId .
            '.pdf'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRMAR ANULACIÓN
    |--------------------------------------------------------------------------
    */

    public function confirmarAnulacion($id)
    {
        $movimiento = MovimientoCaja::with('caja')
            ->where('id', $id)
            ->firstOrFail();

        $this->verificarEdificioCaja(
            $movimiento->caja
        );

        if ($movimiento->estado === 'anulado') {
            return redirect()
                ->route(
                    'cajas.movimientos',
                    $movimiento->caja_id
                )
                ->with(
                    'error',
                    'El movimiento ya está anulado.'
                );
        }

        if (
            $movimiento->referencia_tipo ===
            'anulacion_movimiento' ||

            $movimiento->referencia_tipo ===
            'anulacion_transferencia'
        ) {
            return redirect()
                ->route(
                    'cajas.movimientos',
                    $movimiento->caja_id
                )
                ->with(
                    'error',
                    'Este movimiento es una reversión y no puede ser anulado.'
                );
        }

        if ($movimiento->transferencia_id) {

            $movimientosTransferencia =
                MovimientoCaja::where(
                    'transferencia_id',
                    $movimiento->transferencia_id
                )
                    ->where(
                        'referencia_tipo',
                        'transferencia'
                    )
                    ->get();

            return view(
                'cajas.movimientos.anular-transferencia',
                compact(
                    'movimiento',
                    'movimientosTransferencia'
                )
            );
        }

        return view(
            'cajas.movimientos.anular',
            compact('movimiento')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ANULAR MOVIMIENTO
    |--------------------------------------------------------------------------
    */

    public function anular(
        Request $request,
        $id
    ) {
        $movimiento = MovimientoCaja::with('caja')
            ->where('id', $id)
            ->firstOrFail();

        $this->verificarEdificioCaja(
            $movimiento->caja
        );

        $validated = $request->validate(
            [
                'motivo_anulacion' => [
                    'required',
                    'string',
                    'min:5',
                    'max:1000',
                ],
            ],
            [
                'motivo_anulacion.required' =>
                    'Debe indicar el motivo de la anulación.',

                'motivo_anulacion.string' =>
                    'El motivo de la anulación debe ser un texto.',

                'motivo_anulacion.min' =>
                    'El motivo de la anulación debe tener al menos 5 caracteres.',

                'motivo_anulacion.max' =>
                    'El motivo de la anulación no puede superar los 1000 caracteres.',
            ]
        );

        try {

            if ($movimiento->transferencia_id) {

                $this->cajaService->anularTransferencia(
                    $movimiento->transferencia_id,
                    $validated['motivo_anulacion']
                );

                return redirect()
                    ->route(
                        'cajas.movimientos',
                        $movimiento->caja_id
                    )
                    ->with(
                        'success',
                        'La transferencia fue anulada correctamente.'
                    );
            }

            $this->cajaService->anularMovimiento(
                $movimiento,
                $validated['motivo_anulacion']
            );

            return redirect()
                ->route(
                    'cajas.movimientos',
                    $movimiento->caja_id
                )
                ->with(
                    'success',
                    'El movimiento fue anulado correctamente.'
                );

        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | OBTENER CAJA DEL EDIFICIO ACTUAL
    |--------------------------------------------------------------------------
    */

    private function obtenerCaja($id): Caja
    {
        $edificioId = session('edificio_id');

        if (!$edificioId) {
            abort(
                403,
                'No existe un edificio seleccionado.'
            );
        }

        return Caja::where(
            'id',
            $id
        )
            ->where(
                'edificio_id',
                $edificioId
            )
            ->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFICAR EDIFICIO
    |--------------------------------------------------------------------------
    */

    private function verificarEdificioCaja(
        Caja $caja
    ): void {
        if (
            (int) $caja->edificio_id !==
            (int) session('edificio_id')
        ) {
            abort(
                403,
                'No tiene acceso a esta caja.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PDF DE MOVIMIENTOS
    |--------------------------------------------------------------------------
    */

    public function pdf(Request $request, $id)
    {
        $caja = $this->obtenerCaja($id);

        $query = MovimientoCaja::with([
            'usuario',
            'usuarioAnulacion',
            'tipoMovimiento',
        ])
            ->where(
                'caja_id',
                $caja->id
            );

        // FILTRO POR TIPO
        if ($request->filled('tipo')) {
            $query->where(
                'tipo',
                $request->tipo
            );
        }

        // FILTRO POR ESTADO
        if ($request->filled('estado')) {
            $query->where(
                'estado',
                $request->estado
            );
        }

        // FILTRO DESDE
        if ($request->filled('fecha_desde')) {
            $query->whereDate(
                'fecha',
                '>=',
                $request->fecha_desde
            );
        }

        // FILTRO HASTA
        if ($request->filled('fecha_hasta')) {
            $query->whereDate(
                'fecha',
                '<=',
                $request->fecha_hasta
            );
        }

        // BÚSQUEDA
        if ($request->filled('buscar')) {

            $buscar = trim(
                $request->buscar
            );

            $query->where(function ($q) use ($buscar) {

                $q->where(
                    'concepto',
                    'like',
                    '%' . $buscar . '%'
                )
                    ->orWhere(
                        'observacion',
                        'like',
                        '%' . $buscar . '%'
                    )
                    ->orWhere(
                        'transferencia_id',
                        'like',
                        '%' . $buscar . '%'
                    );
            });
        }

        // TODOS LOS RESULTADOS
        $movimientos = $query
            ->orderBy(
                'fecha',
                'desc'
            )
            ->orderBy(
                'id',
                'desc'
            )
            ->get();

        // TOTAL INGRESOS
        $totalIngresos = $movimientos
            ->where(
                'tipo',
                'ingreso'
            )
            ->where(
                'estado',
                'activo'
            )
            ->sum('monto');

        // TOTAL EGRESOS
        $totalEgresos = $movimientos
            ->where(
                'tipo',
                'egreso'
            )
            ->where(
                'estado',
                'activo'
            )
            ->sum('monto');

        // FILTROS UTILIZADOS
        $filtros = [
            'tipo' => $request->tipo,
            'estado' => $request->estado,
            'fecha_desde' => $request->fecha_desde,
            'fecha_hasta' => $request->fecha_hasta,
            'buscar' => $request->buscar,
        ];

        // GENERAR PDF
        $pdf = Pdf::loadView(
            'cajas.movimientos.pdf',
            compact(
                'caja',
                'movimientos',
                'totalIngresos',
                'totalEgresos',
                'filtros'
            )
        );

        $pdf->setPaper(
            'letter',
            'landscape'
        );

        return $pdf->stream(
            'movimientos-caja-' .
            $caja->nombre .
            '.pdf'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXCEL DE MOVIMIENTOS
    |--------------------------------------------------------------------------
    */

    public function excel(Request $request, $id)
    {
        $caja = $this->obtenerCaja($id);

        $query = MovimientoCaja::with([
            'usuario',
            'usuarioAnulacion',
            'tipoMovimiento',
        ])
            ->where(
                'caja_id',
                $caja->id
            );

        // FILTRO POR TIPO
        if ($request->filled('tipo')) {
            $query->where(
                'tipo',
                $request->tipo
            );
        }

        // FILTRO POR ESTADO
        if ($request->filled('estado')) {
            $query->where(
                'estado',
                $request->estado
            );
        }

        // FILTRO DESDE
        if ($request->filled('fecha_desde')) {
            $query->whereDate(
                'fecha',
                '>=',
                $request->fecha_desde
            );
        }

        // FILTRO HASTA
        if ($request->filled('fecha_hasta')) {
            $query->whereDate(
                'fecha',
                '<=',
                $request->fecha_hasta
            );
        }

        // BÚSQUEDA
        if ($request->filled('buscar')) {

            $buscar = trim(
                $request->buscar
            );

            $query->where(function ($q) use ($buscar) {

                $q->where(
                    'concepto',
                    'like',
                    '%' . $buscar . '%'
                )
                    ->orWhere(
                        'observacion',
                        'like',
                        '%' . $buscar . '%'
                    )
                    ->orWhere(
                        'transferencia_id',
                        'like',
                        '%' . $buscar . '%'
                    );
            });
        }

        // TODOS LOS MOVIMIENTOS FILTRADOS
        $movimientos = $query
            ->orderBy(
                'fecha',
                'desc'
            )
            ->orderBy(
                'id',
                'desc'
            )
            ->get();

        return Excel::download(
            new MovimientoCajaExport($movimientos),
            'movimientos-caja-' .
            $caja->nombre .
            '.xlsx'
        );
    }
}