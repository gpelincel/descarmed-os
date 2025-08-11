<?php

use App\Http\Controllers\API\AgendaAPIController;
use App\Http\Controllers\API\ClienteAPIController;
use App\Http\Controllers\ClassificacaoOSController;
use App\Http\Controllers\API\EquipamentoAPIController;
use App\Http\Controllers\API\OrdemServicoAPIController;
use App\Http\Controllers\API\UsuarioAPIController;
use App\Http\Controllers\StatusOSController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

Route::post('/login', [UsuarioAPIController::class, 'login']);

Route::middleware(JwtMiddleware::class)->group(function () {
    Route::resource('cliente', ClienteAPIController::class);
    Route::resource('ordem-servico', OrdemServicoAPIController::class);
    Route::resource('equipamento', EquipamentoAPIController::class);
    Route::resource('agenda', AgendaAPIController::class);

    Route::get('/cliente/equipamento/{id}', [ClienteAPIController::class, 'getEquipamentos']);
    Route::get('/cliente/agenda/{id}', [ClienteAPIController::class, 'getAgenda']);
    Route::get('/cliente/ordem-servico/{id}', [ClienteAPIController::class, 'getOSs']);

    Route::get('/configuracao/status', [StatusOSController::class, 'index']);
    Route::get('/configuracao/classificacao', [ClassificacaoOSController::class, 'index']);
    Route::get('/configuracao/unidade', [UnidadeController::class, 'index']);

    Route::post('/ordem-servico/imprimir/{id}', [OrdemServicoAPIController::class, 'imprimir_personalizado']);
    Route::post('/ordem-servico/assinar/{id}', [OrdemServicoAPIController::class, 'assinarOS']);
});

