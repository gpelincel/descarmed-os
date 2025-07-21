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
            'numero_serie' => 'required|string|max:50|unique:equipamentos,numero_serie',
            'numero_patrimonio' => 'required|string|max:50|unique:equipamentos,numero_patrimonio',
            'nome' => 'required|string|max:255',
            'id_cliente' => 'required|integer|exists:clientes,id'
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'nome' => strtoupper($this->nome),
        ]);
    }

    public function messages(): array {
        return [
            'numero_serie.required' => 'O número de série é obrigatório',
            'numero_serie.string' => 'O número de série deve ser um texto',
            'numero_serie.max' => 'O número de série deve ter no máximo 50 caracteres',
            'numero_serie.unique' => 'Este número de série já está cadastrado',

            'numero_patrimonio.required' => 'O número de patrimônio é obrigatório',
            'numero_patrimonio.string' => 'O número de patrimônio deve ser um texto',
            'numero_patrimonio.max' => 'O número de patrimônio deve ter no máximo 50 caracteres',
            'numero_patrimonio.unique' => 'Este número de patrimônio já está cadastrado',
    
            'nome.required' => 'O nome é obrigatório',
            'nome.string' => 'O nome deve ser um texto',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres',
    
            'id_cliente.required' => 'O cliente é obrigatório',
            'id_cliente.integer' => 'O cliente deve ser um número inteiro',
            'id_cliente.exists' => 'O cliente selecionado é inválido',
        ];
    }
    
}
