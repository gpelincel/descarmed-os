<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $itemService;

    public function __construct(ItemService $itemService) {
        $this->itemService = $itemService;
    }

    public function store(Request $request){
        $this->itemService->save($request->all());
    }
}
