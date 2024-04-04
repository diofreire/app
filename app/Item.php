<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    // Verifica em ORM a relação entre as tabelas Produtos e ProdutoDetalha
    public function produtoDetalhe(): HasOne
    {
        return $this->hasOne(
            'App\ItemDetalhe',
            'produto_id',
            'id'
        );
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo('App\Fornecedor');
    }

    public function pedidos() {
        return $this->belongsToMany(
            'App\Pedido', //1 - Modelo do relacionamento NxN em relação o Modelo que estamos implementando
            'pedidos_produtos', //2 - É a tabela auxiliar que armazena os registros de relacionamento
            'produto_id', //3 - Representa o nome da FK da tabela mapeada pelo model na tabela de relacionamento
            'pedido_id' //4 - Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        );
    }
}
