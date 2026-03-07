<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Propietario;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    // Listado
    public function index()
    {
        $departamentos = Departamento::with(['propietario', 'edificio'])->get();
        return view('departamentos.index', compact('departamentos'));
    }

    // Formulario crear
    public function create()
    {
        $edificio_id = session('edificio_id'); // ID del edificio de la sesión
        $propietarios = Propietario::where('edificio_id', $edificio_id)->get();
        return view('departamentos.create', compact('propietarios', 'edificio_id'));
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'tipo_departamento' => 'required|string|max:255',
            'numero_departamento' => 'required|string|max:50',
            'piso' => 'required|integer',
            'propietario_id' => 'required|exists:propietarios,id',
            'edificio_id' => 'required|exists:edificios,id',
        ]);

        Departamento::create($request->all());

        return redirect()->route('departamentos.index')
                         ->with('success', 'Departamento creado correctamente.');
    }
}
