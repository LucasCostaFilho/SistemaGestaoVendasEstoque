<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fornecedores';

    protected $fillable = ['razao_social', 'cnpj', 'email', 'telefone'];

    public function pedidosCompra(): HasMany
    {
        return $this->hasMany(PedidoCompra::class, 'fornecedor_id');
    }
}
