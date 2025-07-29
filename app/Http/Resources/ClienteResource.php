<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "razao_social" => $this->razao_social,
            "cnpj" => $this->cnpj,
            "email" => $this->email,
            "telefone" => $this->telefone,
            "endereco" => $this->endereco
        ];
    }
}
