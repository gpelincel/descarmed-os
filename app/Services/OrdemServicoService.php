<?php

namespace App\Services;

use App\Models\Anexo;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdemServicoService {

    private $itemService;
    private $equipamentoService;
    private $anexoService;

    public function __construct(ItemService $itemService, EquipamentoService $equipamentoService, AnexoService $anexoService) {
        $this->itemService = $itemService;
        $this->equipamentoService = $equipamentoService;
        $this->anexoService = $anexoService;
    }

    public function findWithAnexos(string $id) {
        $os = OrdemServico::with(['equipamento', 'cliente.endereco', 'status', 'classificacao', 'items.unidade', 'anexos'])->findOrFail($id);

        $os->anexos->map(function ($anexo) {
            $anexo->url = asset(Storage::url($anexo->path));
            return $anexo;
        });

        return $os;
    }

    public function findByID(string $id) {
        return OrdemServico::with(['equipamento', 'cliente.endereco', 'status', 'classificacao', 'items.unidade'])->findOrFail($id);
    }

    public function findByCliente(string $id_cliente) {
        return OrdemServico::with(['equipamento', 'status', 'cliente'])->where('id_cliente', $id_cliente);
    }


    public function getAll() {
        $ordens = OrdemServico::with(['equipamento', 'status', 'cliente', 'classificacao'])->orderBy('id', 'desc');
        return $ordens;
    }

    public function save(array $ordemServico) {
        $ordemReturn = DB::transaction(function () use ($ordemServico) {

            if (isset($ordemServico['equipamento'])) {
                $equipamento = $this->equipamentoService->save($ordemServico['equipamento']);
                $ordemServico['id_equipamento'] = $equipamento->id;
            }

            $ordemReturn = OrdemServico::create($ordemServico);

            if (isset($ordemServico['itens']) && count($ordemServico['itens']) > 0) {
                foreach ($ordemServico['itens'] as $item) {
                    if ($item['quantidade'] > 0) {
                        $item['id_os'] = $ordemReturn->id;
                        $this->itemService->save($item);
                    }
                }
            }

            if (!empty($ordemServico['images'])) {
                foreach ($ordemServico['images'] as $index => $image) {
                    $this->anexoService->store(
                        $image,
                        $ordemReturn->id,
                        "anexo_" . $index
                    );
                }
            }

            return $ordemReturn;
        });

        return $ordemReturn;
    }

    public function delete(string $id) {
        $ordemServico = OrdemServico::findOrFail($id);
        $ordemServico->delete();

        return $ordemServico;
    }

    public function edit(array $novoOrdemServico, string $id) {
        $resultado = DB::transaction(function () use ($novoOrdemServico, $id) {

            if (isset($novoOrdemServico['equipamento'])) {
                $equipamento = $this->equipamentoService->save($novoOrdemServico['equipamento']);
                $novoOrdemServico['id_equipamento'] = $equipamento->id;
            }

            if (isset($novoOrdemServico['itens'])) {
                foreach ($novoOrdemServico['itens'] as $item) {
                    if (isset($item['id'])) {
                        $item['quantidade'] > 0
                            ? $this->itemService->edit($item)
                            : $this->itemService->delete($item['id']);
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
        });

        return $resultado;
    }

    public function sign(Request $request, string $id) {
        $assinatura_cliente = $request->input('assinatura_cliente');
        $assinatura_tecnico = $request->input('assinatura_tecnico');

        $ordemServico = OrdemServico::findOrFail($id);

        if ($assinatura_cliente) {
            $uploadedFile = $this->anexoService->base64ToUploadedFile($assinatura_cliente, 'assinatura_cliente.png');
            $path = $uploadedFile->store('assinaturas', 'public');
            $ordemServico->assinatura_cliente = $path;
        }

        if ($assinatura_tecnico) {
            $uploadedFile = $this->anexoService->base64ToUploadedFile($assinatura_tecnico, 'assinatura_tecnico.png');
            $path = $uploadedFile->store('assinaturas', 'public');
            $ordemServico->assinatura_tecnico = $path;
        }

        $ordemServico->save();

        return $ordemServico;
    }
}
