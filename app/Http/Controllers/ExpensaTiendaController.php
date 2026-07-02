<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpensaTienda;
use App\Models\Propietario;
use App\Models\AperturaExpensa;
use App\Models\Tienda;

class ExpensaTiendaController extends Controller
{
    public function index()
    {
        $expensas = ExpensaTienda::with([
            'tienda',
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
            'expensas_tiendas.index',
            compact('expensas')
        );
    }

    public function create()
    {
        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $tiendas = Tienda::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $aperturas = AperturaExpensa::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view(
            'expensas_tiendas.create',
            compact(
                'propietarios',
                'tiendas',
                'aperturas'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'total' => 'required|numeric|min:0',

            'tienda_id' => 'required|exists:tiendas,id',

            'propietario_id' => 'required|exists:propietarios,id',

            'apertura_expensa_id' => 'required|exists:apertura_expensas,id',
        ]);

        ExpensaTienda::create([

            'total' => $request->total,

            'pagado' => 0,

            'saldo' => $request->total,

            'estado' => 'PENDIENTE',

            'tienda_id' => $request->tienda_id,

            'propietario_id' => $request->propietario_id,

            'edificio_id' => session('edificio_id'),

            'apertura_expensa_id' => $request->apertura_expensa_id,
        ]);

        return redirect()
            ->route('expensas_tiendas.index')
            ->with(
                'success',
                'Registro creado correctamente'
            );
    }

    public function edit($id)
    {
        $expensa = ExpensaTienda::where(
            'edificio_id',
            session('edificio_id')
        )
            ->findOrFail($id);

        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $tiendas = Tienda::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $aperturas = AperturaExpensa::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view(
            'expensas_tiendas.edit',
            compact(
                'expensa',
                'propietarios',
                'tiendas',
                'aperturas'
            )
        );
    }

    public function update(
        Request $request,
        $id
    ) {
        $request->validate([

            'total' => 'required|numeric|min:0',

            'tienda_id' => 'required|exists:tiendas,id',

            'propietario_id' => 'required|exists:propietarios,id',

            'apertura_expensa_id' => 'required|exists:apertura_expensas,id',
        ]);

        $expensa = ExpensaTienda::where(
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

            'tienda_id' =>
                $request->tienda_id,

            'propietario_id' =>
                $request->propietario_id,

            'apertura_expensa_id' =>
                $request->apertura_expensa_id,
        ]);

        return redirect()
            ->route('expensas_tiendas.index')
            ->with(
                'success',
                'Registro actualizado correctamente'
            );
    }

    public function destroy($id)
    {
        $expensa = ExpensaTienda::where(
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
            ->route('expensas_tiendas.index')
            ->with(
                'success',
                'Registro eliminado correctamente'
            );
    }
    public function expensasPorApertura(AperturaExpensa $apertura)
    {
        $expensas = ExpensaTienda::with([
            'tienda',
            'propietario',
            'apertura'
        ])
            ->where('apertura_expensa_id', $apertura->id)
            ->where('edificio_id', session('edificio_id'))
            ->get();

        return view(
            'expensas_tiendas.index',
            compact('expensas')
        );
    }
}