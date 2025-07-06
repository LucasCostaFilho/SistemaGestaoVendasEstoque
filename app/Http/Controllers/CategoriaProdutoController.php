<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaProduto;
use App\Http\Requests\StoreCategoriaProdutoRequest;
use App\Http\Requests\UpdateCategoriaProdutoRequest;

class CategoriaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = CategoriaProduto::paginate(10);
        return view('categorias.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaProdutoRequest $request)
    {
        CategoriaProduto::create($request->validated());

        return redirect()->route('categorias.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaProduto $categoria)
    {
        return view('categorias.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaProdutoRequest $request, CategoriaProduto $categoria)
    {
        $categoria->update($request->validated());
    return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaProduto $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
