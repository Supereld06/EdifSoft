<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use App\Models\Propietario;
use Illuminate\Http\Request;

class EstacionamientoController extends Controller
{
    public function index()
    {
        $edificioId = session('edificio_id');

        $estacionamientos = Estacionamiento::with('propietario')
            ->where('edificio_id', $edificioId)
            ->orderBy('numero_estacionamiento', 'asc')
            ->paginate(12);

        return view(
            'estacionamientos.index',
            compact('estacionamientos')
        );
    }

    public function create()
    {
        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view('estacionamientos.create', compact(
            'propietarios'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_estacionamiento' => 'required',
            'numero_estacionamiento' => 'required',
            'propietario_id' => 'required',
        ]);

        Estacionamiento::create([

            'tipo_estacionamiento' =>
            $request->tipo_estacionamiento,

            'numero_estacionamiento' =>
            $request->numero_estacionamiento,

            'ubicacion' =>
            $request->ubicacion,

            'detalle' =>
            $request->detalle,

            'propietario_id' =>
            $request->propietario_id,

            'edificio_id' =>
            session('edificio_id'),
        ]);

        return redirect()
            ->route('estacionamientos.index')
            ->with(
                'success',
                'Estacionamiento registrado correctamente'
            );
    }

    public function edit($id)
    {
        $estacionamiento = Estacionamiento::findOrFail($id);

        $propietarios = Propietario::where(
            'edificio_id',
            session('edificio_id')
        )->get();

        return view('estacionamientos.edit', compact(
            'estacionamiento',
            'propietarios'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_estacionamiento' => 'required',
            'numero_estacionamiento' => 'required',
            'propietario_id' => 'required',
        ]);

        $estacionamiento = Estacionamiento::findOrFail($id);

        $estacionamiento->update([

            'tipo_estacionamiento' =>
            $request->tipo_estacionamiento,

            'numero_estacionamiento' =>
            $request->numero_estacionamiento,

            'ubicacion' =>
            $request->ubicacion,

            'detalle' =>
            $request->detalle,

            'propietario_id' =>
            $request->propietario_id,
        ]);

        return redirect()
            ->route('estacionamientos.index')
            ->with(
                'success',
                'Estacionamiento actualizado correctamente'
            );
    }

    public function destroy($id)
    {
        $estacionamiento = Estacionamiento::findOrFail($id);

        $estacionamiento->delete();

        return redirect()
            ->route('estacionamientos.index')
            ->with(
                'success',
                'Estacionamiento eliminado correctamente'
            );
    }
}
