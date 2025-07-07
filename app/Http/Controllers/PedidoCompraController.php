<?php

namespace App\Http\Controllers;

use App\Models\PedidoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PedidoCompra $pedidoCompra)
    {
        //
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
        if ($pedidoCompra->status !== 'enviado') {
            return redirect()->back()->with('error', 'Este pedido não pode ser recebido.');
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
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar o recebimento.');
        }

        return redirect()->route('pedidos-compra.show', $pedidoCompra)->with('success', 'Estoque atualizado com sucesso a partir do Pedido de Compra!');
    }
}
