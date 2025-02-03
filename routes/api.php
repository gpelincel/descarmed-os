<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('clientes', ClienteController::class);
Route::resource('os', OrdemServicoController::class);
