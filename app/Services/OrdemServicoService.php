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
                if ($item['quantidade'] > 0) {
                    $item['id_os'] = $ordemReturn->id;
                    $this->itemService->save($item);
                }
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

        if (isset($novoOrdemServico['equipamento'])) {
            $equipamento = $this->equipamentoService->save($novoOrdemServico['equipamento']);
            $novoOrdemServico['id_equipamento'] = $equipamento->id;
        }

        if (isset($novoOrdemServico['itens'])) {
            foreach ($novoOrdemServico['itens'] as $item) {
                if (isset($item['id'])) {
                    $item['quantidade'] > 0 ? $this->itemService->edit($item) : $this->itemService->delete($item['id']);
                } else {
                    if ($item['quantidade'] > 0) {
                        $item['id_os'] = $id;
                        $this->itemService->save($item);
                    }
                }
            }
        }

        $ordemServico = OrdemServico::findOrFail($id);
        $ordemReturn = $ordemServico->update($novoOrdemServico);

        return $ordemReturn;
    }
}
