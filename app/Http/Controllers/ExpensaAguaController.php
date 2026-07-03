<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ExpensaAgua;
use App\Models\Departamento;
use App\Models\Propietario;
use App\Models\AperturaExpensa;

class ExpensaAguaController extends Controller
{
    public function index()
    {
        $expensas = ExpensaAgua::with([
            'departamento',
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
            'expensas_aguas.index',
            compact('expensas')
        );
    }

    public function create()
    {
        $departamentos = Departamento::with('propietario')
            ->where(
                'edificio_id',
                session('edificio_id')
            )
            ->orderBy('numero_departamento')
            ->get();

        $aperturas = AperturaExpensa::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view(
            'expensas_aguas.create',
            compact(
                'departamentos',
                'aperturas'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'departamento_id' => 'required',

            'apertura_expensa_id' => 'required',

        ]);

        $departamento = Departamento::findOrFail(
            $request->departamento_id
        );

        /*
        |------------------------------------------
        | BUSCAR LA ÚLTIMA LECTURA
        |------------------------------------------
        */

        $ultimaLectura = ExpensaAgua::where(
            'departamento_id',
            $departamento->id
        )
            ->where(
                'edificio_id',
                session('edificio_id')
            )
            ->latest()
            ->first();

        ExpensaAgua::create([

            'departamento_id' => $departamento->id,
            'propietario_id' => $departamento->propietario_id,
            'edificio_id' => session('edificio_id'),
            'apertura_expensa_id' => $request->apertura_expensa_id,
            'total' => $request->total,
            'pagado' => 0,
            'saldo' => $request->total,
            'estado' => 'PENDIENTE',
            'lectura_anterior' => optional($ultimaLectura)->lectura_actual,
            'lectura_actual' => $request->lectura_actual ?? null,
            'lectura_pagar' => $request->lectura_pagar ?? null,
            'prorrateo' => $request->prorrateo ?? null,

        ]);

        return redirect()
            ->route('expensas_aguas.index')
            ->with(
                'success',
                'Expensa de agua registrada correctamente.'
            );
    }

    public function edit($id)
    {
        $expensa = ExpensaAgua::where(
            'edificio_id',
            session('edificio_id')
        )->findOrFail($id);

        $departamentos = Departamento::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        $aperturas = AperturaExpensa::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view(
            'expensas_aguas.edit',
            compact(
                'expensa',
                'departamentos',
                'propietarios',
                'aperturas'
            )
        );
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $expensa = ExpensaAgua::where(
            'edificio_id',
            session('edificio_id')
        )->findOrFail($id);

        $expensa->delete();

        return redirect()
            ->route('expensas_aguas.index')
            ->with(
                'success',
                'Registro eliminado correctamente'
            );
    }

    public function getDepartamento($id)
    {
        $departamento = Departamento::with('propietario')
            ->findOrFail($id);

        $ultima = ExpensaAgua::where('departamento_id', $id)
            ->where('edificio_id', session('edificio_id'))
            ->latest()
            ->first();

        return response()->json([

            'propietario' => $departamento->propietario->nombres ?? '',

            'lectura_anterior' => $ultima->lectura_actual ?? 0

        ]);
    }
}