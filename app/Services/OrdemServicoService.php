<?php

namespace App\Services;

use App\Http\Requests\StoreUpdateItemRequest;
use App\Models\OrdemServico;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

            if (isset($ordemServico['itens'])) {
                foreach ($ordemServico['itens'] as $item) {
                    if ($item['quantidade'] > 0) {
                        $item['id_os'] = $ordemReturn->id;
                        $this->itemService->save($item);
                    }
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

    private function base64ToUploadedFile($base64, $filename = 'file.png') {
        // Remove prefixo "data:image/png;base64,"
        $fileData = preg_replace('/^data:.*;base64,/', '', $base64);
        $fileData = base64_decode($fileData);

        // Cria arquivo temporário
        $tmpFilePath = sys_get_temp_dir() . '/' . $filename;
        file_put_contents($tmpFilePath, $fileData);

        // Cria UploadedFile
        return new UploadedFile(
            $tmpFilePath,
            $filename,
            mime_content_type($tmpFilePath),
            null,
            true // $test mode - evita mover arquivo real
        );
    }

    public function sign(Request $request, string $id) {
        $assinatura_cliente = $request->input('assinatura_cliente');
        $assinatura_tecnico = $request->input('assinatura_tecnico');

        $ordemServico = OrdemServico::findOrFail($id);

        if ($assinatura_cliente) {
            $uploadedFile = $this->base64ToUploadedFile($assinatura_cliente, 'assinatura_cliente.png');
            $path = $uploadedFile->store('assinaturas', 'public');
            $ordemServico->assinatura_cliente = $path;
        }

        if ($assinatura_tecnico) {
            $uploadedFile = $this->base64ToUploadedFile($assinatura_tecnico, 'assinatura_tecnico.png');
            $path = $uploadedFile->store('assinaturas', 'public');
            $ordemServico->assinatura_tecnico = $path;
        }

        $ordemServico->save();

        return $ordemServico;
    }
}
