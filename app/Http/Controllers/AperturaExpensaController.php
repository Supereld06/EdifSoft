<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edificio;
use App\Models\AperturaExpensa;

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
            'edificio_id' => 'required|exists:edificios,id',

        ]);

        AperturaExpensa::create([

            'mes' => $request->mes,
            'gestion' => $request->gestion,
            'saldo_inicial' => $request->saldo_inicial,
            'efectivo_inicial' => $request->efectivo_inicial,
            'edificio_id' => $request->edificio_id,

        ]);

        return redirect()
            ->route('apertura-expensas.index')
            ->with('success', 'Apertura registrada correctamente');
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
            'edificio_id' => 'required|exists:edificios,id',

        ]);

        $apertura_expensa->update([

            'mes' => $request->mes,
            'gestion' => $request->gestion,
            'saldo_inicial' => $request->saldo_inicial,
            'efectivo_inicial' => $request->efectivo_inicial,
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