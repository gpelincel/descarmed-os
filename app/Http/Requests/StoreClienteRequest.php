<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'nome' => 'required|string|max:255',
            'razao_social' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:20|unique:clientes,cnpj',
            'email' => 'required|string|email|max:255|unique:clientes,email',
            'telefone' => 'required|string|max:20',
        ];
    }

    public function messages(): array {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.string' => 'O nome deve ser um texto',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres',
    
            'razao_social.string' => 'A razão social deve ser um texto',
            'razao_social.max' => 'A razão social deve ter no máximo 255 caracteres',
    
            'cnpj.required' => 'O CNPJ é obrigatório',
            'cnpj.string' => 'O CNPJ deve ser um texto',
            'cnpj.max' => 'O CNPJ deve ter exatamente 14 dígitos',
            'cnpj.unique' => 'Este CNPJ já está cadastrado',
    
            'email.required' => 'O e-mail é obrigatório',
            'email.string' => 'O e-mail deve ser um texto',
            'email.email' => 'O e-mail deve ser um endereço válido',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres',
            'email.unique' => 'Este e-mail já está cadastrado',
    
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.string' => 'O telefone deve ser um texto',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres',
        ];
    }
    
}
