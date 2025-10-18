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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // bigIncrements -> id BIGINT AUTO_INCREMENT PRIMARY KEY
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('email', 150)->unique()->nullable();
            $table->string('telefono', 50)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamps(); // created_at, updated_at (opcional)
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }

};
