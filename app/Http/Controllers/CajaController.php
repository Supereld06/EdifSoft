<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\TipoMovimiento;
use App\Services\CajaService;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EDIFICIO SELECCIONADO
    |--------------------------------------------------------------------------
    */

    private function edificioId()
    {
        return session('edificio_id');
    }


    /*
    |--------------------------------------------------------------------------
    | LISTADO DE CAJAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $edificioId = $this->edificioId();

        if (!$edificioId) {
            return redirect()->back()
                ->with(
                    'error',
                    'Debe seleccionar un edificio primero.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CAJAS
        |--------------------------------------------------------------------------
        */

        $cajas = Caja::where(
            'edificio_id',
            $edificioId
        )
            ->orderBy('nombre')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CATÁLOGO DE TIPOS DE MOVIMIENTO
        |--------------------------------------------------------------------------
        |
        | Se cargan solamente los tipos pertenecientes
        | al edificio actualmente seleccionado.
        |
        */

        $tiposIngreso = TipoMovimiento::where(
            'edificio_id',
            $edificioId
        )
            ->where('tipo', 'ingreso')
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();


        $tiposEgreso = TipoMovimiento::where(
            'edificio_id',
            $edificioId
        )
            ->where('tipo', 'egreso')
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();


        return view(
            'cajas.index',
            compact(
                'cajas',
                'tiposIngreso',
                'tiposEgreso'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREAR CAJA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (!$this->edificioId()) {
            return redirect()->back()
                ->with(
                    'error',
                    'Debe seleccionar un edificio primero.'
                );
        }

        return view('cajas.create');
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR CAJA
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        CajaService $cajaService
    ) {
        $edificioId = $this->edificioId();

        if (!$edificioId) {
            return redirect()->back()
                ->with(
                    'error',
                    'Debe seleccionar un edificio primero.'
                );
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'saldo' => 'nullable|numeric|min:0',
        ]);


        try {

            $cajaService->crearCaja(
                $edificioId,
                $request->nombre,
                $request->descripcion,
                (float) ($request->saldo ?? 0)
            );


            return redirect()
                ->route('cajas.index')
                ->with(
                    'success',
                    'Caja creada correctamente y su saldo inicial fue registrado.'
                );

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'No se pudo crear la caja: ' .
                    $e->getMessage()
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR CAJA
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $caja = Caja::where(
            'id',
            $id
        )
            ->where(
                'edificio_id',
                $this->edificioId()
            )
            ->firstOrFail();


        return view(
            'cajas.edit',
            compact('caja')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR CAJA
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {
        $caja = Caja::where(
            'id',
            $id
        )
            ->where(
                'edificio_id',
                $this->edificioId()
            )
            ->firstOrFail();


        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);


        $caja->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);


        return redirect()
            ->route('cajas.index')
            ->with(
                'success',
                'Caja actualizada correctamente.'
            );
    }
}
