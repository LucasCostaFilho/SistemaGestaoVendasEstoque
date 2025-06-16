<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPedidoCompra extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido_compra';

    protected $fillable = ['pedido_compra_id', 'variacao_produto_id', 'quantidade', 'custo_unitario'];

    public function pedidoCompra(): BelongsTo
    {
        return $this->belongsTo(PedidoCompra::class, 'pedido_compra_id');
    }

    public function variacaoProduto(): BelongsTo
    {
        return $this->belongsTo(VariacaoProduto::class, 'variacao_produto_id');
    }
}
