<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicamentoRequest;
use App\Http\Requests\UpdateMedicamentoRequest;
use App\Http\Resources\MedicamentoResource;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/medicamentos",
     *   summary="Listar medicamentos",
     *   tags={"Medicamentos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="Listado de medicamentos"
     *   )
     * )
     */
    public function index()
    {
        return MedicamentoResource::collection(Medicamento::all());
    }

    /**
     * @OA\Post(
     *   path="/api/medicamentos",
     *   summary="Crear medicamento",
     *   tags={"Medicamentos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nombre"},
     *       @OA\Property(property="nombre", type="string", example="Paracetamol 500mg"),
     *       @OA\Property(property="descripcion", type="string", example="Analgesico y antipirético"),
     *       @OA\Property(property="via_administracion", type="string", example="Oral")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Medicamento creado"),
     *   @OA\Response(response=422, description="Datos inválidos")
     * )
     */
    public function store(StoreMedicamentoRequest $request)
    {
        $medicamento = Medicamento::create($request->validated());
        return new MedicamentoResource($medicamento);
    }

    /**
     * @OA\Get(
     *   path="/api/medicamentos/{id}",
     *   summary="Obtener un medicamento",
     *   tags={"Medicamentos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Medicamento encontrado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function show(Medicamento $medicamento)
    {
        return new MedicamentoResource($medicamento);
    }

    /**
     * @OA\Put(
     *   path="/api/medicamentos/{id}",
     *   summary="Actualizar medicamento",
     *   tags={"Medicamentos"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\JsonContent(
     *       @OA\Property(property="nombre", type="string"),
     *       @OA\Property(property="descripcion", type="string"),
     *       @OA\Property(property="via_administracion", type="string")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Medicamento actualizado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function update(UpdateMedicamentoRequest $request, Medicamento $medicamento)
    {
        $medicamento->update($request->validated());
        return new MedicamentoResource($medicamento);
    }

    /**
     * @OA\Delete(
     *   path="/api/medicamentos/{id}",
     *   summary="Eliminar medicamento",
     *   tags={"Medicamentos"},
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
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return response()->noContent();
    }
}
