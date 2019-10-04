<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cod_materials', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('cod');
            $table->string('name', 20);
            $table->string('abreviatura',10);
            $table->string('coments', 250);
            $table->string('usuario');
            $table->timestamps();

            $table->unsignedBigInteger('mat_lineas_id');
            $table->foreign('mat_lineas_id')->references('id')->on('cod_lineas');

            $table->unsignedBigInteger('mat_sublineas_id');
            $table->foreign('mat_sublineas_id')->references('id')->on('cod_sublineas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cod_materiales');
    }
}
