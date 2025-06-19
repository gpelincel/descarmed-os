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
        $status = $this->statusOSService->getAll();
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

    public function show(string $id){
        $statusOS = $this->statusOSService->findByID($id);
        return view('status_os.show', compact('statusOS'));
    }
}
