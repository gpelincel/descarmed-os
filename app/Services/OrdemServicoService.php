<?php

namespace App\Services;

use App\Models\OrdemServico;
use DateTime;

class OrdemServicoService {
    public function findByID(string $id) {
        return OrdemServico::with('cliente')->findOrFail($id);
    }

    public function getAll() {
        $ordens = OrdemServico::with('cliente')->orderBy('data', 'desc')->paginate(10);
        return $ordens;
    }

    public function save(array $ordemServico) {
        $ordemServico['data'] = DateTime::createFromFormat('d/m/Y', $ordemServico['data'])->format('Y-m-d');

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
