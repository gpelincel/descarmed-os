<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Http\Requests\StoreOrdemServicoRequest;
use App\Http\Requests\UpdateOrdemServicoRequest;
use App\Services\ClienteService;
use App\Services\OrdemServicoService;
use App\Services\StatusOSService;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdemServicoController extends Controller {

    private $osService;
    private $clienteService;
    private $statusService;

    public function __construct(OrdemServicoService $osService, ClienteService $clienteService, StatusOSService $statusService) {
        $this->osService = $osService;
        $this->clienteService = $clienteService;
        $this->statusService = $statusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $ordens = $this->osService->getAll();
        $status = $this->statusService->getAll();
        
        if (request()->wantsJson()){
            return response()->json($ordens);
        } else {
            $clientes = $this->clienteService->getAll()->get();
        }

        return view('ordem_servico', compact('ordens','clientes', 'status'));
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

        if (request()->wantsJson()){
            return response()->json($ordem);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'OS cadastrada com sucesso!');
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

        if (request()->wantsJson()){
            return response()->json($ordem);
        }

        return redirect()->back()->with('status', 'success')->with('message', 'OS atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $ordem = $this->osService->delete($id);
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Ordem de serviço deletada com sucesso', 'data' => $ordem], 200);
        }
        
        return redirect()->back()->with('status', 'success')->with('message','Ordem de serviço deletada com sucesso!');
    }

    public function imprimir(string $id){
        $ordemServico = $this->show($id);
        $ordemServico->equipamento->cliente->endereco = $ordemServico->equipamento->cliente->endereco->toArray();
        $pdf = Pdf::loadView('impressao', $ordemServico->toArray());
        return $pdf->stream();
        // return view('impressao', compact('ordemServico'));
    }
}