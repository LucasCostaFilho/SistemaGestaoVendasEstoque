<?php

namespace App\Http\Requests;

use App\Models\VariacaoProduto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreVendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1',
            'itens.*.id' => 'required|exists:variacoes_produto,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ];
    }

    /**
     * Adiciona uma validação customizada após a validação padrão.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // Itera sobre cada item do carrinho para checar o estoque
            foreach ($this->input('itens', []) as $index => $item) {
                $variacao = VariacaoProduto::find($item['id']);

                if ($variacao && $variacao->estoque_atual < $item['quantidade']) {
                    // Adiciona um erro específico para o item que não tem estoque suficiente
                    $validator->errors()->add(
                        "itens.{$index}.quantidade", 
                        "Estoque insuficiente para o produto {$variacao->produto->nome} (SKU: {$variacao->sku}). Disponível: {$variacao->estoque_atual}."
                    );
                }
            }
        });
    }
}
