<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Luecano\NumeroALetras\NumeroALetras;
use App\Models\Edificio;
use App\Models\ReciboExpensaTienda;
use App\Models\ExpensaTienda;
use App\Models\Propietario;

class ReciboExpensaTiendaController extends Controller
{
    private function generarNumero()
    {
        $ultimo = ReciboExpensaTienda::orderBy('id', 'desc')->first();

        $numero = $ultimo
            ? ((int) substr($ultimo->numero, 5)) + 1
            : 1;

        return 'RECT-' . str_pad($numero, 6, '0', STR_PAD_LEFT);
    }


    public function index()
    {
        
        $recibos = ReciboExpensaTienda::with([
            'propietario',
            'tienda',
            'expensa'
        ])
            ->where(
                'edificio_id',
                session('edificio_id')
            )
            ->latest()
            ->get();

        return view(
            'recibos_tiendas.index',
            compact('recibos')
        );
    }


    public function obtenerExpensasTiendas($propietario_id)
    {
        return ExpensaTienda::with(['apertura', 'tienda'])
            ->where('propietario_id', $propietario_id)
            ->where('estado', 'PENDIENTE')
            ->where('edificio_id', session('edificio_id'))
            ->get();
    }

    public function create()
    {
        $propietarios = Propietario::all();
        $numero = $this->generarNumero();
        return view('recibos_tiendas.create', compact('propietarios','numero'));
    }


    public function store(Request $request)
    {
        $request->validate([

            'expensa_tienda_id' => 'required',

            'monto' => 'required|numeric|min:0.01',

            'fecha' => 'required',

            'moneda' => 'required',

            'tipo_pago' => 'required',
        ]);

        $expensa = ExpensaTienda::with(
            'apertura'
        )->findOrFail(
                $request->expensa_tienda_id
            );

        if (
            $request->monto >
            $expensa->saldo
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El monto supera el saldo pendiente'
                );
        }

        $numero =
            $this->generarNumero();

        ReciboExpensaTienda::create([

            'numero' => $numero,

            'fecha' => $request->fecha,

            'propietario_id' =>
                $expensa->propietario_id,

            'expensa_tienda_id' =>
                $expensa->id,

            'tienda_id' =>
                $expensa->tienda_id,

            'monto' =>
                $request->monto,

            'moneda' =>
                $request->moneda,

            'mes' =>
                $expensa->apertura->mes,

            'gestion' =>
                $expensa->apertura->gestion,

            'tipo_pago' =>
                $request->tipo_pago,

            'numero_deposito' =>
                $request->numero_deposito,

            'edificio_id' =>
                session('edificio_id'),
        ]);

        $nuevoPagado =
            $expensa->pagado +
            $request->monto;

        $nuevoSaldo =
            $expensa->saldo -
            $request->monto;

        $estado =
            $nuevoSaldo <= 0
            ? 'PAGADO'
            : 'PENDIENTE';

        $expensa->update([

            'pagado' =>
                $nuevoPagado,

            'saldo' =>
                max(0, $nuevoSaldo),

            'estado' =>
                $estado,
        ]);

        return redirect()
            ->route(
                'recibos_tiendas.index'
            )
            ->with(
                'success',
                'Pago registrado correctamente'
            );
    }

    public function edit($id)
    {
        $recibo = ReciboExpensaTienda::with([
            'propietario',
            'tienda',
            'expensa'
        ])->findOrFail($id);

        return view(
            'recibos_tiendas.edit',
            compact('recibo')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'monto' => 'required|numeric|min:0.01',

            'tipo_pago' => 'required',

        ]);

        DB::transaction(function () use ($request, $id) {

            $recibo = ReciboExpensaTienda::findOrFail($id);

            $expensa = ExpensaTienda::findOrFail(
                $recibo->expensa_tienda_id
            );

            /*
            |----------------------------------------------------
            | DEVOLVER PAGO ANTERIOR
            |----------------------------------------------------
            */

            $expensa->pagado -= $recibo->monto;

            $expensa->saldo += $recibo->monto;

            /*
            |----------------------------------------------------
            | VALIDAR
            |----------------------------------------------------
            */

            if ($request->monto > $expensa->saldo) {

                throw new \Exception(
                    'El monto supera el saldo pendiente.'
                );

            }

            /*
            |----------------------------------------------------
            | NUEVO PAGO
            |----------------------------------------------------
            */

            $expensa->pagado += $request->monto;

            $expensa->saldo -= $request->monto;

            $expensa->estado =
                $expensa->saldo <= 0
                ? 'PAGADO'
                : 'PENDIENTE';

            if ($expensa->saldo < 0) {

                $expensa->saldo = 0;

            }

            $expensa->save();

            /*
            |----------------------------------------------------
            | RECIBO
            |----------------------------------------------------
            */

            $recibo->update([

                'monto' => $request->monto,

                'tipo_pago' => $request->tipo_pago,

                'numero_deposito' =>
                    $request->numero_deposito,

            ]);

        });

        return redirect()
            ->route('recibos_tiendas.index')
            ->with(
                'success',
                'Recibo actualizado correctamente.'
            );
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $recibo = ReciboExpensaTienda::findOrFail($id);

            $expensa = ExpensaTienda::findOrFail(
                $recibo->expensa_tienda_id
            );

            /*
            |-----------------------------------------
            | DEVOLVER SALDO
            |-----------------------------------------
            */

            $expensa->pagado -= $recibo->monto;

            $expensa->saldo += $recibo->monto;

            $expensa->estado =
                $expensa->saldo <= 0
                ? 'PAGADO'
                : 'PENDIENTE';

            $expensa->save();

            $recibo->delete();

        });

        return redirect()
            ->route('recibos_tiendas.index')
            ->with(
                'success',
                'Recibo eliminado correctamente.'
            );
    }

    public function pdf($id)
    {
        $recibo = ReciboExpensaTienda::with([

            'propietario',

            'tienda',

        ])->findOrFail($id);

        $edificio = Edificio::findOrFail(
            session('edificio_id')
        );

        $formatter = new NumeroALetras();

        $montoLiteral =
            $formatter->toWords(
                $recibo->monto
            );

        $pdf = Pdf::loadView(

            'recibos_tiendas.pdf',

            compact(

                'recibo',

                'edificio',

                'montoLiteral'

            )

        );

        $pdf->setPaper(
            'letter',
            'portrait'
        );

        return $pdf->stream(

            'recibo-tienda-' .
            $recibo->numero .
            '.pdf'

        );
    }

    public function obtenerExpensas($propietario_id)
    {
        return ExpensaTienda::with(['apertura', 'tienda'])
            ->where('propietario_id', $propietario_id)
            ->where('estado', 'PENDIENTE')
            ->where('edificio_id', session('edificio_id'))
            ->get();
    }
}
