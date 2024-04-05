<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $table = 'pedidos';

    protected $fillable = ['cliente_id'];

    // Busca os clientes que pertence ao Pedido
    public function cliente(): BelongsTo
    {
        return $this->belongsTo('App\Cliente');
    }
    public function produtos() {
        return $this->belongsToMany(
            'App\Produto',
            'pedidos_produtos'
        )->withPivot('id', 'created_at', 'deleted_at');
    }
}
