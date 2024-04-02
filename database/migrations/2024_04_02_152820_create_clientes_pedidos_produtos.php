<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesPedidosProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 50);
            $table->softDeletes();
        });

        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });

        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('pedidos_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('pedidos_id')->references('id')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function(Blueprint $table) {
            $table->dropForeign('pedidos_cliente_id_foreign');
            $table->dropColumn('cliente_id');
        });

        Schema::table('pedidos_produtos', function(Blueprint $table) {
            $table->dropForeign('pedidos_produtos_produto_id_foreign');
            $table->dropColumn('produto_id');
        });

        Schema::table('pedidos_produtos', function(Blueprint $table) {
            $table->dropForeign('pedidos_produtos_pedidos_id_foreign');
            $table->dropColumn('pedidos_id');
        });

        Schema::dropIfExists('clientes');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('pedidos_produtos');
    }
}
