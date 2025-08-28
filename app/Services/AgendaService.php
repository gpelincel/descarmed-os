<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\OrdemServico;
use Carbon\Carbon;
use DateTime;

class AgendaService {
    public function findByID(string $id) {
        return OrdemServico::with(['cliente', 'equipamento'])->findOrFail($id);
    }

    public function getAll() {
        return OrdemServico::query()->whereNotNull('data_agendamento')->orderBy('data_agendamento', 'desc');
    }

    public function edit($novoAgendamento, $id) {
        $agendamento = OrdemServico::findOrFail($id);
        $agendamento->update($novoAgendamento);
        dd($novoAgendamento);
        return $agendamento;
    }

    public function getByCliente($id_cliente) {
        return OrdemServico::query()->whereNotNull('data_agendamento')->where('id_cliente', $id_cliente)->whereDate('data_agendamento', '>=', Carbon::today())->orderBy('data_agendamento', 'desc');
    }

    public function getTomorrow(){
        return OrdemServico::query()->whereNotNull('data_agendamento')->whereDate('data_agendamento', '=', Carbon::tomorrow())->where('status', '<>', '2')->get();
    }
}
