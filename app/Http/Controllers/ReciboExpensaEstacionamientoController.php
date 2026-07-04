<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Luecano\NumeroALetras\NumeroALetras;

use App\Models\Edificio;
use App\Models\Propietario;
use App\Models\Estacionamiento;
use App\Models\ExpensaEstacionamiento;
use App\Models\ReciboExpensaEstacionamiento;

class ReciboExpensaEstacionamientoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GENERAR NÚMERO (MISMO ESTILO TIENDAS)
    |--------------------------------------------------------------------------
    */
    private function generarNumero()
    {
        $ultimo = ReciboExpensaEstacionamiento::orderBy('id', 'desc')->first();

        $numero = $ultimo
            ? ((int) substr($ultimo->numero, 6)) + 1
            : 1;

        return 'REST-' . str_pad($numero, 6, '0', STR_PAD_LEFT);
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $recibos = ReciboExpensaEstacionamiento::with([
            'propietario',
            'estacionamiento',
            'expensa'
        ])
            ->where('edificio_id', session('edificio_id'))
            ->latest()
            ->get();

        return view('recibos_estacionamientos.index', compact('recibos'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $propietarios = Propietario::all();
        $numero = $this->generarNumero();
        $edificio_id = session('edificio_id');
        return view(
            'recibos_estacionamientos.create',
            compact('propietarios', 'numero', 'edificio_id')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX EXPENSAS
    |--------------------------------------------------------------------------
    */
    public function obtenerExpensas($propietario_id)
    {
        return ExpensaEstacionamiento::with(['apertura', 'estacionamiento'])
            ->where('propietario_id', $propietario_id)
            ->where('estado', 'PENDIENTE')
            ->where('edificio_id', session('edificio_id'))
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'expensa_estacionamiento_id' => 'required',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required',
            'moneda' => 'required',
            'tipo_pago' => 'required',
        ]);

        $expensa = ExpensaEstacionamiento::with('apertura')
            ->findOrFail($request->expensa_estacionamiento_id);

        if ($request->monto > $expensa->saldo) {
            return back()
                ->withInput()
                ->with('error', 'El monto supera el saldo pendiente');
        }

        $numero = $this->generarNumero();

        ReciboExpensaEstacionamiento::create([
            'numero' => $numero,
            'fecha' => $request->fecha,
            'propietario_id' => $expensa->propietario_id,
            'expensa_estacionamiento_id' => $expensa->id,
            'estacionamiento_id' => $expensa->estacionamiento_id,
            'monto' => $request->monto,
            'moneda' => $request->moneda,
            'mes' => $expensa->apertura->mes,
            'gestion' => $expensa->apertura->gestion,
            'tipo_pago' => $request->tipo_pago,
            'numero_deposito' => $request->numero_deposito,
            'edificio_id' => session('edificio_id'),
        ]);

        $expensa->pagado += $request->monto;
        $expensa->saldo -= $request->monto;

        $expensa->estado = $expensa->saldo <= 0 ? 'PAGADO' : 'PENDIENTE';

        if ($expensa->saldo < 0) {
            $expensa->saldo = 0;
        }

        $expensa->save();

        if ($request->origen == 'estacionamientos') {

            return redirect()
                ->route(
                    'expensas_estacionamientos.index',
                    $expensa->apertura_expensa_estacionamiento_id
                )
                ->with(
                    'success',
                    'Pago registrado correctamente'
                );
        }

        return redirect()
            ->route('recibos_estacionamientos.index')
            ->with(
                'success',
                'Recibo generado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $recibo = ReciboExpensaEstacionamiento::with([
            'propietario',
            'estacionamiento',
            'expensa'
        ])->findOrFail($id);

        return view('recibos_estacionamientos.edit', compact('recibo'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0.01',
            'tipo_pago' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {

            $recibo = ReciboExpensaEstacionamiento::findOrFail($id);

            $expensa = ExpensaEstacionamiento::findOrFail(
                $recibo->expensa_estacionamiento_id
            );

            // revertir anterior
            $expensa->pagado -= $recibo->monto;
            $expensa->saldo += $recibo->monto;

            if ($request->monto > $expensa->saldo) {
                throw new \Exception('El monto supera el saldo pendiente');
            }

            // nuevo pago
            $expensa->pagado += $request->monto;
            $expensa->saldo -= $request->monto;

            $expensa->estado = $expensa->saldo <= 0 ? 'PAGADO' : 'PENDIENTE';

            if ($expensa->saldo < 0) {
                $expensa->saldo = 0;
            }

            $expensa->save();

            $recibo->update([
                'monto' => $request->monto,
                'tipo_pago' => $request->tipo_pago,
                'numero_deposito' => $request->numero_deposito,
            ]);
        });

        return redirect()
            ->route('recibos_estacionamientos.index')
            ->with('success', 'Recibo actualizado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $recibo = ReciboExpensaEstacionamiento::findOrFail($id);

            $expensa = ExpensaEstacionamiento::findOrFail(
                $recibo->expensa_estacionamiento_id
            );

            $expensa->pagado -= $recibo->monto;
            $expensa->saldo += $recibo->monto;

            $expensa->estado = 'PENDIENTE';

            $expensa->save();

            $recibo->delete();
        });

        return redirect()
            ->route('recibos_estacionamientos.index')
            ->with('success', 'Recibo eliminado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */
    public function pdf($id)
    {
        $recibo = ReciboExpensaEstacionamiento::with([
            'propietario',
            'estacionamiento'
        ])->findOrFail($id);

        $edificio = Edificio::findOrFail(session('edificio_id'));

        $formatter = new NumeroALetras();

        $montoLiteral = $formatter->toWords($recibo->monto);

        $pdf = Pdf::loadView(
            'recibos_estacionamientos.pdf',
            compact('recibo', 'edificio', 'montoLiteral')
        );

        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream(
            'recibo-estacionamiento-' . $recibo->numero . '.pdf'
        );
    }
}