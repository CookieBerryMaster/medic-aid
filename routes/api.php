<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MedicamentoController;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('medicamentos', MedicamentoController::class);
