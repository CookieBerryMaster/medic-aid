<?php

namespace App\Http\Controllers;

use App\Models\Tratamientos;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTratamientoRequest;
use App\Http\Requests\UpdateTratamientoRequest;
use App\Http\Resources\TratamientosResource;

class TratamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tratamientos = Tratamientos::with(['usuario', 'medicamento'])->paginate(10);
        return TratamientosResource::collection($tratamientos);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Opcional: cargar relaciones para la respuesta
        $tratamiento->load(['usuario', 'medicamento']);

        return (new TratamientoResource($tratamiento))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tratamientos $tratamientos)
    {
        $tratamientos->load(['usuario', 'medicamento']);
        return new TratamientosResource($tratamientos);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tratamientos $tratamientos)
    {
        $tratamientos->update($request->validated());
        $tratamientos->load(['usuario', 'medicamento']);
        return new TratamientosResource($tratamientos);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tratamientos $tratamientos)
    {
        $tratamientos->delete();
        return response()->noContent(); // 204
    }
}
