<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use App\Services\ClassificacaoOSService;
use App\Services\ClienteService;
use App\Services\EquipamentoService;
use App\Services\StatusOSService;
use Illuminate\Http\Request;

class AgendaAPIController extends Controller {
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

        if (request()->wantsJson()) {
            return $agendas;
        }

        $equipamentos = $this->equipamentoService->getAll()->get();
        $status = $this->statusOSService->getAll();
        $clientes = $this->clienteService->getAll()->get();
        $classificacao = $this->classificacaoService->getAll();

        return view('agenda', compact('agendas', 'equipamentos', 'status', 'clientes', 'classificacao'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $agenda = $this->agendaService->save($request->all());

        if (request()->wantsJson()) {
            return $agenda;
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Agendamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $agenda = $this->agendaService->findByID($id);

        return $agenda;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $agenda = $this->agendaService->edit($request->all(), $id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Agendamento atualizado com sucesso', 'data' => $agenda], 200);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Agendamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $agenda = $this->agendaService->delete($id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Agendamento deletado com sucesso', 'data' => $agenda], 200);
        }

        return redirect('/agenda')->with('status', 'success')->with('message', 'Agendamento deletado com sucesso!');
    }
}
