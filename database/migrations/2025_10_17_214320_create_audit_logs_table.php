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
        if(!Schema::hasTable('audit_logs')){   
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('usuario_id')->nullable();
                $table->string('accion', 150);
                $table->json('detalles')->nullable();
                $table->timestamp('created_at')->useCurrent();

                // FKs
                $table->foreign('usuario_id')
                    ->references('id')->on('usuarios') // ← referencia usuario_id
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
