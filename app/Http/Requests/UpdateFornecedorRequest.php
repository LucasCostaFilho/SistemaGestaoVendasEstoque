<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFornecedorRequest extends FormRequest
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
        $fornecedorId = $this->fornecedor->id;
        return [
            'razao_social' => 'required|string|max:255',
            'cnpj' => ['required', 'string', 'max:18', Rule::unique('fornecedores')->ignore($fornecedorId)],
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:15',
        ];
    }
}
