<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentacaoEstoque;

class MovimentacaoEstoqueController extends Controller
{
    public function index()
    {
        $movimentacoes = MovimentacaoEstoque::with([
            'variacaoProduto.produto', 
            'referencia' 
        ])
        ->latest('data_movimentacao')
        ->paginate(25);

        return view('estoque.index', ['movimentacoes' => $movimentacoes]);
    }
}
