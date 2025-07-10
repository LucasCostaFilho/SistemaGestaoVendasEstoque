<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariacaoProduto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'variacoes_produto';

    protected $fillable = [
        'produto_id', 'sku', 'preco', 'custo', 'estoque_atual', 'peso_kg',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id')->withTrashed();
    }

    public function valores(): BelongsToMany
    {
        return $this->belongsToMany(ValorAtributo::class, 'variacao_valor_atributo', 'variacao_id', 'valor_id');
    }

    public function movimentacoesEstoque(): HasMany
    {
        return $this->hasMany(MovimentacaoEstoque::class, 'variacao_produto_id');
    }
}
