<?php

namespace App\Http\Controllers;

use App\Services\UnidadeService;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    private $unidadeService;

    public function __construct(UnidadeService $unidadeService) {
        $this->unidadeService = $unidadeService;
    }

    public function index(){
        $unidades = $this->unidadeService->getAll();
        if (request()->wantsJson()) {
            return response()->json([
                "status" => "success",
                "data" => $unidades
            ]);
        }
        return $unidades;
    }

    public function store(Request $request){
        $this->unidadeService->save($request->all());
        return redirect()->back()->with('status', 'success')->with('message', 'Unidade cadastrada com sucesso!');
    }

    public function show(string $id){
        $unidade = $this->unidadeService->findByID($id);
        return view('status_os.show', compact('unidade'));
    }
}
