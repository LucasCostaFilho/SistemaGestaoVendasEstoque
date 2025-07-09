<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Models\CategoriaProduto;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Atributo;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::paginate(10);


        return view('produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaProduto::all();

        return view('produtos.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $request)
    {
        Produto::create($request->validated());

    // Redireciona para a lista de produtos com uma mensagem de sucesso
    return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
{
    // Carregamos os relacionamentos necessários de forma explícita.
    // Esta é a parte mais importante:
    $produto->load([
        // Para a relação 'categoria', passamos uma função customizada
        'categoria' => function ($query) {
            $query->withTrashed(); // withTrashed() diz: "inclua os registros da lixeira!"
        },
        // Também já carregamos as variações para otimizar
        'variacoes.valores.atributo'
    ]);

    // O controller de Pedido de Compra também precisa enviar a lista de atributos
    // Vamos adicionar aqui também para a tela de 'show' do produto
    $atributos = \App\Models\Atributo::with('valores')->get();

    return view('produtos.show', [
        'produto' => $produto,
        'atributos' => $atributos
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $categorias = CategoriaProduto::all();

        return view('produtos.edit', [
            'produto' => $produto,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $produto->update($request->validated());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        if ($produto->variacoes()->where('estoque_atual', '>', 0)->exists()) {
        return redirect()->route('produtos.index')->with('error', 'Não é possível excluir um produto que ainda possui variações com estoque.');
    }

    $produto->delete();

    return redirect()->route('produtos.index')->with('success', 'Produto desativado!');
    }
}
