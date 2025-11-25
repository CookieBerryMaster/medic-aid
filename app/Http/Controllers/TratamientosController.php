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
     * @OA\Get(
     *   path="/api/tratamientos",
     *   summary="Listar tratamientos",
     *   tags={"Tratamientos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="Listado paginado de tratamientos"
     *   )
     * )
     */
    public function index()
    {
        $tratamientos = Tratamientos::with(['usuario', 'medicamentos'])->paginate(10);
        return TratamientoResource::collection($tratamientos);
    }

    /**
     * @OA\Post(
     *   path="/api/tratamientos",
     *   summary="Crear tratamiento",
     *   tags={"Tratamientos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"usuario_id","medicamentos"},
     *       @OA\Property(property="usuario_id", type="integer", example=1),
     *       @OA\Property(
     *         property="medicamentos",
     *         type="array",
     *         @OA\Items(
     *           @OA\Property(property="id", type="integer", example=1),
     *           @OA\Property(property="dosis", type="string", example="1 tableta cada 8 horas")
     *         )
     *       ),
     *       @OA\Property(property="descripcion", type="string", example="Tratamiento para infección respiratoria")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Tratamiento creado"),
     *   @OA\Response(response=422, description="Datos inválidos")
     * )
     */
    public function store(StoreTratamientoRequest $request)
    {
        $tratamiento = Tratamientos::create($request->validated());

        foreach ($request->medicamentos as $med) {
            $tratamiento->medicamentos()->attach($med['id'], [
                'dosis' => $med['dosis'] ?? null,
            ]);
        }

        $tratamiento->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamiento);
    }

    /**
     * @OA\Get(
     *   path="/api/tratamientos/{id}",
     *   summary="Obtener un tratamiento",
     *   tags={"Tratamientos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Tratamiento encontrado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function show(Tratamientos $tratamientos)
    {
        $tratamientos->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamientos);
    }

    /**
     * @OA\Put(
     *   path="/api/tratamientos/{id}",
     *   summary="Actualizar tratamiento",
     *   tags={"Tratamientos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\JsonContent(
     *       @OA\Property(property="usuario_id", type="integer"),
     *       @OA\Property(property="descripcion", type="string")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Tratamiento actualizado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function update(UpdateTratamientoRequest $request, Tratamientos $tratamientos)
    {
        $tratamientos->update($request->validated());
        $tratamientos->load(['usuario', 'medicamentos']);
        return new TratamientoResource($tratamientos);
    }

    /**
     * @OA\Delete(
     *   path="/api/tratamientos/{id}",
     *   summary="Eliminar tratamiento",
     *   tags={"Tratamientos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=204, description="Eliminado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function destroy(Tratamientos $tratamiento)
    {
        $tratamiento->delete();
        return response()->noContent(); // HTTP 204
    }
}
