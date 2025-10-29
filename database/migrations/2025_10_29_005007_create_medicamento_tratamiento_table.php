<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicamento_tratamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tratamiento_id')->constrained('tratamientos')->onDelete('cascade');
            $table->foreignId('medicamento_id')->constrained('medicamentos')->onDelete('cascade');
            $table->string('dosis')->nullable(); // dosis específica por medicamento en el tratamiento
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicamento_tratamiento');
    }
};
