<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVariacaoProdutoRequest extends FormRequest
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
        'sku' => 'required|string|unique:variacoes_produto,sku',
        'preco' => 'required|numeric|min:0',
        'valores' => 'nullable|array',
        'valores.*' => 'nullable|exists:valores_atributo,id'
    ];
    }
}
