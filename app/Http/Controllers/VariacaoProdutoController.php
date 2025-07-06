<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\VariacaoProduto;
use App\Http\Requests\StoreVariacaoProdutoRequest;
use App\Http\Requests\UpdateVariacaoProdutoRequest;
use App\Models\Atributo;

class VariacaoProdutoController extends Controller
{
    public function store(StoreVariacaoProdutoRequest $request, Produto $produto)
    {
        $validatedData = $request->validated();

        $variacao = $produto->variacoes()->create($request->only(['sku', 'preco', 'estoque_atual']));

        if (isset($validatedData['valores'])) {
            $valoresFiltrados = array_filter($validatedData['valores']);

            if (!empty($valoresFiltrados)) {
                $variacao->valores()->attach($valoresFiltrados);
            }
        }

        return redirect()->route('produtos.show', $produto)->with('success', 'Variação adicionada com sucesso!');
    }

    public function destroy(VariacaoProduto $variacao)
    {
        $produtoId = $variacao->produto_id;
        $variacao->delete();

        return redirect()->route('produtos.show', $produtoId)->with('success', 'Variação movida para a lixeira!');
    }

    public function edit(VariacaoProduto $variacao)
    {
        $atributos = Atributo::with('valores')->get();

        $valoresAtuaisIds = $variacao->valores->pluck('id')->toArray();

        return view('variacoes.edit', [
            'variacao' => $variacao,
            'atributos' => $atributos,
            'valoresAtuaisIds' => $valoresAtuaisIds,
        ]);
    }

    public function update(UpdateVariacaoProdutoRequest $request, VariacaoProduto $variacao)
    {
        $validatedData = $request->validated();

        $variacao->update([
            'sku' => $validatedData['sku'],
            'preco' => $validatedData['preco'],
            'estoque_atual' => $validatedData['estoque_atual'],
        ]);

        if (isset($validatedData['valores'])) {
            $variacao->valores()->sync($validatedData['valores']);
        }

        return redirect()->route('produtos.show', $variacao->produto_id)->with('success', 'Variação atualizada com sucesso!');
    }
}
