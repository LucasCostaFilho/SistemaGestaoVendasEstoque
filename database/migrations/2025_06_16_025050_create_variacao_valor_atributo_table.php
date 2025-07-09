<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('variacao_valor_atributo', function (Blueprint $table) {
            $table->foreignId('variacao_id')->constrained('variacoes_produto')->onDelete('cascade');
            $table->foreignId('valor_id')->constrained('valores_atributo')->onDelete('cascade');
            $table->primary(['variacao_id', 'valor_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variacao_valor_atributo');
    }
};
