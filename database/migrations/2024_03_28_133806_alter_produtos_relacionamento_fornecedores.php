<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterProdutosRelacionamentoFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // criando coluna em produtos que vai receber a fk de fornecedores;
        Schema::table('produtos', function(Blueprint $table) {
            // Insere um registro de fornecedor para estabelecer o relacionamento
            $fornecedorId = DB::table('fornecedores')->insertGetId(
                [
                    'nome' => 'Fornecedor Padrão SG',
                    'site' => 'fornecedorpadraosg.com.br',
                    'uf' => 'SP',
                    'email' => 'email@fornecedorpadraosg.com.br',
                ]
            );

           $table->unsignedBigInteger('fornecedor_id')->default($fornecedorId)->after('id');
           $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove
        Schema::table('produtos', function(Blueprint $table) {
            $table->dropForeign('produtos_fornecedor_id_foreing');
            $table->dropColumn('fornecedor_id');
        });
    }
}
