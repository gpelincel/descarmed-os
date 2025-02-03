<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Http\Requests\StoreOrdemServicoRequest;
use App\Http\Requests\UpdateOrdemServicoRequest;
use App\Services\OrdemServicoService;

class OrdemServicoController extends Controller {

    private $osService;

    public function __construct(OrdemServicoService $osService) {
        $this->osService = $osService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $ordens = $this->osService->getAll();

        if (request()->wantsJson()){
            return $ordens;
        }

        return view('ordem_servico', ['ordens' => $ordens, 'title' => "Ordem de Serviço"]);
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
    public function store(StoreOrdemServicoRequest $request) {
        $ordem = $this->osService->save($request->all());
        return $ordem;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $ordem = $this->osService->findByID($id);
        return $ordem;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdemServico $ordemServico) {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrdemServicoRequest $request, string $id) {
        $ordem = $this->osService->edit($request->all(), $id);
        return $ordem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $ordem = $this->osService->delete($id);
        return response()->json(['message' => 'Ordem de serviço deletada com sucesso', 'data' => $ordem], 200);
    }
}
