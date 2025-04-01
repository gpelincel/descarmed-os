<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdemServicoRequest extends FormRequest {
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
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'id_status' => 'required|integer|exists:status_os,id',
            'id_classificacao' => 'required|integer|exists:classificacao_os,id',
            'data_inicio' => 'required|date|before_or_equal:data_conclusao',
            'data_conclusao' => 'nullable|date|after_or_equal:data_inicio',
            'preco' => 'numeric|min:0',
            'id_equipamento' => 'required|integer|exists:equipamentos,id',
        ];
    }

    public function messages() {
        return [
            'titulo.required' => 'O campo de serviço é obrigatório',
            'titulo.string' => 'O campo de serviço deve ser um texto',
            'titulo.max' => 'O campo de serviço deve ter no máximo 255 caracteres',

            'descricao.string' => 'A descrição deve ser um texto',

            'id_status.required' => 'O status é obrigatório',
            'id_status.exists' => 'O status selecionado é inválido',

            'id_classificacao.required' => 'A classificação é obrigatória',
            'id_classificacao.integer' => 'A classificação deve ser um número inteiro',
            'id_classificacao.exists' => 'A classificação selecionada é inválida',

            'data_inicio.required' => 'A data de início é obrigatória',
            'data_inicio.date' => 'A data de início deve estar em um formato válido',
            'data_inicio.before_or_equal' => 'A data de início deve ser antes ou igual à data de conclusão',

            'data_conclusao.date' => 'A data de conclusão deve estar em um formato válido',
            'data_conclusao.after_or_equal' => 'A data de conclusão deve ser depois ou igual à data de início',

            'preco.numeric' => 'O valor deve ser um número',
            'preco.min' => 'O valor deve ser no mínimo 0',

            'id_equipamento.required' => 'O equipamento é obrigatório',
            'id_equipamento.integer' => 'O equipamento deve ser um número inteiro',
            'id_equipamento.exists' => 'O equipamento selecionado é inválido',
        ];
    }
}
