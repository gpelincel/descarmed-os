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

    protected function prepareForValidation() {
        $this->merge([
            'data_inicio' => $this->convertDate($this->data_inicio),
            'data_conclusao' => $this->convertDate($this->data_conclusao),
            'preco' => $this->convertPreco($this->preco),
        ]);
    }

    private function convertDate($date) {
        if (!$date) return null;

        try {
            return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return $date;
        }
    }

    private function convertPreco($valor) {
        if (!$valor) return 0;

        // Remove "R$", pontos e troca vírgula por ponto
        $limpo = str_replace(['R$', '.', ','], ['', '', '.'], $valor);

        return is_numeric($limpo) ? $limpo : 0;
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
            'id_status' => 'nullable',
            'id_classificacao' => 'required|integer|exists:classificacao_os,id',
            'data_inicio' => 'required|date',
            'data_conclusao' => 'nullable|date|after_or_equal:data_inicio',
            'preco' => 'nullable|numeric|min:0',
            'id_equipamento' => 'nullable',
        ];
    }

    public function messages() {
        return [
            'titulo.required' => 'O campo de serviço é obrigatório',
            'titulo.string' => 'O campo de serviço deve ser um texto',
            'titulo.max' => 'O campo de serviço deve ter no máximo 255 caracteres',

            'descricao.string' => 'A descrição deve ser um texto',

            'id_classificacao.required' => 'A classificação é obrigatória',
            'id_classificacao.integer' => 'A classificação deve ser um número inteiro',
            'id_classificacao.exists' => 'A classificação selecionada é inválida',

            'data_inicio.required' => 'A data de início é obrigatória',
            'data_inicio.date' => 'A data de início deve estar em um formato válido',

            'data_conclusao.date' => 'A data de conclusão deve estar em um formato válido',
            'data_conclusao.after_or_equal' => 'A data de conclusão deve ser depois ou igual à data de início',

            'preco.numeric' => 'O valor deve ser um número',
            'preco.min' => 'O valor deve ser no mínimo 0',
        ];
    }
}
