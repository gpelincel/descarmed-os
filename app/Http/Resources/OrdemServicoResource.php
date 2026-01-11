<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdemServicoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'cliente' => $this->cliente,
            'descricao' => $this->descricao,
            'codigo_compra' => $this->codigo_compra,
            'nota_fiscal' => $this->nota_fiscal,
            'valor_total' => (float)$this->valor_total,
            'equipamento' => $this->equipamento,
            'itens' => $this->items,
            'anexos' => $this->anexo,
            'status' => $this->status,
            'classificacao' => $this->classificacao,
            'data_inicio' => $this->data_inicio,
            'data_agendamento' => $this->data_agendamento,
            'data_conclusao' => $this->data_conclusao,
            'is_assinado_cliente' => !empty($this->assinatura_cliente),
            'is_assinado_tecnico' => !empty($this->assinatura_tecnico),
        ];
    }
}
