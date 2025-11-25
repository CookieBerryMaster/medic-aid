<?php

namespace App\Http\Controllers;

use App\Models\Audit_logs;
use Illuminate\Http\Request;
use App\Http\Resources\AuditResource;

class AuditLogsController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/audit-logs",
     *   summary="Listar registros de auditoría",
     *   tags={"Audit Logs"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="Listado paginado de registros de auditoría"
     *   )
     * )
     */
    public function index()
    {
        $auditLogs = Audit_logs::with(['usuario'])->paginate(10);
        return AuditResource::collection($auditLogs);
    }

    /**
     * @OA\Post(
     *   path="/api/audit-logs",
     *   summary="Crear registro de auditoría",
     *   tags={"Audit Logs"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       @OA\Property(property="usuario_id", type="integer", example=1),
     *       @OA\Property(property="accion", type="string", example="CREAR_TRATAMIENTO"),
     *       @OA\Property(property="descripcion", type="string", example="El usuario creó un nuevo tratamiento"),
     *       @OA\Property(property="ip_address", type="string", example="127.0.0.1")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Registro de auditoría creado"),
     *   @OA\Response(response=422, description="Datos inválidos")
     * )
     */
    public function store(Request $request)
    {
        $auditLogs = Audit_logs::create($request->all());

        $auditLogs->load(['usuario']);

        return (new AuditResource($auditLogs))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *   path="/api/audit-logs/{id}",
     *   summary="Obtener un registro de auditoría",
     *   tags={"Audit Logs"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Registro de auditoría encontrado"),
     *   @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function show(Audit_logs $audit_logs)
    {
        $audit_logs->load(['usuario']);
        return new AuditResource($audit_logs);
    }

    /**
     * @OA\Delete(
     *   path="/api/audit-logs/{id}",
     *   summary="Eliminar registro de auditoría",
     *   tags={"Audit Logs"},
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
    public function destroy(Audit_logs $audit_logs)
    {
        $audit_logs->delete();
        return response()->noContent();
    }
}
