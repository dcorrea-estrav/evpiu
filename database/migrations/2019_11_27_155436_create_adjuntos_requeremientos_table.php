<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjuntosRequeremientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjuntos_requerimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('idRequerimiento');
            $table->string('archivo');
            $table->string('usuario');
            $table->timestamps();
        });
        Schema::table('adjuntos_requerimientos', function($table) {
            $table->foreign('idRequerimiento')->references('id')->on('encabezado_requerimientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjuntos_requeremientos');
    }
}
