<?php

use App\Http\Controllers\API\ClienteAPIController;
use App\Http\Controllers\ClassificacaoOSController;
use App\Http\Controllers\API\EquipamentoAPIController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\StatusOSController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware(JwtMiddleware::class)->group(function () {
    Route::resource('cliente', ClienteAPIController::class);
    Route::resource('ordem-servico', OrdemServicoController::class);
    Route::resource('equipamento', EquipamentoAPIController::class);

    Route::get('/configuracao/status', [StatusOSController::class, 'index']);
    Route::get('/configuracao/classificacao', [ClassificacaoOSController::class, 'index']);
    Route::get('/configuracao/unidade', [UnidadeController::class, 'index']);
});

