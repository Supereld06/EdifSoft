<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\Propietario;
use App\Models\Edificio;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiendas = Tienda::with(['propietario', 'edificio'])->paginate(10);
        return view('tiendas.index', compact('tiendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $edificios = Edificio::all();
        $edificio_id = session('edificio_id');
        $propietarios = Propietario::with('edificio')->get();

        return view('tiendas.create', compact('propietarios', 'edificios', 'edificio_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_tienda' => 'required',
            'numero_tienda' => 'required',
            'ubicacion' => 'required',
            'propietario_id' => 'required',
            'edificio_id' => 'required',
        ]);

        Tienda::create($request->all());

        return redirect()->route('tiendas.index')
            ->with('success', 'Tienda registrada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tienda $tienda)
    {
        $propietarios = Propietario::with('edificio')->get();
        $edificios = Edificio::all();
        $edificio_id = session('edificio_id');
        return view('tiendas.edit', compact('tienda', 'propietarios', 'edificios', 'edificio_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tienda $tienda)
    {
        $request->validate([
            'tipo_tienda' => 'required',
            'numero_tienda' => 'required',
            'ubicacion' => 'required',
            'propietario_id' => 'required',
            'edificio_id' => 'required',
        ]);

        $tienda->update($request->all());

        return redirect()->route('tiendas.index')
            ->with('success', 'Tienda actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tienda $tienda)
    {
        $tienda->delete();

        return redirect()->route('tiendas.index')
            ->with('success', 'Tienda eliminada');
    }
}