<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Edificio;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    // Listado
    public function index()
    {
        $propietarios = Propietario::with('edificio')->get();
        return view('propietarios.index', compact('propietarios'));
    }

    // Formulario crear
    public function create()
    {
        $edificios = Edificio::all();
        $edificio_id = session('edificio_id');
        return view('propietarios.create', compact('edificios', 'edificio_id'));
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'carnet' => 'required|string|max:20|unique:propietarios,carnet',
            'direccion' => 'required|string|max:500',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|unique:propietarios,correo',
            'edificio_id' => 'required|exists:edificios,id'
        ]);

        Propietario::create($request->all());

        return redirect()->route('propietarios.index')->with('success', 'Propietario registrado correctamente');
    }
}