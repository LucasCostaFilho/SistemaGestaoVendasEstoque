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
        CategoriaProduto::create(['nome' => 'Eletrônicos']);
        CategoriaProduto::create(['nome' => 'Roupas e Acessórios']);
        CategoriaProduto::create(['nome' => 'Alimentos e Bebidas']);
    }
}
