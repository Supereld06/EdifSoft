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
            'direccion' => 'required|string|max:255',
            'numero_departamentos' => 'required|integer',

            'pais' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'zona' => 'nullable|string|max:255',

            'imagen_edificio' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo_edificio' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $imagen = null;
        $logo = null;

        if ($request->hasFile('imagen_edificio')) {
            $imagen = $request->file('imagen_edificio')
                ->store('edificios', 'public');
        }

        if ($request->hasFile('logo_edificio')) {
            $logo = $request->file('logo_edificio')
                ->store('logos', 'public');
        }

        Edificio::create([

            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'numero_departamentos' => $request->numero_departamentos,

            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
            'zona' => $request->zona,

            'imagen_edificio' => $imagen,
            'logo_edificio' => $logo

        ]);

        return redirect()
            ->route('edificios.index')
            ->with('success', 'Edificio registrado correctamente');
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

        $request->validate([

            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'numero_departamentos' => 'required|integer',

            'pais' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'zona' => 'nullable|string|max:255',

            'imagen_edificio' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo_edificio' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $imagen = $edificio->imagen_edificio;
        $logo = $edificio->logo_edificio;

        if ($request->hasFile('imagen_edificio')) {
            $imagen = $request->file('imagen_edificio')
                ->store('edificios', 'public');
        }

        if ($request->hasFile('logo_edificio')) {
            $logo = $request->file('logo_edificio')
                ->store('logos', 'public');
        }

        $edificio->update([

            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'numero_departamentos' => $request->numero_departamentos,

            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
            'zona' => $request->zona,

            'imagen_edificio' => $imagen,
            'logo_edificio' => $logo

        ]);

        return redirect()
            ->route('edificios.index')
            ->with('success', 'Edificio actualizado correctamente');
    }


}
