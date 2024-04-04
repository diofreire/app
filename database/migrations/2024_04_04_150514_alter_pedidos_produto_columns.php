<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPedidosProdutoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos_produtos', function(Blueprint $table) {
            $table->dropForeign('pedidos_produtos_pedidos_id_foreign');
            $table->dropColumn('pedidos_id');

            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos_produtos', function(Blueprint $table) {
            $table->dropForeign('pedidos_produtos_pedido_id_foreign');
            $table->dropColumn('pedido_id');
        });
    }
}
