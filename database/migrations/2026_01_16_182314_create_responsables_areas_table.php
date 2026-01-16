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
        Schema::create('responsable_area', function (Blueprint $table) {
            $table->id('id_responsable_area');

            $table->unsignedBigInteger('idarea');
            $table->foreign('idarea')->references('id_area')->on('area')                
                ->onDelete('set null');
            
            $table->string('periodo', 4)->nullable();

            $table->string('responsable', 8);
            $table->foreign('responsable')->references('dni_responsable')->on('responsable')                               
               ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsable_area');
    }
};
