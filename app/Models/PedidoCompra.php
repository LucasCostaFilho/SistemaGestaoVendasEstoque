<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoCompra extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pedidos_compra';

    protected $fillable = ['fornecedor_id', 'user_id', 'data_pedido', 'status', 'valor_total'];

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedidoCompra::class, 'pedido_compra_id');
    }
}
