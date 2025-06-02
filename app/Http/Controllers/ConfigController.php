<?php

namespace App\Http\Controllers;

use App\Services\ClassificacaoOSService;
use App\Services\StatusOSService;
use App\Services\UnidadeService;

class ConfigController extends Controller
{
    private $statusOSService;
    private $classificacaoOSService;
    private $unidadeService;

    public function __construct(StatusOSService $statusOSService, ClassificacaoOSService $classificacaoOSService, UnidadeService $unidadeService) {
        $this->statusOSService = $statusOSService;
        $this->classificacaoOSService = $classificacaoOSService;
        $this->unidadeService = $unidadeService;
    }

    public function index(){
        $statusOS = $this->statusOSService->getAll();
        $classificacaoOS = $this->classificacaoOSService->getAll();
        $unidade = $this->unidadeService->getAll();
        return view('configuracao', compact('statusOS', 'classificacaoOS', 'unidade'));
    }
}
