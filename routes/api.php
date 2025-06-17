<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware(JwtMiddleware::class)->group(function () {
    Route::resource('cliente', ClienteController::class);
    Route::resource('ordem-servico', OrdemServicoController::class);
});

