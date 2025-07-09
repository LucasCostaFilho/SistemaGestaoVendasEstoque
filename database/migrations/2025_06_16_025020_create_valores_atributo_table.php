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
        Schema::create('valores_atributo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atributo_id')->constrained()->onDelete('cascade');
            $table->string('valor', 100);
            $table->unique(['atributo_id', 'valor']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valores_atributo');
    }
};
