<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipamentoRequest extends FormRequest {
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
            'codigo' => 'required|string|max:50|unique:equipamentos,codigo',
            'nome' => 'required|string|max:255',
            'id_cliente' => 'required|integer|exists:clientes,id'
        ];
    }

    public function messages(): array {
        return [
            'codigo.required' => 'O código é obrigatório',
            'codigo.string' => 'O código deve ser um texto',
            'codigo.max' => 'O código deve ter no máximo 50 caracteres',
            'codigo.unique' => 'Este código já está cadastrado',
    
            'nome.required' => 'O nome é obrigatório',
            'nome.string' => 'O nome deve ser um texto',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres',
    
            'id_cliente.required' => 'O cliente é obrigatório',
            'id_cliente.integer' => 'O cliente deve ser um número inteiro',
            'id_cliente.exists' => 'O cliente selecionado é inválido',
        ];
    }
    
}
