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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venda_id')->constrained()->onDelete('cascade');
            $table->enum('metodo', ['cartao_credito', 'cartao_debito', 'pix', 'boleto', 'dinheiro']);
            $table->decimal('valor', 10, 2);
            $table->integer('parcelas')->default(1);
            $table->enum('status', ['pendente', 'aprovado', 'recusado', 'estornado'])->default('pendente');
            $table->string('transaction_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
