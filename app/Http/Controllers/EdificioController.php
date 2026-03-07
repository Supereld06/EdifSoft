<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edificio;

class EdificioController extends Controller
{
    // SELECCIONAR EDIFICIO
    public function seleccionar()
    {
        if (session('edificio_id')) {
            return redirect('/dashboard');
        }

        $edificios = Edificio::all();
        return view('edificios.seleccionar', compact('edificios'));
    }

    //UNA VEZ SELECCIONADO EL EDIFICIO, GUARDAR EN SESIÓN Y REDIRIGIR
    public function elegir($id)
    {
        $edificio = Edificio::findOrFail($id);

         session([
                'edificio_id' => $edificio->id,
                'edificio_nombre' => $edificio->nombre
        ]);

    return redirect('/dashboard');
    }

        // LISTAR EDIFICIOS
    public function index()
    {
        $edificios = Edificio::all();
        return view('edificios.index', compact('edificios'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        return view('edificios.create');
    }

    // GUARDAR EDIFICIO
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'numero_departamentos' => 'nullable|integer'
        ]);

        Edificio::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'numero_departamentos' => $request->numero_departamentos
        ]);

        return redirect()->route('edificios.index')
            ->with('success', 'Edificio creado correctamente');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $edificio = Edificio::findOrFail($id);
        return view('edificios.edit', compact('edificio'));
    }
    public function update(Request $request, $id)
    {
        $edificio = Edificio::findOrFail($id);

        $edificio->update([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion
        ]);

        return redirect()->route('edificios.index')->with('success', 'Edificio actualizado');
    }

    
}
