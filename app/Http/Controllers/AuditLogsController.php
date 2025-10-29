<?php

namespace App\Http\Controllers;

use App\Models\Audit_logs;
use Illuminate\Http\Request;
use App\Http\Resources\AuditResource;


class AuditLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditLogs = Audit_logs::with(['usuario'])->paginate(10);
        return AuditResource::collection($auditLogs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear el registro a partir de la petición (asegúrate de definir $fillable en el modelo)
        $auditLogs = Audit_logs::create($request->all());

        // Opcional: cargar relaciones para la respuesta
        $auditLogs->load(['usuario']);

        return (new AuditResource($auditLogs))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Audit_logs $audit_logs)
    {
        $audit_logs->load(['usuario']);
        return new AuditResource($audit_logs);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audit_logs $audit_logs)
    {
        $audit_logs->delete();
        return response()->noContent();
    }
}
