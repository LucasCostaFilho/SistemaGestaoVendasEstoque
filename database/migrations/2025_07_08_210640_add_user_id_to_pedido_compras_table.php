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
        Schema::table('pedidos_compra', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('fornecedor_id')->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos_compra', function (Blueprint $table) {
            Schema::table('vendas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            
            $table->dropColumn('user_id');
        });
        });
    }
};
