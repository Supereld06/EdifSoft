<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpensaEstacionamiento;
use App\Models\Propietario;
use App\Models\Estacionamiento;
use App\Models\AperturaExpensa;

class ExpensaEstacionamientoController extends Controller
{
    public function index()
    {
        $expensas = ExpensaEstacionamiento::with([
            'estacionamiento',
            'propietario',
            'apertura'
        ])
        ->where(
            'edificio_id',
            session('edificio_id')
        )
        ->orderByDesc('id')
        ->get();

        return view(
            'expensas_estacionamientos.index',
            compact('expensas')
        );
    }

    public function create()
    {
        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $estacionamientos = Estacionamiento::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $aperturas = AperturaExpensa::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view(
            'expensas_estacionamientos.create',
            compact(
                'propietarios',
                'estacionamientos',
                'aperturas'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'total' => 'required|numeric|min:0',

            'estacionamiento_id' => 'required|exists:estacionamientos,id',

            'propietario_id' => 'required|exists:propietarios,id',

            'apertura_expensa_id' => 'required|exists:apertura_expensas,id',
        ]);

        ExpensaEstacionamiento::create([

            'total' => $request->total,

            'pagado' => 0,

            'saldo' => $request->total,

            'estado' => 'PENDIENTE',

            'estacionamiento_id' => $request->estacionamiento_id,

            'propietario_id' => $request->propietario_id,

            'edificio_id' => session('edificio_id'),

            'apertura_expensa_id' => $request->apertura_expensa_id,
        ]);

        return redirect()
            ->route('expensas_estacionamientos.index')
            ->with(
                'success',
                'Registro creado correctamente'
            );
    }

    public function edit($id)
    {
        $expensa = ExpensaEstacionamiento::where(
            'edificio_id',
            session('edificio_id')
        )
        ->findOrFail($id);

        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $estacionamientos = Estacionamiento::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $aperturas = AperturaExpensa::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view(
            'expensas_estacionamientos.edit',
            compact(
                'expensa',
                'propietarios',
                'estacionamientos',
                'aperturas'
            )
        );
    }

    public function update(
        Request $request,
        $id
    )
    {
        $request->validate([

            'total' => 'required|numeric|min:0',

            'estacionamiento_id' => 'required',

            'propietario_id' => 'required',

            'apertura_expensa_id' => 'required',
        ]);

        $expensa = ExpensaEstacionamiento::where(
            'edificio_id',
            session('edificio_id')
        )
        ->findOrFail($id);

        $saldo =
            $request->total -
            $expensa->pagado;

        $estado =
            $saldo <= 0
            ? 'PAGADO'
            : 'PENDIENTE';

        $expensa->update([

            'total' => $request->total,

            'saldo' => $saldo,

            'estado' => $estado,

            'estacionamiento_id' =>
                $request->estacionamiento_id,

            'propietario_id' =>
                $request->propietario_id,

            'apertura_expensa_id' =>
                $request->apertura_expensa_id,
        ]);

        return redirect()
            ->route('expensas_estacionamientos.index')
            ->with(
                'success',
                'Registro actualizado correctamente'
            );
    }

    public function destroy($id)
    {
        $expensa = ExpensaEstacionamiento::where(
            'edificio_id',
            session('edificio_id')
        )
        ->findOrFail($id);

        if ($expensa->pagado > 0) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'No puede eliminar una expensa con pagos registrados'
                );
        }

        $expensa->delete();

        return redirect()
            ->route('expensas_estacionamientos.index')
            ->with(
                'success',
                'Registro eliminado correctamente'
            );
    }
}