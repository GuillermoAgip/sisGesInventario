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
        Schema::create('usuario_perfil', function (Blueprint $table) {
            $table->id('idusuarioperfil');

            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('idperfil');
            $table->foreign('idperfil')->references('idperfil')->on('perfil')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_perfil');
    }
};
