<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Edificio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function edit($id)
    {
        $propietario = Propietario::findOrFail($id);

        $edificios = Edificio::all();

        return view(
            'propietarios.edit',
            compact('propietario', 'edificios')
        );
    }

    public function update(Request $request, $id)
    {
        $propietario = Propietario::findOrFail($id);
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'carnet' => 'required|string|max:20|unique:propietarios,carnet,' . $propietario->id,
            'direccion' => 'required|string|max:500',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|unique:propietarios,correo,' . $propietario->id,
            'edificio_id' => 'required|exists:edificios,id'

        ]);

        $propietario->update([
            'nombres' => $request->nombres,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'carnet' => $request->carnet,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'edificio_id' => $request->edificio_id
        ]);
        return redirect()
            ->route('propietarios.index')
            ->with('success', 'Propietario actualizado correctamente');
    }
    // PDF
    public function pdf()
    {
        $propietarios = Propietario::with('edificio')
            ->where('edificio_id', session('edificio_id'))
            ->get();

        $pdf = Pdf::loadView('propietarios.reporte', compact('propietarios'));

        return $pdf->stream('reporte_propietarios.pdf');
    }
}