<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAtributoRequest;
use App\Http\Requests\UpdateAtributoRequest;

class AtributoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atributos = Atributo::paginate(10);
        return view('atributos.index', ['atributos' => $atributos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('atributos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAtributoRequest $request)
    {
        Atributo::create($request->validated());
        return redirect()->route('atributos.index')->with('success', 'Atributo criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atributo $atributo)
    {
        $atributo->load('valores');
    
        return view('atributos.show', ['atributo' => $atributo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atributo $atributo)
    {
        return view('atributos.edit', ['atributo' => $atributo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAtributoRequest $request, Atributo $atributo)
    {
        $atributo->update($request->validated());

        return redirect()->route('atributos.index')->with('success', 'Atributo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atributo $atributo)
    {
        $atributo->delete();

        return redirect()->route('atributos.index')->with('success', 'Atributo excluído com sucesso!');
    }
}
