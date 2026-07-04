<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Edificio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expensa;
use App\Models\ExpensaAgua;
use App\Models\ExpensaTienda;
use App\Models\ExpensaEstacionamiento;

class PropietarioController extends Controller
{
    // Listado
    public function index()
    {
        $propietarios = Propietario::with('edificio')->get();

        foreach ($propietarios as $propietario) {

            $deudaDepartamentos = Expensa::where(
                'propietario_id',
                $propietario->id
            )->sum('saldo');

            $deudaTiendas = ExpensaTienda::where(
                'propietario_id',
                $propietario->id
            )->sum('saldo');

            $deudaEstacionamientos = ExpensaEstacionamiento::where(
                'propietario_id',
                $propietario->id
            )->sum('saldo');

            $deudaAgua = ExpensaAgua::where(
                'propietario_id',
                $propietario->id
            )->sum('saldo');

            $propietario->deuda_total =
                $deudaDepartamentos +
                $deudaTiendas +
                $deudaEstacionamientos +
                $deudaAgua;
        }
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
            'edificio_id' => 'required|exists:edificios,id'
        ]);

        $request->validate(
            [
                'correo' => 'required|email',
            ],
            [
                'correo.required' => 'Debe ingresar un correo electrónico.',
                'correo.email' => 'Debe ingresar un correo electrónico válido.',
            ]
        );

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
