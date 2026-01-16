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
        Schema::create('perfil_modulo', function (Blueprint $table) {
            $table->id('idperfilmodulo');

            $table->unsignedBigInteger('idperfil');
            $table->foreign('idperfil')->references('idperfil')->on('perfil')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('idmodulo');
            $table->foreign('idmodulo')->references('idmodulo')->on('modulos')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_modulo');
    }
};
