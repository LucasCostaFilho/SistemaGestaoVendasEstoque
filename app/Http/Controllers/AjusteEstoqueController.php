<?php

namespace App\Http\Controllers;

use App\Models\VariacaoProduto;
use App\Models\AjusteEstoque;
use App\Http\Requests\StoreAjusteEstoqueRequest; // Importe o request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AjusteEstoqueController extends Controller
{
    /**
     * Mostra o formulário para criar um novo ajuste de estoque.
     */
    public function create()
    {
        $variacoes = VariacaoProduto::with('produto')->get();
        return view('estoque.ajuste', ['variacoes' => $variacoes]);
    }

    /**
     * Salva o novo ajuste de estoque no banco de dados.
     */
    public function store(StoreAjusteEstoqueRequest $request)
    {
        $dadosValidados = $request->validated();

        $variacao = VariacaoProduto::find($dadosValidados['variacao_produto_id']);
        $quantidade = $dadosValidados['quantidade'];
        $tipoAjuste = $dadosValidados['tipo_ajuste'];

        // Validação extra: não permitir saída de estoque maior que o atual
        if ($tipoAjuste === 'saida' && $variacao->estoque_atual < $quantidade) {
            return redirect()->back()->with('error', 'Estoque insuficiente para este ajuste de saída.')->withInput();
        }

        try {
            // Usamos uma transação para garantir que tudo aconteça, ou nada aconteça.
            DB::transaction(function () use ($variacao, $quantidade, $tipoAjuste, $dadosValidados) {
                
                // 1. Cria o registro do Ajuste, que é a nossa "justificativa"
                $ajuste = AjusteEstoque::create([
                    'user_id' => Auth::id(),
                    'tipo' => 'ajuste_' . $tipoAjuste,
                    'motivo' => $dadosValidados['motivo'],
                ]);

                // 2. Atualiza o estoque na tabela de variações
                if ($tipoAjuste === 'entrada') {
                    $variacao->increment('estoque_atual', $quantidade);
                } else {
                    $variacao->decrement('estoque_atual', $quantidade);
                }

                // 3. Cria a movimentação de estoque referenciando o ajuste polimórfico
                $ajuste->movimentacao()->create([
                    'variacao_produto_id' => $variacao->id,
                    'tipo' => $tipoAjuste,
                    'quantidade' => $quantidade,
                    'observacao' => 'Ajuste manual: ' . $dadosValidados['motivo'],
                ]);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar o ajuste. Por favor, tente novamente.');
        }

        return redirect()->route('estoque.ajuste.create')->with('success', 'Ajuste de estoque registrado com sucesso!');
    }
}