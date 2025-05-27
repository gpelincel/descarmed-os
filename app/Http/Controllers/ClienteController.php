<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\ClassificacaoOS;
use App\Services\AgendaService;
use App\Services\ClassificacaoOSService;
use App\Services\ClienteService;
use App\Services\OrdemServicoService;
use App\Services\StatusOSService;
use Illuminate\Routing\Route;

class ClienteController extends Controller {

    protected $clienteService;
    protected $osService;
    protected $statusService;
    protected $agendaService;
    protected $classificacaoService;

    public function __construct(ClienteService $clienteService, OrdemServicoService $osService, StatusOSService $statusService, AgendaService $agendaService, ClassificacaoOSService $classificacaoOSService) {
        $this->clienteService = $clienteService;
        $this->osService = $osService;
        $this->statusService = $statusService;
        $this->agendaService = $agendaService;
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
            })
            ->paginate(10);

        if (request()->wantsJson()) {
            return $clientes;
        }

        $status = $this->statusService->getAll();
        $classificacao = $this->classificacaoService->getAll();

        return view('clientes', compact('clientes', 'status', 'classificacao'));
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
    public function store(StoreClienteRequest $request) {
        $cliente = $this->clienteService->save($request->all());

        if (request()->wantsJson()) {
            return $cliente;
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $cliente = $this->clienteService->findByID($id);
        $cliente->agendas = $this->getAgenda($id);

        if (request()->wantsJson()) {
            return $cliente;
        }

        $status = $this->statusService->getAll();
        $classificacao = $this->classificacaoService->getAll();

        return view('cliente-info', compact('cliente', 'status', 'classificacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, string $id) {
        $cliente = $this->clienteService->edit($request->all(), $id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Cliente atualizado com sucesso', 'data' => $cliente], 200);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $cliente = $this->clienteService->delete($id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Cliente deletado com sucesso', 'data' => $cliente], 200);
        }

        return redirect('/cliente')->with('status', 'success')->with('message', 'Cliente deletado com sucesso!');
    }

    public function getAgenda(string $id) {
        return $this->agendaService->getByCliente($id);
    }
}
