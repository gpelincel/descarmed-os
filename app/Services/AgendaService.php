<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\OrdemServico;
use DateTime;

class AgendaService {
    public function findByID(string $id) {
        return OrdemServico::with(['cliente', 'equipamento'])->findOrFail($id);
    }

    public function getAll() {
        return OrdemServico::query()->whereNotNull('data_agendamento');
    }

    public function edit($novoAgendamento, $id){
        $agendamento = OrdemServico::findOrFail($id);
        $agendamento->update($novoAgendamento);
        dd($novoAgendamento);
        return $agendamento;
    }

    public function getByCliente($id_cliente) {
        return OrdemServico::with(['cliente'])
            ->whereHas('ordem_servico', function ($query) use ($id_cliente) {
                $query->whereHas('equipamento', function ($query) use ($id_cliente) {
                    $query->where('id_cliente', $id_cliente);
                });
            });
    }
}
