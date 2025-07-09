<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\VariacaoProduto;
use App\Http\Requests\StoreVendaRequest;
use Illuminate\Support\Facades\Auth;
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
        $dadosValidados = $request->validated();
        $itensVenda = $dadosValidados['itens'];
        $clienteId = $dadosValidados['cliente_id'];

        try {
            $venda = DB::transaction(function () use ($itensVenda, $clienteId) {

                $valorBruto = 0;
                foreach($itensVenda as $item) {
                    $variacao = VariacaoProduto::find($item['id']);
                    $valorBruto += $variacao->preco * $item['quantidade'];
                }

                $novaVenda = Venda::create([
                    'cliente_id' => $clienteId,
                    'user_id' => auth()->id(),
                    'data_venda' => now(),
                    'valor_bruto' => $valorBruto,
                    'valor_final' => $valorBruto,
                    'status' => 'concluido',
                ]);

                foreach ($itensVenda as $item) {
                    $variacao = VariacaoProduto::find($item['id']);

                    $itemVendaSalvo = $novaVenda->itens()->create([
                        'variacao_produto_id' => $variacao->id,
                        'quantidade' => $item['quantidade'],
                        'preco_unitario' => $variacao->preco,
                        'subtotal' => $variacao->preco * $item['quantidade'],
                    ]);

                    $variacao->decrement('estoque_atual', $item['quantidade']);

                    $variacao->movimentacoesEstoque()->create([
                        'tipo' => 'saida',
                        'quantidade' => $item['quantidade'],
                        'referencia_id' => $itemVendaSalvo->id,
                        'referencia_type' => \App\Models\ItemVenda::class,
                        'observacao' => 'Saída via Venda #' . $novaVenda->id,
                    ]);
                }

                return $novaVenda;
            });

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao processar a venda: '.$e->getMessage()], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Venda registrada com sucesso!',
            'redirect_url' => route('vendas.show', $venda)
        ]);
    }

    public function show(Venda $venda)
    {
        return "Venda #{$venda->id} registrada com sucesso!";
    }

}
