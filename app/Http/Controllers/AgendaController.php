<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdemServicoRequest;
use App\Services\AgendaService;
use App\Services\ClassificacaoOSService;
use App\Services\ClienteService;
use App\Services\EquipamentoService;
use App\Services\StatusOSService;
use Illuminate\Http\Request;

class AgendaController extends Controller {
    protected $agendaService;
    protected $equipamentoService;
    protected $statusOSService;
    protected $clienteService;
    protected $classificacaoService;

    public function __construct(AgendaService $agendaService, EquipamentoService $equipamentoService, StatusOSService $statusOSService, ClienteService $clienteService, ClassificacaoOSService $classificacaoService) {
        $this->agendaService = $agendaService;
        $this->equipamentoService = $equipamentoService;
        $this->statusOSService = $statusOSService;
        $this->clienteService = $clienteService;
        $this->classificacaoService = $classificacaoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $search = request('search');

        $agendas = $this->agendaService->getAll()
            ->when($search, function ($query) use ($search) {
                return $query->where('nome', 'like', "%$search%");
            })
            ->paginate(10);

        $equipamentos = $this->equipamentoService->getAll()->get();
        $status = $this->statusOSService->getAll();
        $clientes = $this->clienteService->getAll()->get();
        $classificacao = $this->classificacaoService->getAll();

        return view('agenda', compact('agendas', 'equipamentos', 'status', 'clientes', 'classificacao'));
    }

    public function update(StoreOrdemServicoRequest $request, string $id) {
        $agenda = $this->agendaService->edit($request->all(), $id);
        return redirect()->back()->with('status', 'success')->with('message', 'Agendamento atualizado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $agenda = $this->agendaService->findByID($id);

        return $agenda;
    }
}