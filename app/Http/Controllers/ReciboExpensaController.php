<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ReciboExpensa;
use App\Models\Propietario;
use App\Models\Expensa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Edificio;
use Luecano\NumeroALetras\NumeroALetras;


class ReciboExpensaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $recibos = ReciboExpensa::with([
            'propietario',
            'expensa',
            'departamento'
        ])->get();

        return view(
            'recibos_expensas.index',
            compact('recibos')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $propietarios = Propietario::whereHas(
            'expensas',
            function ($q) {

                $q->where('estado', 'PENDIENTE');

            }
        )->get();

        return view(
            'recibos_expensas.create',
            compact('propietarios')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'numero' => 'required',

            'fecha' => 'required',

            'propietario_id' => 'required',

            'expensa_id' => 'required',

            'monto' => 'required|numeric|min:0.01',

            'moneda' => 'required',

            'tipo_pago' => 'required',

        ]);

        /*
        |--------------------------------------------------------------------------
        | OBTENER EXPENSA
        |--------------------------------------------------------------------------
        */

        $expensa = Expensa::with('apertura')
            ->findOrFail($request->expensa_id);

        /*
        |--------------------------------------------------------------------------
        | VALIDAR MONTO
        |--------------------------------------------------------------------------
        */

        if ($request->monto > $expensa->saldo) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El monto no puede ser mayor al saldo pendiente'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CREAR RECIBO
        |--------------------------------------------------------------------------
        */

        ReciboExpensa::create([

            'numero' => $request->numero,

            'fecha' => $request->fecha,

            'propietario_id' => $request->propietario_id,

            'expensa_id' => $request->expensa_id,

            'departamento_id' => $expensa->departamento_id,

            'monto' => $request->monto,

            'moneda' => $request->moneda,

            'mes' => $expensa->apertura->mes,

            'gestion' => $expensa->apertura->gestion,

            'tipo_pago' => $request->tipo_pago,

            'numero_deposito' => $request->numero_deposito,

            'edificio_id' => session('edificio_id'),

        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR EXPENSA
        |--------------------------------------------------------------------------
        */

        $nuevoPagado =
            $expensa->pagado + $request->monto;

        $nuevoSaldo =
            $expensa->saldo - $request->monto;

        /*
        |--------------------------------------------------------------------------
        | ESTADO
        |--------------------------------------------------------------------------
        */

        $estado = 'PENDIENTE';

        if ($nuevoSaldo <= 0) {

            $estado = 'PAGADO';

            $nuevoSaldo = 0;
        }

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR
        |--------------------------------------------------------------------------
        */

        $expensa->update([

            'pagado' => $nuevoPagado,

            'saldo' => $nuevoSaldo,

            'estado' => $estado,

        ]);

        return redirect()
            ->route('recibos_expensas.index')
            ->with(
                'success',
                'Recibo generado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

    public function obtenerExpensas($propietario_id)
    {
        $expensas = Expensa::with([
            'apertura',
            'departamento'
        ])

            ->where('propietario_id', $propietario_id)

            ->where('estado', 'PENDIENTE')

            ->where('edificio_id', session('edificio_id'))

            ->get();

        return response()->json($expensas);
    }


    /// RUTAS DE pdf
    public function pdf($id)
    {
        // ============================
        // OBTENER RECIBO
        // ============================

        $recibo = ReciboExpensa::with([
            'propietario',
            'departamento',
        ])->findOrFail($id);

        // ============================
        // OBTENER EDIFICIO
        // ============================

        $edificio = Edificio::findOrFail(
            session('edificio_id')
        );

        // ============================
        // MONTO EN LITERAL
        // ============================

        $formatter = new NumeroALetras();

        $montoLiteral = $formatter->toWords(
            $recibo->monto
        );

        // ============================
        // GENERAR PDF
        // ============================

        $pdf = Pdf::loadView(
            'recibos_expensas.pdf',
            compact(
                'recibo',
                'edificio',
                'montoLiteral'
            )
        );

        // ============================
        // TAMAÑO PERSONALIZADO
        // 15cm x 10cm horizontal
        // ============================

        $pdf->setPaper([0, 0, 612, 396]);

        // ============================
        // RETORNAR PDF
        // ============================

        return $pdf->stream(
            'recibo-expensa-' .
            $recibo->numero .
            '.pdf'
        );
    }

    /// delete

    public function destroy($id)
    {
        $recibo = ReciboExpensa::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | DEVOLVER SALDO A EXPENSA
        |--------------------------------------------------------------------------
        */

        $expensa = Expensa::findOrFail(
            $recibo->expensa_id
        );

        $nuevoPagado =
            $expensa->pagado - $recibo->monto;

        $nuevoSaldo =
            $expensa->saldo + $recibo->monto;

        $estado = 'PENDIENTE';

        if ($nuevoSaldo <= 0) {

            $estado = 'PAGADO';
        }

        $expensa->update([

            'pagado' => $nuevoPagado,

            'saldo' => $nuevoSaldo,

            'estado' => $estado,

        ]);

        /*
        |--------------------------------------------------------------------------
        | ELIMINAR RECIBO
        |--------------------------------------------------------------------------
        */

        $recibo->delete();

        return redirect()
            ->route('recibos_expensas.index')
            ->with(
                'success',
                'Recibo eliminado correctamente'
            );
    }

    /// edit

    public function edit($id)
    {
        $recibo = ReciboExpensa::findOrFail($id);

        return view(
            'recibos_expensas.edit',
            compact('recibo')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'monto' => 'required|numeric|min:0.01',

        ]);

        $recibo = ReciboExpensa::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | OBTENER EXPENSA
        |--------------------------------------------------------------------------
        */

        $expensa = Expensa::findOrFail(
            $recibo->expensa_id
        );

        /*
        |--------------------------------------------------------------------------
        | RESTAR MONTO ANTERIOR
        |--------------------------------------------------------------------------
        */

        $expensa->pagado =
            $expensa->pagado - $recibo->monto;

        $expensa->saldo =
            $expensa->saldo + $recibo->monto;

        /*
        |--------------------------------------------------------------------------
        | VALIDAR NUEVO MONTO
        |--------------------------------------------------------------------------
        */

        if ($request->monto > $expensa->saldo) {

            return back()
                ->with(
                    'error',
                    'El monto excede el saldo'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | APLICAR NUEVO PAGO
        |--------------------------------------------------------------------------
        */

        $expensa->pagado =
            $expensa->pagado + $request->monto;

        $expensa->saldo =
            $expensa->saldo - $request->monto;

        /*
        |--------------------------------------------------------------------------
        | ESTADO
        |--------------------------------------------------------------------------
        */

        $estado = 'PENDIENTE';

        if ($expensa->saldo <= 0) {

            $estado = 'PAGADO';

            $expensa->saldo = 0;
        }

        $expensa->estado = $estado;

        $expensa->save();

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR RECIBO
        |--------------------------------------------------------------------------
        */

        $recibo->update([

            'monto' => $request->monto,

            'tipo_pago' => $request->tipo_pago,

            'numero_deposito' => $request->numero_deposito,

        ]);

        return redirect()
            ->route('recibos_expensas.index')
            ->with(
                'success',
                'Recibo actualizado'
            );
    }
}