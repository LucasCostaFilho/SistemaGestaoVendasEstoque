<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'endereco_entrega_id', 'data_venda', 'valor_bruto', 'desconto', 'valor_frete', 'valor_final', 'status'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function enderecoEntrega(): BelongsTo
    {
        return $this->belongsTo(Endereco::class, 'endereco_entrega_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemVenda::class, 'venda_id');
    }

    public function pagamentos(): HasMany
    {
        return $this->hasMany(Pagamento::class, 'venda_id');
    }
}
