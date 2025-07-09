<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class MovimentacaoEstoque extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'movimentacoes_estoque';

    protected $fillable = ['variacao_produto_id', 'tipo', 'quantidade', 'motivo', 'referencia_id', 'referencia_type', 'data_movimentacao'];

    public function variacaoProduto(): BelongsTo
    {
        return $this->belongsTo(VariacaoProduto::class, 'variacao_produto_id');
    }

    /**
     * Obtém o model de referência (pode ser um ItemVenda, ItemPedidoCompra, etc).
     */
    public function referencia(): MorphTo
    {
        return $this->morphTo();
    }
}
