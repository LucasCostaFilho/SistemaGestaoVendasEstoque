<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use App\Http\Requests\StoreValorAtributoRequest;
use Illuminate\Http\Request;
use App\Models\ValorAtributo;
use App\Http\Requests\UpdateValorAtributoRequest;

class ValorAtributoController extends Controller
{
    public function store(StoreValorAtributoRequest $request, Atributo $atributo)
    {
        $dadosValidados = $request->validated();

        $atributo->valores()->create($dadosValidados);

        return redirect()->route('atributos.show', $atributo)->with('success', 'Valor adicionado com sucesso!');
    }

    public function destroy(ValorAtributo $valor)
    {
        $atributoId = $valor->atributo_id;

        $valor->delete();

        return redirect()->route('atributos.show', $atributoId)->with('success', 'Valor excluído com sucesso!');
    }

    public function edit(ValorAtributo $valor)
    {
        return view('valores.edit', ['valor' => $valor]);
    }

    public function update(UpdateValorAtributoRequest $request, ValorAtributo $valor)
    {
        $valor->update($request->validated());

        return redirect()->route('atributos.show', $valor->atributo_id)->with('success', 'Valor atualizado com sucesso!');
    }
}
