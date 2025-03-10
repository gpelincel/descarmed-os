<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatusOSService;

class ConfigController extends Controller
{
    private $statusOSService;

    public function __construct(StatusOSService $statusOSService) {
        $this->statusOSService = $statusOSService;
    }

    public function index(){
        $statusOS = $this->statusOSService->getAll();
        return view('configuracao', compact('statusOS'));
    }
}
