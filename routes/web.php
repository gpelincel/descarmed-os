<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/cliente');

Route::get('/ordem-servico', [OrdemServicoController::class,'index']);
Route::post('/ordem-servico', [OrdemServicoController::class,'store']);
Route::get('/ordem-servico/{id}', [OrdemServicoController::class,'show']);
Route::post('/ordem-servico/delete/{id}', [OrdemServicoController::class,'destroy']);
Route::post('/ordem-servico/update/{id}', [OrdemServicoController::class,'update']);

Route::get('/cliente', [ClienteController::class,'index']);
Route::post('/cliente', [ClienteController::class,'store']);
Route::get('/cliente/{id}', [ClienteController::class,'show']);
Route::delete('/cliente/delete/{id}', [ClienteController::class,'destroy']);
Route::post('/cliente/update/{id}', [ClienteController::class,'update']);

Route::get('/equipamento', [EquipamentoController::class,'index']);
Route::post('/equipamento', [EquipamentoController::class,'store']);
Route::get('/equipamento/{id}', [EquipamentoController::class,'show']);
Route::delete('/equipamento/delete/{id}', [EquipamentoController::class,'destroy']);
Route::post('/equipamento/update/{id}', [EquipamentoController::class,'update']);

Route::get('/usuario', [UsuarioController::class,'index']);
Route::post('/usuario', [UsuarioController::class,'store']);
Route::get('/usuario/{id}', [UsuarioController::class,'show']);
Route::delete('/usuario/delete/{id}', [UsuarioController::class,'destroy']);
Route::post('/usuario/update/{id}', [UsuarioController::class,'update']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
