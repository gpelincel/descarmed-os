<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipamentoRequest;
use App\Models\Equipamento;
use App\Services\ClienteService;
use App\Services\EquipamentoService;

class EquipamentoAPIController extends Controller {
    protected $equipamentoService;
    protected $clienteService;

    public function __construct(EquipamentoService $equipamentoService, ClienteService $clienteService) {
        $this->equipamentoService = $equipamentoService;
        $this->clienteService = $clienteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $search = request('search');
        $field = request('field', 'nome'); // Valor padrão: 'nome'

        // Lista de campos permitidos para busca
        $allowedFields = ['nome', 'numero_serie', 'numero_patrimonio', 'id'];
        if (!in_array($field, $allowedFields)) {
            $field = 'nome';
        }

        $equipamentos = $this->equipamentoService->getAll();

        $equipamentos = $equipamentos->when($search, function ($query) use ($search, $field) {
            return $query->where($field, 'like', "%$search%");
        })->paginate(10);

        $equipamentos->appends(request()->query());

        return response()->json($equipamentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipamentoRequest $request) {
        $equipamento = $this->equipamentoService->save($request->all());

        return response()->json(['message' => 'Equipamento criado com sucesso', 'data' => $equipamento], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $equipamento = $this->equipamentoService->findByID($id);

        return response()->json($equipamento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEquipamentoRequest $request, string $id) {
        $equipamento = $this->equipamentoService->edit($request->all(), $id);

        return response()->json(['message' => 'Equipamento atualizado com sucesso', 'data' => $equipamento], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $equipamento = $this->equipamentoService->delete($id);

        return response()->json(['message' => 'Equipamento deletado com sucesso', 'data' => $equipamento], 200);
    }
}
