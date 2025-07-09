<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaProduto;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriaProduto::create([
            'nome' => 'Eletrônicos',
            'descricao' => 'Produtos eletrônicos',
        ]);

        CategoriaProduto::create([
            'nome' => 'Roupas',
            'descricao' => 'Produtos de vestuário',
        ]);

        CategoriaProduto::create([
            'nome' => 'Móveis',
            'descricao' => 'Produtos para casa',
        ]);
    }
}
