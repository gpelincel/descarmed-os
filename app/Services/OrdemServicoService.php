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
        $ordens = OrdemServico::with(['equipamento', 'status'])->orderBy('data_inicio', 'desc')->paginate(10);
        return $ordens;
    }

    public function save(array $ordemServico) {
        try {
            $ordemServico['data_conclusao'] = DateTime::createFromFormat('d/m/Y', $ordemServico['data_conclusao'])->format('Y-m-d');
            $ordemServico['data_inicio'] = DateTime::createFromFormat('d/m/Y', $ordemServico['data_inicio'])->format('Y-m-d');
    
            $ordemServico = OrdemServico::create($ordemServico);

            return $ordemServico;
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function delete(string $id) {
        $ordemServico = OrdemServico::findOrFail($id);
        $ordemServico->delete();

        return $ordemServico;
    }

    public function edit(array $novoOrdemServico, string $id) {
        $ordemServico = OrdemServico::findOrFail($id);
        $novoOrdemServico['data'] = DateTime::createFromFormat('d/m/Y', $novoOrdemServico['data'])->format('Y-m-d');
        $ordemServico->update($novoOrdemServico);
        return $ordemServico;
    }
}
