<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdemServicoResource;
use App\Services\AgendaService;
use App\Services\ClassificacaoOSService;
use App\Services\ClienteService;
use App\Services\EquipamentoService;
use App\Services\StatusOSService;

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
        $data = request('data');

        $agendas = $this->agendaService->getAll()
            ->when($search, function ($query) use ($search) {
                return $query->where('titulo', 'like', "%$search%");
            })
            ->when($data, function ($query) use ($data) {
                return $query->where('data_agendamento', '=', $data);
            })
            ->get();

        return response()->json(["status" => "success", "data" => OrdemServicoResource::collection($agendas)], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $agenda = $this->agendaService->findByID($id);

        return $agenda;
    }
}
