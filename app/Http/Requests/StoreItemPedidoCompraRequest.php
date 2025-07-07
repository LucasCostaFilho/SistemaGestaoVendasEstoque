<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemPedidoCompraRequest extends FormRequest
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
        $pedidoCompraId = $this->route('pedido');

        return [
            'variacao_produto_id' => [
                'required',
                'exists:variacoes_produto,id',
                Rule::unique('itens_pedido_compra')->where('pedido_compra_id', $pedidoCompraId)
            ],
            'quantidade' => 'required|integer|min:1',
            'custo_unitario' => 'required|numeric|min:0',
        ];
    }
    
    public function messages(): array
    {
        // Mensagem de erro customizada para a regra de unicidade
        return [
            'variacao_produto_id.unique' => 'Este produto já foi adicionado a este pedido de compra.',
        ];
    }
}