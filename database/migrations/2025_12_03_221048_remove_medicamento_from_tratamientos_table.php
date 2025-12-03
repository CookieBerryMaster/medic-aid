<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            // 1. Quitar la foreign key que usa medicamento_id
            $table->dropForeign('tratamientos_medicamento_id_foreign');

            // 2. Quitar las columnas que ya no queremos
            $table->dropColumn(['medicamento_id', 'dosis']);
        });
    }

    public function down(): void
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            // Volver a crear las columnas (por si se hace rollback)
            $table->unsignedBigInteger('medicamento_id')->nullable();
            $table->string('dosis', 50)->nullable();

            // Volver a crear la foreign key (si quieres ser súper prolija)
            $table->foreign('medicamento_id')
                ->references('id')
                ->on('medicamentos')
                ->onDelete('cascade');
        });
    }
};
