<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEndereco extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    protected function prepareForValidation() {
        $this->merge([
            'logradouro' => strtoupper($this->logradouro),
            'estado' => strtoupper($this->estado),
            'bairro' => strtoupper($this->bairro),
            'cidade' => strtoupper($this->cidade),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'cep' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string',
            'numero' => 'nullable|numeric|min:0',
            'complemento' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string',
            'id_cliente' => 'required|integer|exists:clientes,id',
        ];
    }

    public function messages() {
        return [
            'cep.required' => 'O campo de CEP é obrigatório',
            'numero.min' => 'O valor deve ser no mínimo 0',
            'id_cliente.required' => 'O endereço deve pertencer a um cliente',
            'id_cliente.exists' =>'Cliente não encontrado'
        ];
    }
}
