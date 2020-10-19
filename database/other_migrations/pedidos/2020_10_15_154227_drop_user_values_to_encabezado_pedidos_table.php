<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserValuesToEncabezadoPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('encabezado_pedidos', function (Blueprint $table) {
            $table->dropColumn('CodVendedor', 'NombreVendedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('encabezado_pedidos', function (Blueprint $table) {
            //
        });
    }
}
