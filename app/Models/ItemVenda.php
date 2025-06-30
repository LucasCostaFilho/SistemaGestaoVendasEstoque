<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVenda extends Model
{
    use HasFactory;

    protected $table = 'itens_venda';

    protected $fillable = ['venda_id', 'variacao_produto_id', 'quantidade', 'preco_unitario', 'subtotal'];

    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }

    public function variacaoProduto(): BelongsTo
    {
        return $this->belongsTo(VariacaoProduto::class, 'variacao_produto_id');
    }
}
