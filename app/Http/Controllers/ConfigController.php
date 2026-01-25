<?php

namespace App\Http\Controllers;

use App\Services\ClassificacaoOSService;
use App\Services\StatusOSService;
use App\Services\UnidadeService;
use Illuminate\Http\Request;

class ConfigController extends Controller {
    private $statusOSService;
    private $classificacaoOSService;
    private $unidadeService;

    public function __construct(StatusOSService $statusOSService, ClassificacaoOSService $classificacaoOSService, UnidadeService $unidadeService) {
        $this->statusOSService = $statusOSService;
        $this->classificacaoOSService = $classificacaoOSService;
        $this->unidadeService = $unidadeService;
    }

    public function index() {
        $statusOS = $this->statusOSService->getAll();
        $classificacaoOS = $this->classificacaoOSService->getAll();
        $unidade = $this->unidadeService->getAll();
        return view('configuracao', compact('statusOS', 'classificacaoOS', 'unidade'));
    }

    public function show($type, $id) {
        $config = null;
        switch ($type) {
            case 'status':
                $config = $this->statusOSService->findByID($id);
                break;
            case 'classificacao':
                $config = $this->classificacaoOSService->findByID($id);
                break;
            case 'unidade':
                $config = $this->unidadeService->findByID($id);
                break;
        }

        return $config;
    }

    public function edit($type, $id, Request $request) {
        $config = null;
        $data = $request->all();
        switch ($type) {
            case 'status':
                $data['id_status'] = $id;
                $config = $this->statusOSService->edit($data);
                break;
            case 'classificacao':
                $data['id_classificacao'] = $id;
                $config = $this->classificacaoOSService->edit($data);
                break;
            case 'unidade':
                $data['id_unidade'] = $id;
                $config = $this->unidadeService->edit($data);
                break;
        }

        return redirect('/configuracao')->with('status', 'success')->with('message', 'Configuração editada com sucesso!');
    }
}
