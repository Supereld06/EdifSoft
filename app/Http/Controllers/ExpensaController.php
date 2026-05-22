<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expensa;
use App\Models\Departamento;
use App\Models\Propietario;
use App\Models\AperturaExpensa;

class ExpensaController extends Controller
{
    /**
     * LISTADO
     */
    public function index()
    {
        $expensas = Expensa::with([
            'departamento',
            'propietario',
            'edificio',
            'apertura'
        ])
        ->latest()
        ->get();

        return view(
            'expensas.index',
            compact('expensas')
        );
    }

    /**
     * FORMULARIO
     */
    public function create()
    {
        $departamentos = Departamento::all();

        $propietarios = Propietario::all();

        $aperturas = AperturaExpensa::all();

        return view(
            'expensas.create',
            compact(
                'departamentos',
                'propietarios',
                'aperturas'
            )
        );
    }

    /**
     * GUARDAR
     */
    public function store(Request $request)
    {
        $request->validate([

            'total' => 'required|numeric',

            'departamento_id' => 'required',

            'propietario_id' => 'required',

            'apertura_expensa_id' => 'required',

        ]);

        // EDIFICIO DESDE SESSION
        $edificio_id = session('edificio_id');

        Expensa::create([

            'total' => $request->total,

            'pagado' => $request->pagado ?? 0,

            'saldo' => $request->total - ($request->pagado ?? 0),

            'estado' => (
                ($request->total - ($request->pagado ?? 0)) <= 0
            )
                ? 'PAGADO'
                : 'PENDIENTE',

            'departamento_id' => $request->departamento_id,

            'propietario_id' => $request->propietario_id,

            'edificio_id' => $edificio_id,

            'apertura_expensa_id' => $request->apertura_expensa_id,

        ]);

        return redirect()
            ->route('expensas.index')
            ->with(
                'success',
                'Expensa registrada correctamente'
            );
    }

    /**
     * EDITAR
     */
    public function edit(Expensa $expensa)
    {
        $departamentos = Departamento::all();

        $propietarios = Propietario::all();

        $aperturas = AperturaExpensa::all();

        return view(
            'expensas.edit',
            compact(
                'expensa',
                'departamentos',
                'propietarios',
                'aperturas'
            )
        );
    }

    /**
     * ACTUALIZAR
     */
    public function update(
        Request $request,
        Expensa $expensa
    )
    {
        $saldo = $request->total - $request->pagado;

        $estado = $saldo <= 0
            ? 'PAGADO'
            : 'PENDIENTE';

        $expensa->update([

            'total' => $request->total,

            'pagado' => $request->pagado,

            'saldo' => $saldo,

            'estado' => $estado,

            'departamento_id' => $request->departamento_id,

            'propietario_id' => $request->propietario_id,

            'apertura_expensa_id' => $request->apertura_expensa_id,

        ]);

        return redirect()
            ->route('expensas.index')
            ->with(
                'success',
                'Expensa actualizada correctamente'
            );
    }

    /**
     * ELIMINAR
     */
    public function destroy(Expensa $expensa)
    {
        $expensa->delete();

        return redirect()
            ->route('expensas.index')
            ->with(
                'success',
                'Expensa eliminada correctamente'
            );
    }
}