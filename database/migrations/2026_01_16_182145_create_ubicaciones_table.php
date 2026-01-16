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
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id('id_ubicacion');
            $table->string('nombre_sede', 100)->nullable();
            $table->string('ambiente', 100)->nullable();
            $table->string('piso_ubicacion', 20)->nullable();

            $table->unsignedBigInteger('idarea');
            $table->foreign('idarea')->references('id_area')->on('area')                                
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion');
    }
};
