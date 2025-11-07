<?php

namespace App\Http\Controllers;

use App\Models\Tratamientos;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTratamientoRequest;
use App\Http\Requests\UpdateTratamientoRequest;
use App\Http\Resources\TratamientoResource;

class TratamientosController extends Controller
{
    /**
     * Mostrar todos los tratamientos (con usuario y medicamentos asociados)
     */
    public function index()
    {
        $tratamientos = Tratamientos::with(['usuario', 'medicamentos'])->paginate(10);
        return TratamientoResource::collection($tratamientos);
    }

    /**
     * Crear un nuevo tratamiento con sus medicamentos.
     */
    public function store(StoreTratamientoRequest $request)
    {
        $tratamiento = Tratamientos::create($request->validated());

        // Asociar los medicamentos con sus dosis en la tabla pivote
        foreach ($request->medicamentos as $med) {
            $tratamiento->medicamentos()->attach($med['id'], [
                'dosis' => $med['dosis'] ?? null,
            ]);
        }

        $tratamiento->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamiento);
    }

    /**
     * Mostrar un tratamiento específico.
     */
    public function show(Tratamientos $tratamientos)
    {
        $tratamientos->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamientos);
    }

    /**
     * Actualizar un tratamiento existente.
     */
    public function update(UpdateTratamientoRequest $request, Tratamientos $tratamientos)
    {
        $tratamientos->update($request->validated());
        $tratamientos->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamientos);
    }

    /**
     * Eliminar un tratamiento.
     */
    public function destroy(Tratamientos $tratamiento)
    {
        $tratamiento->delete();
        return response()->noContent(); // HTTP 204
    }
}
