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
        Schema::create('movimentacoes_estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variacao_produto_id')->constrained('variacoes_produto')->onDelete('restrict');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->integer('quantidade');
            $table->string('motivo')->nullable();
            $table->morphs('referencia'); // Cria referencia_id e referencia_tipo
            $table->dateTime('data_movimentacao')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes_estoque');
    }
};
