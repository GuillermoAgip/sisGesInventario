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
        Schema::create('historial', function (Blueprint $table) {
            $table->id('id_historial');
            $table->date('fecha_hora_cambio')->nullable();

            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('users')  
                ->onDelete('set null');

            $table->string('entidad_afectada', 20)->nullable();
            $table->string('id_registro_afectado', 20)->nullable();
            $table->string('accion', 20)->nullable();
            $table->string('campo_modificado', 20)->nullable();
            $table->string('valor_anterior', 20)->nullable();
            $table->string('valor_nuevo', 20)->nullable();
            $table->string('motivo_cambio', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
