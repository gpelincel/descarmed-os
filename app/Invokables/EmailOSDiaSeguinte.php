<?php

namespace App\Invokables;

use App\Mail\LembreteAgenda;
use App\Mail\LembreteAgendamentosMail;
use App\Services\AgendaService;
use App\Services\OrdemServicoService;
use Illuminate\Support\Facades\Mail;

class EmailOSDiaSeguinte {
    public function __construct(private AgendaService $agendaService) {
    }

    public function __invoke() {
        $ordens = $this->agendaService->getTomorrow();
        Mail::to(env("EMAIL_ADMIN"))->send(new LembreteAgendamentosMail($ordens));
    }
}
