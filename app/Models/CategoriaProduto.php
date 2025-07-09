<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaProduto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorias_produto';

    protected $fillable = ['nome', 'descricao'];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'categoria_id');
    }
}
