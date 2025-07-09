<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }
}
