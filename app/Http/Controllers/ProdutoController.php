<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Models\CategoriaProduto;
use App\Http\Requests\UpdateProdutoRequest;

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
        return view('produtos.show', ['produto' => $produto]);
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
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído permanentemente com sucesso!');
    }
}
