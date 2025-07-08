<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariacaoProduto;

class RelatorioController extends Controller
{
    public function estoqueBaixo()
    {
        $limiteEstoqueBaixo = 10;

        $variacoes = VariacaoProduto::with(['produto', 'valores.atributo'])
                                    ->where('estoque_atual', '<=', $limiteEstoqueBaixo)
                                    ->where('estoque_atual', '>', 0)
                                    ->paginate(20);

        return view('relatorios.estoque_baixo', [
            'variacoes' => $variacoes,
            'limite' => $limiteEstoqueBaixo
        ]);
    }

}
