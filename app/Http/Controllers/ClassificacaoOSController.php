<?php

namespace App\Http\Controllers;

use App\Models\ClassificacaoOS;
use App\Services\ClassificacaoOSService;
use Illuminate\Http\Request;

class ClassificacaoOSController extends Controller
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
