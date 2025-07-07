<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\VariacaoProduto;
use App\Http\Requests\StoreVendaRequest;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function create()
    {
        $clientePadrao = Cliente::where('cpf', '000.000.000-00')->first();

        $variacoes = VariacaoProduto::with(['produto', 'valores.atributo'])->get();

        return view('vendas.create', [
            'clientePadrao' => $clientePadrao,
            'variacoes' => $variacoes
        ]);
    }

    public function store(StoreVendaRequest $request)
    {
        // Os dados já foram validados pelo StoreVendaRequest, incluindo o estoque
        $dadosValidados = $request->validated();
        $itensVenda = $dadosValidados['itens'];
        $clienteId = $dadosValidados['cliente_id'];

        try {
            $venda = DB::transaction(function () use ($itensVenda, $clienteId) {

                // 1. Calcula os totais
                $valorBruto = 0;
                foreach($itensVenda as $item) {
                    $variacao = VariacaoProduto::find($item['id']);
                    $valorBruto += $variacao->preco * $item['quantidade'];
                }

                // 2. Cria o registro principal da Venda
                $novaVenda = Venda::create([
                    'cliente_id' => $clienteId,
                    'data_venda' => now(),
                    'valor_bruto' => $valorBruto,
                    'valor_final' => $valorBruto, // Simplificado, sem desconto/frete por enquanto
                    'status' => 'concluido', // ou 'processando'
                ]);

                // 3. Itera sobre os itens do carrinho para salvar e dar baixa no estoque
                foreach ($itensVenda as $item) {
                    $variacao = VariacaoProduto::find($item['id']);

                    // 3.1. Cria o ItemVenda
                    $itemVendaSalvo = $novaVenda->itens()->create([
                        'variacao_produto_id' => $variacao->id,
                        'quantidade' => $item['quantidade'],
                        'preco_unitario' => $variacao->preco,
                        'subtotal' => $variacao->preco * $item['quantidade'],
                    ]);

                    // 3.2. Dá baixa no estoque
                    $variacao->decrement('estoque_atual', $item['quantidade']);

                    // 3.3. Cria o registro de movimentação de estoque
                    $variacao->movimentacoesEstoque()->create([
                        'tipo' => 'saida',
                        'quantidade' => $item['quantidade'],
                        'referencia_id' => $itemVendaSalvo->id,
                        'referencia_type' => \App\Models\ItemVenda::class,
                        'observacao' => 'Saída via Venda #' . $novaVenda->id,
                    ]);
                }

                return $novaVenda; // Retorna a venda criada para usar no redirect
            });

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao processar a venda: '.$e->getMessage()], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Venda registrada com sucesso!',
            'redirect_url' => route('vendas.show', $venda) // Futura tela de sucesso/detalhes da venda
        ]);
    }

    // Adicione este método para a página de sucesso
    public function show(Venda $venda)
    {
        return "Venda #{$venda->id} registrada com sucesso!";
    }

}
