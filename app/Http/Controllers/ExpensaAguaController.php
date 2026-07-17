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
            ->orderBy('id', 'desc')
            ->paginate(10);

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
        )->orderBy('id', 'desc')
            ->get();

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

            'departamento_id' => 'required|exists:departamentos,id',
            'apertura_expensa_id' => 'required|exists:apertura_expensas,id',
            'lectura_actual' => 'required|numeric|min:0',
            'prorrateo' => 'required|numeric|min:0',

        ]);

        $departamento = Departamento::findOrFail(
            $request->departamento_id
        );

        $existe = ExpensaAgua::where(
            'departamento_id',
            $request->departamento_id
        )
            ->where(
                'apertura_expensa_id',
                $request->apertura_expensa_id
            )
            ->exists();

        if ($existe) {

            return back()
                ->withErrors([
                    'departamento_id' =>
                        'Este departamento ya tiene registrada la expensa de agua para este mes.'
                ])
                ->withInput();

        }

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

        if ($ultimaLectura) {

            $lecturaAnterior = $ultimaLectura->lectura_actual;

        } else {

            $lecturaAnterior = $request->lectura_anterior;

        }

        if ($request->lectura_actual < $lecturaAnterior) {

            return back()
                ->withErrors([
                    'lectura_actual' =>
                        'La lectura actual no puede ser menor que la lectura anterior.'
                ])
                ->withInput();

        }

        $lecturaPagar =

            $request->lectura_actual
            -
            $lecturaAnterior;

        $total =

            $lecturaPagar
            *
            $request->prorrateo;

        $saldo = $total;

        $estado =

            $saldo == 0
            ? 'PAGADO'

            : 'PENDIENTE';

        ExpensaAgua::create([

            'departamento_id' => $departamento->id,
            'propietario_id' => $departamento->propietario_id,
            'edificio_id' => session('edificio_id'),
            'apertura_expensa_id' => $request->apertura_expensa_id,
            'total' => $total,
            'pagado' => 0,
            'saldo' => $saldo,
            'estado' => $estado,
            'lectura_anterior' => $lecturaAnterior,
            'lectura_actual' => $request->lectura_actual,
            'lectura_pagar' => $lecturaPagar,
            'prorrateo' => $request->prorrateo,

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
        $expensa = ExpensaAgua::where(
            'edificio_id',
            session('edificio_id')
        )->findOrFail($id);

        $request->validate([

            'lectura_anterior' => 'required|numeric|min:0',
            'lectura_actual' => 'required|numeric|min:0',
            'prorrateo' => 'required|numeric|min:0',
            'apertura_expensa_id' => 'required|exists:apertura_expensas,id',

        ]);

        // 🔁 VALIDAR LECTURA
        if ($request->lectura_actual < $request->lectura_anterior) {
            return back()->withErrors([
                'lectura_actual' => 'La lectura actual no puede ser menor que la anterior.'
            ])->withInput();
        }

        // 📊 CÁLCULOS
        $lecturaPagar = $request->lectura_actual - $request->lectura_anterior;

        if ($lecturaPagar < 0) {
            $lecturaPagar = 0;
        }

        $total = $lecturaPagar * $request->prorrateo;

        // 💰 CONSERVAR PAGOS EXISTENTES
        $pagado = $expensa->pagado ?? 0;

        $saldo = $total - $pagado;

        if ($saldo < 0) {
            $saldo = 0;
        }

        // 📌 ESTADO
        if ($saldo == 0) {
            $estado = 'PAGADO';
        } elseif ($pagado > 0) {
            $estado = 'PARCIAL';
        } else {
            $estado = 'PENDIENTE';
        }

        $expensa->update([

            'apertura_expensa_id' => $request->apertura_expensa_id,

            'lectura_anterior' => $request->lectura_anterior,
            'lectura_actual' => $request->lectura_actual,
            'lectura_pagar' => $lecturaPagar,
            'prorrateo' => $request->prorrateo,

            'total' => $total,
            'saldo' => $saldo,
            'estado' => $estado,

        ]);

        return redirect()
            ->route('expensas_aguas.index')
            ->with('success', 'Expensa de agua actualizada correctamente');
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

        $ultimaLectura = ExpensaAgua::where(
            'departamento_id',
            $id
        )
            ->where(
                'edificio_id',
                session('edificio_id')
            )
            ->latest()
            ->first();

        return response()->json([
            'propietario' => $departamento->propietario->nombres,
            'propietario_id' => $departamento->propietario_id,
            'lectura_anterior' => $ultimaLectura
                ? $ultimaLectura->lectura_actual
                : null,

            'existe_lectura' => $ultimaLectura ? true : false

        ]);

    }

    public function getApertura($id)
    {
        $apertura = AperturaExpensa::findOrFail($id);

        return response()->json([
            'prorrateo_agua' => $apertura->prorrateo_agua
        ]);
    }
}