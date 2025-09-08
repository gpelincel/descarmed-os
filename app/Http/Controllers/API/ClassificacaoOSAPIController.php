<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ClassificacaoOSService;
use Illuminate\Http\Request;

class ClassificacaoOSAPIController extends Controller
{
    private $classificacaoOSService;

    public function __construct(ClassificacaoOSService $classificacaoOSService) {
        $this->classificacaoOSService = $classificacaoOSService;
    }

    public function index(){
        $classificacoes = $this->classificacaoOSService->getAll();
        if (request()->wantsJson()) {
            return response()->json([
                "status" => "success",
                "data" => $classificacoes
            ]);
        }
        return $classificacoes;
    }

    public function store(Request $request){
        $this->classificacaoOSService->save($request->all());
        return redirect()->back()->with('status', 'success')->with('message', 'Classificação de OS cadastrado com sucesso!');
    }
}
