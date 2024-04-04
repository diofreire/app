<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pedidos_produtos');

        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('pedido_id');
            $table->integer('quantidade');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('produto_id')->references('id')->on('produtos');
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
            $table->dropForeign('pedidos_produtos_produto_id_foreign');
            $table->dropColumn('produto_id');
        });

        Schema::table('pedidos_produtos', function(Blueprint $table) {
            $table->dropForeign('pedidos_produtos_pedido_id_foreign');
            $table->dropColumn('pedido_id');
        });

        Schema::dropIfExists('pedidos_produtos');
    }
}
