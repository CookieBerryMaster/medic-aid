<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHistorialRequest;
use App\Http\Requests\UpdateHistorialRequest;
use App\Http\Resources\HistorialResource;



class HistorialController extends Controller
{
    public function index()
    {
        return HistorialResource::collection(Historial::with('tratamientos')->get());
    }

    public function store(StoreHistorialRequest $request)
    {
        $historial = Historial::create($request->validated());
        return new HistorialResource($historial);
    }

    public function show(Historial $historial)
    {
        return new HistorialResource($historial->load('tratamientos'));
    }

    public function update(UpdateHistorialRequest $request, Historial $historial)
    {
        $historial->update($request->validated());
        return new HistorialResource($historial);
    }

    public function destroy(Historial $historial)
    {
        $historial->delete();
        return response()->noContent();
    }
}
