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
        $propietarios = Propietario::with('edificio')->orderBy('id', 'desc')
            ->paginate(12);

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
        $request->validate(
            [
                'nombres' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
                'carnet' => 'required|string|max:20|unique:propietarios,carnet',
                'direccion' => 'required|string|max:500',
                'celular' => 'required|string|max:20',
                'correo' => 'required|email|unique:propietarios,correo',
                'edificio_id' => 'required|exists:edificios,id',
            ],
            [
                'nombres.required' => 'Debe ingresar los nombres del propietario.',
                'nombres.string' => 'Los nombres deben contener texto.',
                'nombres.max' => 'Los nombres no pueden superar los 255 caracteres.',

                'apellido_paterno.required' => 'Debe ingresar el apellido paterno.',
                'apellido_paterno.string' => 'El apellido paterno debe contener texto.',
                'apellido_paterno.max' => 'El apellido paterno no puede superar los 255 caracteres.',

                'apellido_materno.required' => 'Debe ingresar el apellido materno.',
                'apellido_materno.string' => 'El apellido materno debe contener texto.',
                'apellido_materno.max' => 'El apellido materno no puede superar los 255 caracteres.',

                'carnet.required' => 'Debe ingresar el número de carnet.',
                'carnet.max' => 'El carnet no puede superar los 20 caracteres.',
                'carnet.unique' => 'Este número de carnet ya está registrado.',

                'direccion.required' => 'Debe ingresar la dirección del propietario.',
                'direccion.max' => 'La dirección no puede superar los 500 caracteres.',

                'celular.required' => 'Debe ingresar el número de celular.',
                'celular.max' => 'El celular no puede superar los 20 caracteres.',

                'correo.required' => 'Debe ingresar un correo electrónico.',
                'correo.email' => 'Debe ingresar un correo electrónico válido.',
                'correo.unique' => 'Este correo electrónico ya está registrado.',

                'edificio_id.required' => 'No se ha seleccionado un edificio.',
                'edificio_id.exists' => 'El edificio seleccionado no es válido.',
            ]
        );

        Propietario::create($request->all());

        return redirect()
            ->route('propietarios.index')
            ->with('success', 'Propietario registrado correctamente');
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

        $request->validate(
            [
                'nombres' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
                'carnet' => 'required|string|max:20|unique:propietarios,carnet,' . $propietario->id,
                'direccion' => 'required|string|max:500',
                'celular' => 'required|string|max:20',
                'correo' => 'required|email|unique:propietarios,correo,' . $propietario->id,
                'edificio_id' => 'required|exists:edificios,id',
            ],
            [
                'nombres.required' => 'Debe ingresar los nombres del propietario.',
                'nombres.string' => 'Los nombres deben contener texto.',
                'nombres.max' => 'Los nombres no pueden superar los 255 caracteres.',

                'apellido_paterno.required' => 'Debe ingresar el apellido paterno.',
                'apellido_paterno.string' => 'El apellido paterno debe contener texto.',
                'apellido_paterno.max' => 'El apellido paterno no puede superar los 255 caracteres.',

                'apellido_materno.required' => 'Debe ingresar el apellido materno.',
                'apellido_materno.string' => 'El apellido materno debe contener texto.',
                'apellido_materno.max' => 'El apellido materno no puede superar los 255 caracteres.',

                'carnet.required' => 'Debe ingresar el número de carnet.',
                'carnet.max' => 'El carnet no puede superar los 20 caracteres.',
                'carnet.unique' => 'Este número de carnet ya está registrado por otro propietario.',

                'direccion.required' => 'Debe ingresar la dirección del propietario.',
                'direccion.max' => 'La dirección no puede superar los 500 caracteres.',

                'celular.required' => 'Debe ingresar el número de celular.',
                'celular.max' => 'El celular no puede superar los 20 caracteres.',

                'correo.required' => 'Debe ingresar un correo electrónico.',
                'correo.email' => 'Debe ingresar un correo electrónico válido.',
                'correo.unique' => 'Este correo electrónico ya está registrado por otro propietario.',

                'edificio_id.required' => 'Debe seleccionar un edificio.',
                'edificio_id.exists' => 'El edificio seleccionado no es válido.',
            ]
        );

        $propietario->update([
            'nombres' => $request->nombres,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'carnet' => $request->carnet,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'edificio_id' => $request->edificio_id,
        ]);

        return redirect()
            ->route('propietarios.index')
            ->with('success', 'Propietario actualizado correctamente');
    }


    // PDF

    public function propietarios()
    {
        $edificioId = session('edificio_id');

        $edificio = Edificio::findOrFail($edificioId);

        $propietarios = Propietario::with([
            'departamentos',
            'estacionamientos',
            'tiendas'
        ])
            ->where('edificio_id', $edificioId)
            ->get();

        return view('reportes.propietarios', compact(
            'propietarios',
            'edificio'
        ));
    }

    public function pdf()
    {
        $edificioId = session('edificio_id');

        // Obtener el edificio seleccionado
        $edificio = Edificio::findOrFail($edificioId);

        // Obtener propietarios del edificio con sus propiedades
        $propietarios = Propietario::with([
            'departamentos',
            'estacionamientos',
            'tiendas'
        ])
            ->where('edificio_id', $edificioId)
            ->get();

        // Generar PDF
        $pdf = Pdf::loadView(
            'propietarios.reporte',
            compact('propietarios', 'edificio')
        );

        return $pdf->stream('reporte-propietarios.pdf');
    }
}
