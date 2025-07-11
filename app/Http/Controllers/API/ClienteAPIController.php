<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Services\AgendaService;
use App\Services\ClassificacaoOSService;
use App\Services\ClienteService;
use App\Services\OrdemServicoService;
use App\Services\StatusOSService;
use App\Services\UnidadeService;
use DateTime;
use Illuminate\Routing\Route;

class ClienteAPIController extends Controller {

    protected $clienteService;
    protected $osService;
    protected $statusService;
    protected $agendaService;
    protected $classificacaoService;
    protected $unidadeService;

    public function __construct(ClienteService $clienteService, OrdemServicoService $osService, StatusOSService $statusService, AgendaService $agendaService, ClassificacaoOSService $classificacaoOSService, UnidadeService $unidadeService) {
        $this->clienteService = $clienteService;
        $this->osService = $osService;
        $this->statusService = $statusService;
        $this->agendaService = $agendaService;
        $this->unidadeService = $unidadeService;
        $this->classificacaoService = $classificacaoOSService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $search = request('search');
        $field = request('field', 'nome'); // Valor padrão: 'nome'

        // Lista de campos permitidos para busca
        $allowedFields = ['nome', 'cnpj'];
        if (!in_array($field, $allowedFields)) {
            $field = 'nome';
        }

        $clientes = $this->clienteService->getAll()
            ->when($search, function ($query) use ($search, $field) {
                return $query->where($field, 'like', "%$search%");
            })->paginate(10);

        return response()->json($clientes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request) {
        $cliente = $this->clienteService->save($request->all());

        return response()->json(['message' => 'Cliente cadastrado com sucesso', 'data' => $cliente], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $cliente = $this->clienteService->findByID($id);

        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClienteRequest $request, string $id) {
        $cliente = $this->clienteService->edit($request->all(), $id);

        return response()->json(['message' => 'Cliente atualizado com sucesso', 'data' => $cliente], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $cliente = $this->clienteService->delete($id);

        return response()->json(['message' => 'Cliente deletado com sucesso', 'data' => $cliente], 200);
    }

    public function getEquipamentos(string $id) {
        $cliente = $this->clienteService->findByID($id);

        return response()->json(['status' => 'success', 'data' => $cliente->equipamentos()->get()], 200);
    }
}
