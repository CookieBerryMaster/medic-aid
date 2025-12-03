<?php

namespace App\Http\Controllers;

use App\Models\Tratamientos;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTratamientoRequest;
use App\Http\Requests\UpdateTratamientoRequest;
use App\Http\Resources\TratamientoResource;

class TratamientosController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamientos::with(['usuario', 'medicamentos'])->paginate(10);
        return TratamientoResource::collection($tratamientos);
    }

    public function store(StoreTratamientoRequest $request)
    {
        // 1. Tomamos todos los datos validados
        $datos = $request->validated();

        // 2. Sacamos los medicamentos para manejarlos aparte
        $medicamentos = $datos['medicamentos'] ?? [];
        unset($datos['medicamentos']);

        // 3. Combinar fecha_inicio + hora_inicio a un timestamp válido
        if (!empty($datos['fecha_inicio']) && !empty($datos['hora_inicio'])) {
            // fecha_inicio: 2025-12-03, hora_inicio: 08:00  ->  2025-12-03 08:00:00
            $datos['hora_inicio'] = $datos['fecha_inicio'] . ' ' . $datos['hora_inicio'] . ':00';
        }

        // 4. Crear el tratamiento
        $tratamiento = Tratamientos::create($datos);

        // 5. Adjuntar medicamentos en tabla pivote
        foreach ($medicamentos as $med) {
            $tratamiento->medicamentos()->attach($med['medicamento_id'], [
                'dosis' => $med['dosis'] ?? null,
            ]);
        }

        $tratamiento->load(['usuario', 'medicamentos']);

        return new TratamientoResource($tratamiento);
    }

    public function show(Tratamientos $tratamientos)
    {
        $tratamientos->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamientos);
    }

    public function update(UpdateTratamientoRequest $request, Tratamientos $tratamientos)
    {
        $tratamientos->update($request->validated());
        $tratamientos->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamientos);
    }

    public function destroy(Tratamientos $tratamiento)
    {
        $tratamiento->delete();
        return response()->noContent();
    }
}
