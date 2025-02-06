<?php

use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ordem-servico');

Route::get('/ordem-servico', [OrdemServicoController::class,'index']);
Route::post('/ordem-servico', [OrdemServicoController::class,'store']);
Route::get('/ordem-servico/{id}', [OrdemServicoController::class,'show']);
Route::post('/ordem-servico/delete/{id}', [OrdemServicoController::class,'destroy']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
