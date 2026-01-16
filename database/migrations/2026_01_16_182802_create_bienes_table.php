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
        Schema::create('bien', function (Blueprint $table) {
            $table->id('id_bien');
            $table->string('codigo_patrimonial', 20)->nullable();
            $table->string('denominacion_bien', 100)->nullable();
            $table->unsignedBigInteger('id_tipobien');
            $table->foreign('id_tipobien')->references('id_tipo_bien')->on('tipo_bien')
                ->onDelete('set null');
                               
            $table->string('modelo_bien', 20)->nullable();
            $table->string('marca_bien', 20)->nullable();
            $table->string('color_bien', 20)->nullable();
            $table->string('dimensiones_bien', 100)->nullable();
            $table->string('nserie_bien', 20)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('foto_bien', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien');
    }
};
