<?php

namespace App\Services;

use App\Models\OrdemServico;
use DateTime;

class OrdemServicoService {
    public function findByID(string $id) {
        return OrdemServico::with(['equipamento', 'cliente.endereco', 'status', 'classificacao'])->findOrFail($id);
    }

    public function findByCliente(string $id_cliente) {
        return OrdemServico::with(['cliente', 'status'])->where('id_cliente', $id_cliente);
    }


    public function getAll() {
        $ordens = OrdemServico::with(['equipamento', 'status', 'cliente'])->orderBy('data_inicio', 'desc');
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

        if ($ordemServico['id_status'] == 0) {
            $ordemServico['id_status'] = null;
        }

        if (isset($ordemServico['nota_fiscal'])) {
            $ordemServico['id_status'] = 2;
        }

        if ($ordemServico['novo-eqp'] == "1") {
            $equipamentoService = new EquipamentoService();
            $equipamentoNovo = $equipamentoService->save($ordemServico);
            $ordemServico['id_equipamento'] = $equipamentoNovo['id'];
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

        if ($ordemServico['id_status'] == 0) {
            $ordemServico['id_status'] = null;
        }

        if (isset($ordemServico['nota_fiscal'])) {
            $ordemServico['id_status'] = 2;
        }

        if ($ordemServico['novo-eqp'] == "1") {
            $equipamentoService = new EquipamentoService();
            $equipamentoNovo = $equipamentoService->save($ordemServico);
            $ordemServico['id_equipamento'] = $equipamentoNovo['id'];
        }

        $ordemServico->update($novoOrdemServico);
        return $ordemServico;
    }
}
