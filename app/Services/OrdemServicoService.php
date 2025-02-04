<?php

namespace App\Services;

use App\Models\OrdemServico;

class OrdemServicoService {
    public function findByID(string $id) {
        return OrdemServico::findOrFail($id);
    }

    public function getAll() {
        return OrdemServico::paginate(10);
    }

    public function save(array $ordemServico) {
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
        $ordemServico->update($novoOrdemServico);
        return $ordemServico;
    }
}
