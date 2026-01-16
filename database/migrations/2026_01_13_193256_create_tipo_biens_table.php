<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_bien', function (Blueprint $table) {
            $table->id('id_tipo_bien');
            $table->string('nombre_tipo', 50);
            $table->unique('nombre_tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_bien');
    }
};
