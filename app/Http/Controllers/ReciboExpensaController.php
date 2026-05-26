<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ReciboExpensa;
use App\Models\Propietario;
use App\Models\Expensa;

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

        return view('recibos_expensas.index', compact('recibos'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $propietarios = Propietario::whereHas('expensas', function ($q) {

            $q->where('estado', 'PENDIENTE');

        })->get();

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

            'monto' => 'required',

            'moneda' => 'required',

            'tipo_pago' => 'required',

        ]);

        $expensa = Expensa::with('apertura')
            ->findOrFail($request->expensa_id);

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
            $expensa->total - $nuevoPagado;

        $estado = 'PENDIENTE';

        if ($nuevoSaldo <= 0) {

            $estado = 'PAGADO';

            $nuevoSaldo = 0;
        }

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
}