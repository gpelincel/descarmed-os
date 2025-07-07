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
            'cod_compra' => $this->codigo_compra,
            'nota_fiscal' => $this->nota_fiscal,
            'valor_total' => $this->preco,
            'equipamento' => $this->equipamento,
            'itens' => $this->items,
            'status' => $this->status->descricao ?? "N/A",
            'classificacao' => $this->classificacao->descricao ?? "N/A",
            'data_inicio' => date_create($this->data_inicio)->format('d/m/Y')
        ];
    }
}
