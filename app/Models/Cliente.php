<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'nome_completo', 'cpf', 'cnpj', 'telefone', 'data_nascimento',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function enderecos(): HasMany
    {
        return $this->hasMany(Endereco::class, 'cliente_id');
    }

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class, 'cliente_id');
    }
}
