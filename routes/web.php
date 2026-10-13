<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/principal', function () {
    return view('principal');
})->middleware(['auth', 'verified'])->name('principal');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index')->middleware(['auth', 'verified']);
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create')->middleware(['auth', 'verified']);
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store')->middleware(['auth', 'verified']);
    Route::get('/clientes/edit/{pessoa_codigo}', [ClienteController::class, 'edit'])->name('clientes.edit')->middleware(['auth', 'verified']);
    Route::put('/clientes/update/{pessoa_codigo}', [ClienteController::class, 'update'])->name('clientes.update')->middleware(['auth', 'verified']);
    Route::get('/clientes/delete/{pessoa_codigo}', [ClienteController::class, 'delete'])->name('clientes.delete')->middleware(['auth', 'verified']);

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index')->middleware(['auth', 'verified']);
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create')->middleware(['auth', 'verified']);
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store')->middleware(['auth', 'verified']);
    Route::get('/produtos/edit/{codigo}', [ProdutoController::class, 'edit'])->name('produtos.edit')->middleware(['auth', 'verified']);
    Route::put('/produtos/update/{codigo}', [ProdutoController::class, 'update'])->name('produtos.update')->middleware(['auth', 'verified']);
    Route::get('/produtos/delete/{codigo}', [ProdutoController::class, 'delete'])->name('produtos.delete')->middleware(['auth', 'verified']);
});

Route::get('/teste', function () {
    return view('teste');
})->middleware(['auth', 'verified'])->name('teste');

require __DIR__.'/auth.php';
