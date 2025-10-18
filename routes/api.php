<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\TratamientosController;
use App\Http\Controllers\AuditLogsController;


Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('medicamentos', MedicamentoController::class);
Route::apiResource('historial', HistorialController::class);
Route::apiResource('tratamientos', TratamientosController::class);
Route::apiResource('audit-logs', AuditLogsController::class);