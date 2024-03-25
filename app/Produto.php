<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    // Verifica em ORM a relação entre as tabelas Produtos e ProdutoDetalha
    public function produtoDetalhe(): HasOne
    {
        return $this->hasOne('App\ProdutoDetalhe');
    }

}
