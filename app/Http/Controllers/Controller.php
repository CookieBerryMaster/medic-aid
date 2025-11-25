<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="API MedicAid",
 *   description="Documentación de la API de MedicAid (Usuarios, Medicamentos, Tratamientos, Historiales y Auditoría)"
 * )
 *
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="Servidor local"
 * )
 *
 * @OA\Components(
 *   @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="Token"
 *   )
 * )
 */
abstract class Controller
{
    //
}
