<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['categoria_id', 'nome', 'descricao', 'marca'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }

    public function variacoes(): HasMany
    {
        return $this->hasMany(VariacaoProduto::class, 'produto_id');
    }
}
