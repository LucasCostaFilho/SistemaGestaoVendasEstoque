<?php

namespace App\Http\Controllers;

use App\Models\PedidoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePedidoCompraRequest;
use App\Models\Fornecedor;
use App\Models\VariacaoProduto;
use Illuminate\Support\Facades\Auth;


class PedidoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = PedidoCompra::with('fornecedor')->latest()->paginate(10);
        return view('pedidos-compra.index', ['pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fornecedores = Fornecedor::orderBy('razao_social')->get();
        return view('pedidos-compra.create', ['fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoCompraRequest $request)
    {
        $pedidoCompra = PedidoCompra::create($request->validated());

        $pedidoCompra['user_id'] = auth()->id();

        return redirect()->route('pedidos-compra.show', $pedidoCompra)
                        ->with('success', 'Pedido de compra criado! Agora adicione os itens.');

    }

    /**
     * Display the specified resource.
     */
    public function show(PedidoCompra $pedidoCompra)
    {
        $pedidoCompra->load(['fornecedor', 'itens.variacaoProduto.produto']);

        $variacoes = \App\Models\VariacaoProduto::with('produto')->get();

        return view('pedidos-compra.show', [
            'pedido' => $pedidoCompra,
            'variacoes' => $variacoes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedidoCompra $pedidoCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PedidoCompra $pedidoCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoCompra $pedidoCompra)
    {
        //
    }

    public function receberEstoque(Request $request, PedidoCompra $pedidoCompra)
    {
        if ($pedidoCompra->status !== 'rascunho') {
            return redirect()->back()->with('error', 'Este pedido não pode mais ser recebido.');
        }

        if ($pedidoCompra->itens->isEmpty()) {
            return redirect()->back()->with('error', 'Não é possível receber um pedido sem itens.');
        }

        try {
            DB::transaction(function () use ($pedidoCompra) {
                foreach ($pedidoCompra->itens as $item) {
                    $variacao = $item->variacaoProduto;

                    $variacao->increment('estoque_atual', $item->quantidade);

                    $variacao->movimentacoesEstoque()->create([
                        'tipo' => 'entrada',
                        'quantidade' => $item->quantidade,
                        'referencia_id' => $item->id,
                        'referencia_type' => \App\Models\ItemPedidoCompra::class,
                        'observacao' => 'Entrada via Pedido de Compra #' . $pedidoCompra->id,
                    ]);
                }

                $pedidoCompra->update(['status' => 'recebido_total']);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar o recebimento: ' . $e->getMessage());
        }

        return redirect()->route('pedidos-compra.show', $pedidoCompra)->with('success', 'Estoque atualizado com sucesso a partir do Pedido de Compra!');
    }
}
