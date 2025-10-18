<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('tratamientos')){
            Schema::create('tratamientos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('usuario_id');
                $table->unsignedBigInteger('medicamento_id');
                $table->string('dosis', 50);
                $table->integer('frecuencia_horas');
                $table->date('fecha_inicio');
                $table->date('fecha_fin')->nullable();
                $table->timestamp('hora_inicio');
                $table->text('notas')->nullable();
                $table->timestamps();

                // FKs
                $table->foreign('usuario_id')
                    ->references('id')->on('usuarios') // ← referencia usuario_id
                    ->onDelete('cascade');

                $table->foreign('medicamento_id')
                    ->references('id')->on('medicamentos') // ← referencia medicamento_id
                    ->onDelete('cascade');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
