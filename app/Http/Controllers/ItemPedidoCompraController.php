<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreItemPedidoCompraRequest;
use App\Models\PedidoCompra;
use Illuminate\Support\Facades\DB;
use App\Models\ItemPedidoCompra;

class ItemPedidoCompraController extends Controller
{
    public function store(StoreItemPedidoCompraRequest $request, PedidoCompra $pedido)
    {
        if ($pedido->status !== 'rascunho') {
            return redirect()->route('pedidos-compra.show', $pedido)
                            ->with('error', 'Não é possível adicionar itens a um pedido que não está em modo rascunho.');
        }

        try {
            DB::transaction(function () use ($request, $pedido) {
                $item = $pedido->itens()->create($request->validated());

                $novoTotal = $pedido->itens()->sum(DB::raw('quantidade * custo_unitario'));
                $pedido->update(['valor_total' => $novoTotal]);
            });
        } catch (\Exception $e) {
            return redirect()->route('pedidos-compra.show', $pedido)
                            ->with('error', 'Ocorreu um erro ao adicionar o item.');
        }

        return redirect()->route('pedidos-compra.show', $pedido)
                        ->with('success', 'Item adicionado ao pedido com sucesso!');
    }

    public function destroy(ItemPedidoCompra $item)
    {
        $pedidoCompra = $item->pedidoCompra;

        if ($pedidoCompra->status !== 'rascunho') {
            return redirect()->route('pedidos-compra.show', $pedidoCompra)
                            ->with('error', 'Não é possível remover itens de um pedido que não está em modo rascunho.');
        }

        try {
            DB::transaction(function () use ($item, $pedidoCompra) {
                $item->delete();

                $novoTotal = $pedidoCompra->itens()->sum(DB::raw('quantidade * custo_unitario'));
                $pedidoCompra->update(['valor_total' => $novoTotal]);
            });
        } catch (\Exception $e) {
            return redirect()->route('pedidos-compra.show', $pedidoCompra)
                            ->with('error', 'Ocorreu um erro ao remover o item.');
        }

        return redirect()->route('pedidos-compra.show', $pedidoCompra)
                        ->with('success', 'Item removido do pedido com sucesso!');
    }
}
