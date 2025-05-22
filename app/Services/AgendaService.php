<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\OrdemServico;
use DateTime;

class AgendaService {
    public function findByID(string $id) {
        return Agenda::with(['ordem_servico.cliente', 'ordem_servico.equipamento'])->findOrFail($id);
    }

    public function getAll() {
        return Agenda::query();
    }

    public function save(array $agenda) {
        $agenda['data'] = DateTime::createFromFormat('d/m/Y', $agenda['data'])->format('Y-m-d');
        $agenda['data_inicio'] = $agenda['data'];
        $agenda['data_aviso'] = date('Y-m-d', strtotime($agenda['data'] . ' -' . (int)$agenda['tempo_aviso'] . ' days'));

        $agenda['id_classificacao'] = 3;

        $os = OrdemServico::create($agenda);
        $agenda['id_os'] = $os['id'];
        $agenda = Agenda::create($agenda);

        return $agenda;
    }

    public function delete(string $id) {
        $agenda = Agenda::findOrFail($id);
        $id_os = $agenda['id_os'];
        $os = OrdemServico::findOrFail($id_os);

        $os->delete();
        $agenda->delete();

        return $agenda;
    }

    public function edit(array $novoAgenda, string $id) {
        // Formatar datas
        $novoAgenda['data'] = DateTime::createFromFormat('d/m/Y', $novoAgenda['data_inicio'])->format('Y-m-d');
        $novoAgenda['data_inicio'] = $novoAgenda['data'];
        $novoAgenda['data_aviso'] = date('Y-m-d', strtotime($novoAgenda['data'] . ' -' . (int)$novoAgenda['tempo_aviso'] . ' days'));
    
        // Busca a agenda existente
        $agenda = Agenda::findOrFail($id);
    
        // Atualiza ou recria a OS associada
        if ($agenda->id_os) {
            $os = OrdemServico::findOrFail($agenda->id_os);
            $os->update($novoAgenda);
        } else {
            $os = OrdemServico::create($novoAgenda);
            $novoAgenda['id_os'] = $os->id;
        }
    
        // Atualiza a agenda com os novos dados
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
