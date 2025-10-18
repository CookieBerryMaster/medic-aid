<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicamentoRequest;
use App\Http\Requests\UpdateMedicamentoRequest;
use App\Http\Resources\MedicamentoResource;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index()
    {
        return MedicamentoResource::collection(Medicamento::all());
    }

    public function store(StoreMedicamentoRequest $request)
    {
        $medicamento = Medicamento::create($request->validated());
        return new MedicamentoResource($medicamento);
    }

    public function show(Medicamento $medicamento)
    {
        return new MedicamentoResource($medicamento);
    }

    public function update(UpdateMedicamentoRequest $request, Medicamento $medicamento)
    {
        $medicamento->update($request->validated());
        return new MedicamentoResource($medicamento);
    }

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return response()->noContent();
    }
}
