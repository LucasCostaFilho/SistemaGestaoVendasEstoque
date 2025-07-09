<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run()
    {
        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Smartphone',
            'descricao' => 'Smartphone modelo X',
            'marca' => 'Marca A',
        ]);

        Produto::create([
            'categoria_id' => 2,
            'nome' => 'Camiseta',
            'descricao' => 'Camiseta branca',
            'marca' => 'Marca B',
        ]);

        Produto::create([
            'categoria_id' => 3,
            'nome' => 'Sofá',
            'descricao' => 'Sofá de 3 lugares',
            'marca' => 'Marca C',
        ]);
    }
}