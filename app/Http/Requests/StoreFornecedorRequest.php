<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
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
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:fornecedores,cnpj|max:18',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:15',
        ];
    }
}
