<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVariacaoProdutoRequest extends FormRequest
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
        $variacaoId = $this->variacao->id;

        return [
            'sku' => ['required', 'string', Rule::unique('variacoes_produto', 'sku')->ignore($variacaoId)],
            'preco' => 'required|numeric|min:0',
            'estoque_atual' => 'required|integer|min:0',
            'valores' => 'required|array',
            'valores.*' => 'exists:valor_atributos,id'
        ];
    }
}
