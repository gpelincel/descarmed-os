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
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'id_status' => ['required', 'integer', 'exists:statuses,id'],
            'id_classificacao' => ['required', 'integer', 'exists:classificacoes,id'],
            'data_inicio' => ['required', 'date', 'before_or_equal:data_conclusao'],
            'data_conclusao' => ['nullable', 'date', 'after_or_equal:data_inicio'],
            'preco' => ['required', 'numeric', 'min:0'],
            'id_equipamento' => ['required', 'integer', 'exists:equipamentos,id'],
        ];
    }
}
