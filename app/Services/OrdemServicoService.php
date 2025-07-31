<?php

namespace App\Services;

use App\Models\OrdemServico;
use Illuminate\Support\Facades\Date;

class OrdemServicoService {

    private $itemService;
    private $equipamentoService;

    public function __construct(ItemService $itemService, EquipamentoService $equipamentoService) {
        $this->itemService = $itemService;
        $this->equipamentoService = $equipamentoService;
    }

    public function findByID(string $id) {
        return OrdemServico::with(['equipamento', 'cliente.endereco', 'status', 'classificacao', 'items.unidade'])->findOrFail($id);
    }

    public function findByCliente(string $id_cliente) {
        return OrdemServico::with(['equipamento', 'status', 'cliente'])->where('id_cliente', $id_cliente);
    }


    public function getAll() {
        $ordens = OrdemServico::with(['equipamento', 'status', 'cliente', 'classificacao'])->orderBy('data_inicio', 'desc');
        return $ordens;
    }

    public function save(array $ordemServico) {

        if (isset($ordemServico['equipamento'])) {
            $equipamento = $this->equipamentoService->save($ordemServico['equipamento']);
            $ordemServico['id_equipamento'] = $equipamento->id;
        }

        $ordemReturn = OrdemServico::create($ordemServico);

        if (isset($ordemServico['itens'])) {
            foreach ($ordemServico['itens'] as $item) {
                $item['id_os'] = $ordemReturn->id;
                $this->itemService->save($item);
            }
        }

        return $ordemReturn;
    }

    public function delete(string $id) {
        $ordemServico = OrdemServico::findOrFail($id);
        $ordemServico->delete();

        return $ordemServico;
    }

    public function edit(array $novoOrdemServico, string $id) {
        extract($novoOrdemServico);

        $ordemServico = OrdemServico::findOrFail($id);
        if (!empty($ordemServico['data_conclusao'])) {
            $data = Date::createFromFormat('d/m/Y', $ordemServico['data_conclusao']);
            if ($data) {
                $novoOrdemServico['data_conclusao'] = $data->format('Y-m-d');
            }
        }

        if (!empty($ordemServico['data_inicio'])) {
            $data = Date::createFromFormat('d/m/Y', $ordemServico['data_inicio']);
            if ($data) {
                $novoOrdemServico['data_inicio'] = $data->format('Y-m-d');
            }
        }

        if ($novoOrdemServico['id_status'] == 0) {
            $novoOrdemServico['id_status'] = null;
        }

        if (isset($novoOrdemServico['nota_fiscal'])) {
            $novoOrdemServico['id_status'] = 2;
        }

        if (isset($ordemServico['novo-eqp']) && $ordemServico['novo-eqp'] == "1") {
            $equipamentoService = new EquipamentoService();
            $equipamentoNovo = $equipamentoService->save($ordemServico);
            $novoOrdemServico['id_equipamento'] = $equipamentoNovo['id'];
        }

        $ordemReturn = $ordemServico->update($novoOrdemServico);

        if (isset($novoOrdemServico['qtd_1']) && $novoOrdemServico['qtd_1'] > 0) {
            for ($i = 1; $i <= $item_counter; $i++) {
                $item['quantidade'] = $novoOrdemServico['qtd_' . $i];
                $item['nome'] = $novoOrdemServico['nome_item_' . $i];
                $item['valor_unitario'] = $novoOrdemServico['valor_un_' . $i];
                $item['id_os'] = $id;

                $itemService = new ItemService();

                if (isset($novoOrdemServico['id_item_' . $i])) {
                    $item['id'] = $novoOrdemServico['id_item_' . $i];

                    if ($item['quantidade'] == 0) {
                        $itemService->delete($item['id']);
                    } else {
                        $itemService->edit($item);
                    }
                } else {
                    $itemService->save($item);
                }
            }
        }


        return $novoOrdemServico;
    }
}
