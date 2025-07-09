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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('restrict');
            $table->dateTime('data_venda')->useCurrent();
            $table->decimal('valor_bruto', 10, 2);
            $table->decimal('desconto', 10, 2)->default(0);
            $table->decimal('valor_frete', 10, 2)->default(0);
            $table->decimal('valor_final', 10, 2);
            $table->enum('status', ['pendente_pagamento', 'processando', 'enviado', 'concluido', 'cancelado'])->default('pendente_pagamento');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
