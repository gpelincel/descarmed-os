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
            'cliente' => $this->cliente->nome,
            'status' => $this->status->descricao ?? "N/A",
            'classificacao' => $this->classificacao->descricao ?? "N/A",
            'data_inicio' => date_create($this->data_inicio)->format('d/m/Y')
        ];
    }
}
