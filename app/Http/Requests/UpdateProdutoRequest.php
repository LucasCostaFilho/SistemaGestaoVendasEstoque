<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProdutoRequest extends FormRequest
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
        $produtoId = $this->produto->id;

        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('produtos')->ignore($produtoId),
            ],
            'descricao' => 'nullable|string',
            'marca' => 'nullable|string|max:100',
            'categoria_id' => 'required|exists:categorias_produto,id',
        ];
    }
}
