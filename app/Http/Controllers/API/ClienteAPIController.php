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
            });

        if (request()->wantsJson()) {
            return response()->json([
                "status" => "success",
                "data" => $clientes->get()
            ]);
        }

        $status = $this->statusService->getAll();
        $classificacao = $this->classificacaoService->getAll();
        $unidades = $this->unidadeService->getAll();
        $clientes = $clientes->paginate(10);

        return view('clientes', compact('clientes', 'status', 'classificacao', 'unidades'));
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

        $search = request('search');
        $field = request('field', 'titulo'); // Valor padrão: 'titulo'
        $id_status = request('id_status');
        $data_minima = request('data_inicio');

        // Campos permitidos
        $allowedFields = ['titulo', 'cliente', 'equipamento'];
        if (!in_array($field, $allowedFields)) {
            $field = 'titulo';
        }
        $cliente->ordens_servico = $cliente->ordens_servico()->with('status')->when($search, function ($query) use ($search, $field) {
            switch ($field) {
                case 'cliente':
                    return $query->whereHas('cliente', function ($q) use ($search) {
                        $q->where('nome', 'like', "%$search%");
                    });
                case 'equipamento':
                    return $query->whereHas('equipamento', function ($q) use ($search) {
                        $q->where('nome', 'like', "%$search%");
                    });
                default:
                    return $query->where($field, 'like', "%$search%");
            }
        })
            ->when($id_status && $id_status != 0, function ($query) use ($id_status) {
                return $query->where('id_status', $id_status);
            })
            ->when($data_minima && $data_minima != "", function ($query) use ($data_minima) {
                $data_minima = DateTime::createFromFormat('d/m/Y', $data_minima);
                $data_minima = $data_minima->format('Y-m-d');
                return $query->where('data_inicio', '>=', $data_minima);
            })
            ->paginate(10);

        if (request()->wantsJson()) {
            return $cliente;
        }

        $status = $this->statusService->getAll();
        $classificacao = $this->classificacaoService->getAll();
        $unidades = $this->unidadeService->getAll();

        return view('cliente-info', compact('cliente', 'status', 'classificacao', 'unidades'));
    }

    public function getEquipamentos(string $id) {
        $cliente = $this->clienteService->findByID($id);

        return $cliente->equipamentos()->get();
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
    public function update(StoreClienteRequest $request, string $id) {
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
