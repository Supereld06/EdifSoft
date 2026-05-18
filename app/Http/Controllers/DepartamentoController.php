<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Propietario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);

        $propietarios = Propietario::where(
            'edificio_id',
            $departamento->edificio_id
        )->get();

        return view(
            'departamentos.edit',
            compact('departamento', 'propietarios')
        );
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);

        $request->validate([
            'tipo_departamento' => 'required|string|max:255',
            'numero_departamento' => 'required|string|max:50',
            'piso' => 'required|integer',
            'co_propietario' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'propietario_id' => 'required|exists:propietarios,id',
            'edificio_id' => 'required|exists:edificios,id',
        ]);

        $departamento->update([
            'tipo_departamento' => $request->tipo_departamento,
            'numero_departamento' => $request->numero_departamento,
            'piso' => $request->piso,
            'co_propietario' => $request->co_propietario,
            'observaciones' => $request->observaciones,
            'propietario_id' => $request->propietario_id,
            'edificio_id' => $request->edificio_id,
        ]);

        return redirect()
            ->route('departamentos.index')
            ->with('success', 'Departamento actualizado correctamente');
    }

    public function pdf()
    {
        $departamentos = Departamento::with(['propietario', 'edificio'])
            ->where('edificio_id', session('edificio_id'))
            ->get();

        $pdf = Pdf::loadView(
            'departamentos.reporte',
            compact('departamentos')
        );

        return $pdf->stream('reporte_departamentos.pdf');
    }
}
