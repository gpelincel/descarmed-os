<?php

namespace App\Http\Controllers;

use App\Services\ClassificacaoOSService;
use App\Services\StatusOSService;

class ConfigController extends Controller
{
    private $statusOSService;
    private $classificacaoOSService;

    public function __construct(StatusOSService $statusOSService, ClassificacaoOSService $classificacaoOSService) {
        $this->statusOSService = $statusOSService;
        $this->classificacaoOSService = $classificacaoOSService;
    }

    public function index(){
        $statusOS = $this->statusOSService->getAll();
        $classificacaoOS = $this->classificacaoOSService->getAll();
        return view('configuracao', compact('statusOS', 'classificacaoOS'));
    }
}
