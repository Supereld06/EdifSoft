<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edificio;
use App\Models\AperturaExpensa;
use App\Models\Departamento;
use App\Models\Expensa;
use App\Models\Tienda;
use App\Models\Estacionamiento;
use App\Models\ExpensaTienda;
use App\Models\ExpensaEstacionamiento;
use App\Models\ExpensaAgua;

class AperturaExpensaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aperturas = AperturaExpensa::with('edificio')
            ->latest()
            ->get();

        return view(
            'expensas.aperturas.index',
            compact('aperturas')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session('edificio_id')) {
            return redirect()->route('edificios.seleccionar');
        }

        $edificio_id = session('edificio_id');

        return view(
            'expensas.aperturas.create',
            compact('edificio_id')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'mes' => 'required',
            'gestion' => 'required|integer',
            'saldo_inicial' => 'required|numeric',
            'efectivo_inicial' => 'required|numeric',
            'expensa_departamentos' => 'required|numeric',
            'expensa_tiendas' => 'required|numeric',
            'expensa_parqueo' => 'required|numeric',
            'factura_agua' => 'required|numeric',
            'prorrateo_agua' => 'required|numeric',
            'edificio_id' => 'required|exists:edificios,id',

        ]);

        // VALIDAR SI YA EXISTE APERTURA
        $existe = AperturaExpensa::where('mes', $request->mes)
            ->where('gestion', $request->gestion)
            ->where('edificio_id', $request->edificio_id)
            ->exists();

        if ($existe) {

            return back()->withErrors([
                'mes' => 'Ya existe una apertura para ese mes y gestión.'
            ])->withInput();
        }

        // CREAR APERTURA
        $apertura = AperturaExpensa::create([

            'mes' => $request->mes,
            'gestion' => $request->gestion,
            'saldo_inicial' => $request->saldo_inicial,
            'efectivo_inicial' => $request->efectivo_inicial,
            'expensa_departamentos' => $request->expensa_departamentos,
            'expensa_tiendas' => $request->expensa_tiendas,
            'expensa_parqueo' => $request->expensa_parqueo,
            'factura_agua' => $request->factura_agua,
            'prorrateo_agua' => $request->prorrateo_agua,
            'edificio_id' => $request->edificio_id,

        ]);

        // OBTENER TODOS LOS DEPARTAMENTOS
        $departamentos = Departamento::where(
            'edificio_id',
            $request->edificio_id
        )->get();

        // CREAR EXPENSAS AUTOMATICAMENTE
        foreach ($departamentos as $departamento) {

            Expensa::create([

                'total' => $request->expensa_departamentos,
                'pagado' => 0,
                'saldo' => $request->expensa_departamentos,
                'estado' => 'PENDIENTE',
                'departamento_id' => $departamento->id,
                'propietario_id' => $departamento->propietario_id,
                'edificio_id' => $request->edificio_id,
                'apertura_expensa_id' => $apertura->id,
            ]);


            ExpensaAgua::create([
                'departamento_id' => $departamento->id,
                'propietario_id' => $departamento->propietario_id,
                'edificio_id' => $request->edificio_id,
                'apertura_expensa_id' => $apertura->id,
                'total' => 0,
                'pagado' => 0,
                'saldo' => 0,
                'estado' => 'PENDIENTE',
                'lectura_anterior' => 0,
                'lectura_actual' => 0,
                'lectura_pagar' => 0,
                'prorrateo' => 0,
                'pago' => 0,
            ]);
        }

        // OBTENER TODAS LAS TIENDAS

        $tiendas = Tienda::where(
            'edificio_id',
            $request->edificio_id
        )->get();
        foreach ($tiendas as $tienda) {
            ExpensaTienda::create([
                'total' => $request->expensa_tiendas,
                'pagado' => 0,
                'saldo' => $request->expensa_tiendas,
                'estado' => 'PENDIENTE',
                'tienda_id' => $tienda->id,
                'propietario_id' => $tienda->propietario_id,
                'edificio_id' => $request->edificio_id,
                'apertura_expensa_id' => $apertura->id,
            ]);
        }


        // OBTENER TODOS LOS ESTACIONAMIENTOS

        $estacionamientos = Estacionamiento::where(
            'edificio_id',
            $request->edificio_id
        )->get();
        foreach ($estacionamientos as $estacionamiento) {
            ExpensaEstacionamiento::create([
                'total' => $request->expensa_parqueo,
                'pagado' => 0,
                'saldo' => $request->expensa_parqueo,
                'estado' => 'PENDIENTE',
                'estacionamiento_id' => $estacionamiento->id,
                'propietario_id' => $estacionamiento->propietario_id,
                'edificio_id' => $request->edificio_id,
                'apertura_expensa_id' => $apertura->id,
            ]);
        }



        return redirect()
            ->route('apertura-expensas.index')
            ->with(
                'success',
                'Apertura registrada y expensas generadas correctamente'
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AperturaExpensa $apertura_expensa)
    {

        if (!session('edificio_id')) {
            return redirect()->route('edificios.seleccionar');
        }

        $edificio_id = session('edificio_id');

        return view(
            'expensas.aperturas.edit',
            compact('apertura_expensa', 'edificio_id')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        AperturaExpensa $apertura_expensa
    ) {
        $request->validate([

            'mes' => 'required',
            'gestion' => 'required|integer',
            'saldo_inicial' => 'required|numeric',
            'efectivo_inicial' => 'required|numeric',
            'expensa_departamentos' => 'required|numeric',
            'expensa_tiendas' => 'required|numeric',
            'expensa_parqueo' => 'required|numeric',
            'factura_agua' => 'required|numeric',
            'prorrateo_agua' => 'required|numeric',
            'edificio_id' => 'required|exists:edificios,id',

        ]);

        $apertura_expensa->update([

            'mes' => $request->mes,
            'gestion' => $request->gestion,
            'saldo_inicial' => $request->saldo_inicial,
            'efectivo_inicial' => $request->efectivo_inicial,
            'expensa_departamentos' => $request->expensa_departamentos,
            'expensa_tiendas' => $request->expensa_tiendas,
            'expensa_parqueo' => $request->expensa_parqueo,
            'factura_agua' => $request->factura_agua,
            'prorrateo_agua' => $request->prorrateo_agua,
            'edificio_id' => $request->edificio_id,

        ]);

        return redirect()
            ->route('apertura-expensas.index')
            ->with('success', 'Apertura actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AperturaExpensa $apertura_expensa)
    {
        $apertura_expensa->delete();

        return redirect()
            ->route('apertura-expensas.index')
            ->with('success', 'Apertura eliminada correctamente');
    }
}
