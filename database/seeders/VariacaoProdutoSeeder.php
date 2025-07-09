<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VariacaoProduto;

class VariacaoProdutoSeeder extends Seeder
{
    public function run()
    {
        VariacaoProduto::create([
            'produto_id' => 1,
            'sku' => 'SM123',
            'preco' => 999.99,
            'custo' => 800.00,
            'estoque_atual' => 100,
            'peso_kg' => 0.5,
        ]);

        VariacaoProduto::create([
            'produto_id' => 2,
            'sku' => 'CM456',
            'preco' => 29.99,
            'custo' => 15.00,
            'estoque_atual' => 500,
            'peso_kg' => 0.1,
        ]);

        VariacaoProduto::create([
            'produto_id' => 3,
            'sku' => 'SO789',
            'preco' => 499.99,
            'custo' => 300.00,
            'estoque_atual' => 200,
            'peso_kg' => 2.0,
        ]);
    }
}