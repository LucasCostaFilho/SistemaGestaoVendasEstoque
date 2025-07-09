<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValorAtributo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'valores_atributo';

    public $timestamps = false;

    protected $fillable = ['atributo_id', 'valor'];

    public function atributo(): BelongsTo
    {
        return $this->belongsTo(Atributo::class, 'atributo_id');
    }

    public function variacoes(): BelongsToMany
    {
        return $this->belongsToMany(VariacaoProduto::class, 'variacao_valor_atributo', 'valor_id', 'variacao_id');
    }
}
