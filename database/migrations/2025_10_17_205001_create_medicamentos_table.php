<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id(); // BIGINT AUTO_INCREMENT
            $table->string('nombre', 100);
            $table->string('tipo', 50)->nullable();        // p.ej. tableta, jarabe
            $table->string('dosis_default', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
};
