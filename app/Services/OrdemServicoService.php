<?php

namespace App\Services;

use App\Models\OrdemServico;
use DateTime;

class OrdemServicoService {
    public function findByID(string $id) {
        return OrdemServico::with(['equipamento.cliente.endereco', 'status', 'classificacao'])->findOrFail($id);
    }

    public function findByCliente(string $id_cliente) {
        return OrdemServico::with(['equipamento.cliente', 'status'])
            ->whereHas('equipamento', function ($query) use ($id_cliente) {
                $query->where('id_cliente', $id_cliente);
            });
    }


    public function getAll() {
        $ordens = OrdemServico::with(['equipamento', 'status'])->orderBy('data_inicio', 'desc');
        return $ordens;
    }

    public function save(array $ordemServico) {
        if (!empty($ordemServico['data_conclusao'])) {
            $data = DateTime::createFromFormat('d/m/Y', $ordemServico['data_conclusao']);
            if ($data) {
                $ordemServico['data_conclusao'] = $data->format('Y-m-d');
            }
        }
        
        if (!empty($ordemServico['data_inicio'])) {
            $data = DateTime::createFromFormat('d/m/Y', $ordemServico['data_inicio']);
            if ($data) {
                $ordemServico['data_inicio'] = $data->format('Y-m-d');
            }
        }

        $ordemServico = OrdemServico::create($ordemServico);

        return $ordemServico;
    }

    public function delete(string $id) {
        $ordemServico = OrdemServico::findOrFail($id);
        $ordemServico->delete();

        return $ordemServico;
    }

    public function edit(array $novoOrdemServico, string $id) {
        $ordemServico = OrdemServico::findOrFail($id);
        if (!empty($ordemServico['data_conclusao'])) {
            $data = DateTime::createFromFormat('d/m/Y', $ordemServico['data_conclusao']);
            if ($data) {
                $novoOrdemServico['data_conclusao'] = $data->format('Y-m-d');
            }
        }
        
        if (!empty($ordemServico['data_inicio'])) {
            $data = DateTime::createFromFormat('d/m/Y', $ordemServico['data_inicio']);
            if ($data) {
                $novoOrdemServico['data_inicio'] = $data->format('Y-m-d');
            }
        }
        $ordemServico->update($novoOrdemServico);
        return $ordemServico;
    }
}
