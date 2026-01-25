<?php

namespace App\Http\Controllers;

use App\Models\StatusOS;
use Illuminate\Http\Request;
use App\Services\StatusOSService;

class StatusOSController extends Controller
{
    private $statusOSService;

    public function __construct(StatusOSService $statusOSService) {
        $this->statusOSService = $statusOSService;
    }

    public function index(){
        $status = $this->statusOSService->getAll()->where('ativo', '=', '1');
        if (request()->wantsJson()) {
            return response()->json([
                "status" => "success",
                "data" => $status
            ]);
        }
        return $status;
    }

    public function store(Request $request){
        $this->statusOSService->save($request->all());
        return redirect()->back()->with('status', 'success')->with('message', 'Status de OS cadastrado com sucesso!');
    }

    public function destroy(string $id) {
        $status = $this->statusOSService->delete($id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Status deletado com sucesso', 'data' => $status], 200);
        }

        return redirect('/configuracao')->with('status', 'success')->with('message', 'Status deletado com sucesso!');
    }

    public function show(string $id){
        $statusOS = $this->statusOSService->findByID($id);
        return view('status_os.show', compact('statusOS'));
    }
}
