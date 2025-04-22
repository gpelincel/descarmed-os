<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipamentoRequest;
use App\Models\Equipamento;
use App\Services\ClienteService;
use App\Services\EquipamentoService;

class EquipamentoController extends Controller {
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
        $allowedFields = ['nome', 'codigo'];
        if (!in_array($field, $allowedFields)) {
            $field = 'nome';
        }

        $equipamentos = $this->equipamentoService->getAll()
        ->when($search, function ($query) use ($search, $field) {
            return $query->where($field, 'like', "%$search%");
        })
        ->paginate(10);

        if (request()->wantsJson()) {
            return $equipamentos;
        }
        $clientes = $this->clienteService->getAll()->get();

        return view('equipamentos', compact('equipamentos', 'clientes'));
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
    public function store(StoreEquipamentoRequest $request) {
        $equipamento = $this->equipamentoService->save($request->all());

        if (request()->wantsJson()) {
            return $equipamento;
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $equipamento = $this->equipamentoService->findByID($id);

        if (request()->wantsJson()) {
            return $equipamento;
        }

        return view('equipamento-info', compact('equipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipamento $equipamento) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEquipamentoRequest $request, string $id) {
        $equipamento = $this->equipamentoService->edit($request->all(), $id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Equipamento atualizado com sucesso', 'data' => $equipamento], 200);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Equipamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $equipamento = $this->equipamentoService->delete($id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Equipamento deletado com sucesso', 'data' => $equipamento], 200);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'Equipamento deletado com sucesso!');
    }
}
