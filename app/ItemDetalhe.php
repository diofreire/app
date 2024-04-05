<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemDetalhe extends Model
{
    use SoftDeletes;

    protected $table = 'produto_detalhes';
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    public function produtoDetalhe(): BelongsTo
    {
        return $this->belongsTo(
            'App\Produto',
            'produto_id',
            'id'
        );
    }
}
