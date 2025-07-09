<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AjusteEstoque extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ajustes_estoque';
    protected $fillable = ['user_id', 'tipo', 'motivo'];

    public function movimentacao(): MorphOne
    {
        return $this->morphOne(MovimentacaoEstoque::class, 'referencia');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
