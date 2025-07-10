<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariacaoProduto;
use App\Models\Venda;
use App\Models\User;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function vendas(Request $request)
    {
        $request->validate([
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $dataInicio = $request->input('data_inicio', now()->startOfMonth()->format('Y-m-d'));
        $dataFim = $request->input('data_fim', now()->endOfMonth()->format('Y-m-d'));

        $userId = $request->input('user_id');

        $inicio = Carbon::parse($dataInicio)->startOfDay();
        $fim = Carbon::parse($dataFim)->endOfDay();

        $vendasQuery = Venda::with(['cliente', 'user'])
                            ->whereBetween('created_at', [$inicio, $fim]);

        if ($userId) {
            $vendasQuery->where('user_id', $userId);
        }

        $vendas = $vendasQuery->get();

        $totalVendido = $vendas->sum('valor_final');
        $numeroDeVendas = $vendas->count();
        $ticketMedio = ($numeroDeVendas > 0) ? $totalVendido / $numeroDeVendas : 0;

        $vendedores = User::orderBy('name')->get();

        return view('relatorios.vendas', [
            'vendas' => $vendas,
            'totalVendido' => $totalVendido,
            'numeroDeVendas' => $numeroDeVendas,
            'ticketMedio' => $ticketMedio,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'vendedores' => $vendedores,
            'vendedorSelecionadoId' => $userId,
        ]);
    }

    public function gerarVendasPDF(Request $request)
    {
        $dataInicio = $request->input('data_inicio', now()->startOfMonth()->format('Y-m-d'));
        $dataFim = $request->input('data_fim', now()->endOfMonth()->format('Y-m-d'));
        $userId = $request->input('user_id');

        $inicio = Carbon::parse($dataInicio)->startOfDay();
        $fim = Carbon::parse($dataFim)->endOfDay();

        $vendasQuery = Venda::with(['cliente', 'user'])->whereBetween('created_at', [$inicio, $fim]);
        if ($userId) {
            $vendasQuery->where('user_id', $userId);
        }
        $vendas = $vendasQuery->get();

        $totalVendido = $vendas->sum('valor_final');
        $vendedor = $userId ? User::find($userId) : null;

        $dados = [
            'vendas' => $vendas,
            'totalVendido' => $totalVendido,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'vendedor' => $vendedor,
        ];

        $pdf = Pdf::loadView('relatorios.pdf.vendas_pdf', $dados);

        return $pdf->setPaper('a4', 'landscape')->stream('relatorio_vendas.pdf');
    }
}
