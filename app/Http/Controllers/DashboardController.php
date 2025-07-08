<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use Illuminate\Support\Carbon;
use App\Models\VariacaoProduto;
use App\Models\ItemVenda;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Calcula o total de vendas realizadas no dia de hoje.
        $totalVendasHoje = Venda::whereDate('created_at', Carbon::today())->sum('valor_final');

        $limiteEstoqueBaixo = 10;

        $produtosBaixoEstoqueCount = VariacaoProduto::where('estoque_atual', '<=', $limiteEstoqueBaixo)
            ->where('estoque_atual', '>', 0)
            ->count();

        $numeroVendasHoje = Venda::whereDate('created_at', Carbon::today())->count();

        $topProdutos = ItemVenda::select('variacao_produto_id', DB::raw('SUM(quantidade) as total_vendido'))
            ->whereHas('venda', function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->groupBy('variacao_produto_id')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->with('variacaoProduto.produto') // Carrega os nomes para exibição
            ->get();

        return view('dashboard', [
            'totalVendasHoje' => $totalVendasHoje,
            'produtosBaixoEstoqueCount' => $produtosBaixoEstoqueCount,
            'numeroVendasHoje' => $numeroVendasHoje,
            'topProdutos' => $topProdutos,
        ]);
    }
}
