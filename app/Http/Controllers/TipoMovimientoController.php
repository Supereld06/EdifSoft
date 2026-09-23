<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class TipoMovimientoController extends Controller
{
    /**
     * Mostrar catálogo.
     */
    public function index()
    {
        $edificioId = session('edificio_id');

        if (!$edificioId) {
            abort(
                403,
                'No existe un edificio seleccionado.'
            );
        }

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

        return response()->json([
            'ingresos' => $tiposIngreso,
            'egresos' => $tiposEgreso,
        ]);
    }

    /**
     * Registrar tipo.
     */
    public function store(Request $request)
    {
        $edificioId = session('edificio_id');

        if (!$edificioId) {
            return back()->with(
                'error',
                'No existe un edificio seleccionado.'
            );
        }

        $validated = $request->validate([
            'tipo' => [
                'required',
                Rule::in([
                    'ingreso',
                    'egreso',
                ]),
            ],

            'nombre' => [
                'required',
                'string',
                'max:150',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'orden' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'tipo.required' =>
                'Debe seleccionar el tipo de movimiento.',

            'tipo.in' =>
                'El tipo de movimiento no es válido.',

            'nombre.required' =>
                'El nombre del tipo es obligatorio.',

            'nombre.max' =>
                'El nombre no puede superar los 150 caracteres.',

            'descripcion.max' =>
                'La descripción no puede superar los 255 caracteres.',

            'orden.integer' =>
                'El orden debe ser un número entero.',

            'orden.min' =>
                'El orden no puede ser negativo.',
        ]);

        $existe = TipoMovimiento::where(
            'edificio_id',
            $edificioId
        )
            ->where(
                'tipo',
                $validated['tipo']
            )
            ->whereRaw(
                'LOWER(nombre) = ?',
                [
                    mb_strtolower(
                        trim($validated['nombre'])
                    )
                ]
            )
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ya existe este tipo de movimiento.'
                );
        }

        try {

            TipoMovimiento::create([
                'edificio_id' => $edificioId,
                'tipo' => $validated['tipo'],
                'nombre' => trim($validated['nombre']),
                'descripcion' =>
                    $validated['descripcion'] ?? null,
                'estado' => true,
                'orden' =>
                    $validated['orden'] ?? 0,
            ]);

            return back()->with(
                'success',
                'Tipo de movimiento registrado correctamente.'
            );

        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /**
     * Actualizar tipo.
     */
    public function update(
        Request $request,
        $id
    ) {
        $tipoMovimiento =
            $this->obtenerTipo($id);

        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'orden' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'nombre.required' =>
                'El nombre del tipo es obligatorio.',

            'nombre.max' =>
                'El nombre no puede superar los 150 caracteres.',

            'descripcion.max' =>
                'La descripción no puede superar los 255 caracteres.',

            'orden.integer' =>
                'El orden debe ser un número entero.',

            'orden.min' =>
                'El orden no puede ser negativo.',
        ]);

        $existe = TipoMovimiento::where(
            'edificio_id',
            $tipoMovimiento->edificio_id
        )
            ->where(
                'tipo',
                $tipoMovimiento->tipo
            )
            ->where(
                'id',
                '!=',
                $tipoMovimiento->id
            )
            ->whereRaw(
                'LOWER(nombre) = ?',
                [
                    mb_strtolower(
                        trim($validated['nombre'])
                    )
                ]
            )
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ya existe otro tipo con ese nombre.'
                );
        }

        $tipoMovimiento->update([
            'nombre' =>
                trim($validated['nombre']),

            'descripcion' =>
                $validated['descripcion'] ?? null,

            'orden' =>
                $validated['orden'] ?? 0,
        ]);

        return back()->with(
            'success',
            'Tipo de movimiento actualizado correctamente.'
        );
    }

    /**
     * Activar / desactivar.
     */
    public function cambiarEstado($id)
    {
        $tipoMovimiento =
            $this->obtenerTipo($id);

        $tipoMovimiento->update([
            'estado' =>
                !$tipoMovimiento->estado,
        ]);

        return back()->with(
            'success',
            $tipoMovimiento->estado
            ? 'Tipo de movimiento activado.'
            : 'Tipo de movimiento desactivado.'
        );
    }

    /**
     * Obtener tipo del edificio actual.
     */
    private function obtenerTipo($id): TipoMovimiento
    {
        $edificioId = session('edificio_id');

        if (!$edificioId) {
            abort(
                403,
                'No existe un edificio seleccionado.'
            );
        }

        return TipoMovimiento::where(
            'id',
            $id
        )
            ->where(
                'edificio_id',
                $edificioId
            )
            ->firstOrFail();
    }
}