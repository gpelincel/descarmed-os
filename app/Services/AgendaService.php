<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\OrdemServico;
use DateTime;

class AgendaService {
    public function findByID(string $id) {
        return Agenda::findOrFail($id);
    }

    public function getAll() {
        return Agenda::query();
    }

    public function save(array $agenda) {
        $agenda['data'] = DateTime::createFromFormat('d/m/Y', $agenda['data_inicio'])->format('Y-m-d');
        $agenda['data_inicio'] = $agenda['data'];
        $agenda['data_aviso'] = date('Y-m-d', strtotime($agenda['data'] . ' -' . (int)$agenda['tempo_aviso'] . ' days'));

        $os = OrdemServico::create($agenda);
        $agenda['id_os'] = $os['id'];
        $agenda = Agenda::create($agenda);

        return $agenda;
    }

    public function delete(string $id) {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return $agenda;
    }

    public function edit(array $novoAgenda, string $id) {
        $agenda = Agenda::findOrFail($id);
        $agenda->update($novoAgenda);
        return $agenda;
    }

    public function getByCliente($id_cliente) {
        return Agenda::with(['ordem_servico.equipamento.cliente'])
            ->whereHas('ordem_servico', function ($query) use ($id_cliente) {
                $query->whereHas('equipamento', function ($query) use ($id_cliente) {
                    $query->where('id_cliente', $id_cliente);
                });
            }); // Certifique-se de chamar get() para executar a query
    }
}
