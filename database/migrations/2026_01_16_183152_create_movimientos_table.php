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
        Schema::create('movimiento', function (Blueprint $table) {
            $table->id('id_movimiento');
            
            $table->unsignedBigInteger('idbien');
            $table->foreign('idbien')->references('id_bien')->on('bien')
                ->onDelete('set null');               
                
            $table->unsignedBigInteger('tipo_mvto');
            $table->foreign('tipo_mvto')->references('id_tipo_mvto')->on('tipo_mvto')
                ->onDelete('set null');               
                
            $table->date('fecha_mvto')->nullable();
            $table->string('detalle_tecnico', 200)->nullable();

            $table->unsignedBigInteger('documento_sustentatorio');
            $table->foreign('documento_sustentatorio')->references('id_documento')->on('documento_sustento')
                ->onDelete('set null');               
                
            $table->unsignedBigInteger('idubicacion');
            $table->foreign('idubicacion')->references('id_ubicacion')->on('ubicacion')
                ->onDelete('set null');                
                
            $table->unsignedBigInteger('id_estado_conservacion_bien');
            $table->foreign('id_estado_conservacion_bien')->references('id_estado')->on('estado_bien')
                ->onDelete('set null');
                                
            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('users')                
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento');
    }
};
