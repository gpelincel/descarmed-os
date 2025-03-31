<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClassificacaoOSController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\StatusOSController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [UsuarioController::class, 'login'])->name('login');

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::post('/logout', function (){
        session()->forget('user_id');
        return redirect('login');
    });

    Route::get('/ordem-servico', [OrdemServicoController::class, 'index']);
    Route::post('/ordem-servico', [OrdemServicoController::class, 'store']);
    Route::get('/ordem-servico/{id}', [OrdemServicoController::class, 'show']);
    Route::post('/ordem-servico/delete/{id}', [OrdemServicoController::class, 'destroy']);
    Route::post('/ordem-servico/update/{id}', [OrdemServicoController::class, 'update']);

    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente');
    Route::post('/cliente', [ClienteController::class, 'store']);
    Route::get('/cliente/{id}', [ClienteController::class, 'show']);
    Route::delete('/cliente/delete/{id}', [ClienteController::class, 'destroy']);
    Route::post('/cliente/update/{id}', [ClienteController::class, 'update']);
    Route::get('/cliente/equipamento/{id}', [ClienteController::class, 'getEquipamentos']);

    Route::get('/equipamento', [EquipamentoController::class, 'index']);
    Route::post('/equipamento', [EquipamentoController::class, 'store']);
    Route::get('/equipamento/{id}', [EquipamentoController::class, 'show']);
    Route::delete('/equipamento/delete/{id}', [EquipamentoController::class, 'destroy']);
    Route::post('/equipamento/update/{id}', [EquipamentoController::class, 'update']);

    Route::get('/usuario', [UsuarioController::class, 'index']);
    Route::post('/usuario', [UsuarioController::class, 'store']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
    Route::delete('/usuario/delete/{id}', [UsuarioController::class, 'destroy']);
    Route::post('/usuario/update/{id}', [UsuarioController::class, 'update']);

    // Route::get('/imprimir/{id}', [OrdemServicoController::class, 'imprimir']);
    Route::post('/imprimir', [OrdemServicoController::class, 'imprimir_personalizado']);

    Route::get('/configuracao', [ConfigController::class, 'index']);
    Route::post('/configuracao/status', [StatusOSController::class, 'store']);
    Route::post('/configuracao/classificacao', [ClassificacaoOSController::class, 'store']);

    Route::get('/agenda', [AgendaController::class, 'index']);
    Route::get('/agenda/{id}', [AgendaController::class,'show']);
    Route::post('/agenda', [AgendaController::class,'store']);
    Route::post('/agenda/update/{id}', [AgendaController::class,'update']);
    Route::delete('/agenda/delete/{id}', [AgendaController::class, 'destroy']);
});
