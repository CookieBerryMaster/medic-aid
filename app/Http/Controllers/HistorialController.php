<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHistorialRequest;
use App\Http\Requests\UpdateHistorialRequest;
use App\Http\Resources\HistorialResource;

class HistorialController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/historial",
     *   summary="Listar historiales",
     *   tags={"Historial"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="Listado de historiales con sus tratamientos"
     *   )
     * )
     */
    public function index()
    {
        return HistorialResource::collection(Historial::with('tratamientos')->get());
    }

    /**
     * @OA\Post(
     *   path="/api/historial",
     *   summary="Crear historial",
     *   tags={"Historial"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"tratamiento_id","fecha_hora"},
     *       @OA\Property(property="tratamiento_id", type="integer", example=1),
     *       @OA\Property(property="fecha_hora", type="string", format="date-time", example="2025-11-24 10:30:00"),
     *       @OA\Property(property="estado", type="string", example="pendiente"),
     *       @OA\Property(property="notas", type="string", example="Tomar en ayunas")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Historial creado"),
     *   @OA\Response(response=422, description="Datos inválidos")
     * )
     */
    public function store(StoreHistorialRequest $request)
    {
        $historial = Historial::create($request->validated());
        return new HistorialResource($historial);
    }

    /**
     * @OA\Get(
     *   path="/api/historial/{historial}",
     *   summary="Obtener un historial",
     *   tags={"Historial"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="historial",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Historial encontrado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function show(Historial $historial)
    {
        return new HistorialResource($historial->load('tratamientos'));
    }

    /**
     * @OA\Put(
     *   path="/api/historial/{historial}",
     *   summary="Actualizar historial",
     *   tags={"Historial"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="historial",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\JsonContent(
     *       @OA\Property(property="tratamiento_id", type="integer", example=1),
     *       @OA\Property(property="fecha_hora", type="string", format="date-time"),
     *       @OA\Property(property="estado", type="string", example="tomada"),
     *       @OA\Property(property="notas", type="string", example="Sin efectos secundarios")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Historial actualizado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function update(UpdateHistorialRequest $request, Historial $historial)
    {
        $historial->update($request->validated());
        return new HistorialResource($historial);
    }

    /**
     * @OA\Delete(
     *   path="/api/historial/{historial}",
     *   summary="Eliminar historial",
     *   tags={"Historial"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="historial",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=204, description="Eliminado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function destroy(Historial $historial)
    {
        $historial->delete();
        return response()->noContent();
    }
}
