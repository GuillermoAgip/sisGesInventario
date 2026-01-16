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
        Schema::create('modulo_permisos', function (Blueprint $table) {
            $table->id('idmodulopermiso');

            $table->unsignedBigInteger('idperfilmodulo');
            $table->foreign('idperfilmodulo')->references('idperfilmodulo')->on('perfil_modulo')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('idpermiso');
            $table->foreign('idpermiso')->references('idpermiso')->on('permisos')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_permisos');
    }
};
