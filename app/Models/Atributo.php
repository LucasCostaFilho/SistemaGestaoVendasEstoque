<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atributo extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false; // Tabela não tem created_at/updated_at

    protected $fillable = ['nome'];

    public function valores(): HasMany
    {
        return $this->hasMany(ValorAtributo::class, 'atributo_id');
    }
}
