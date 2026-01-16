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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id('idmodulo');
            $table->string('nommodulo', 150);
            $table->char('estadomodulo', 1);
            $table->string('etiqueta', 30);
            $table->char('color', 12);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
