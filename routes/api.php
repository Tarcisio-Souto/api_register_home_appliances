<?php

use App\Http\Controllers\EletrodomesticosController;
use App\Http\Controllers\HomeController;
use App\Models\Eletrodomesticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/eletrodomesticos/novo', [EletrodomesticosController::class, 'create'])->name('eletros.create');
Route::get('/eletrodomesticos/visualizar/{id}', [EletrodomesticosController::class, 'show'])->name('eletros.show');
Route::get('/eletrodomesticos/editar', [EletrodomesticosController::class, 'edit'])->name('eletros.edit');
Route::post('/eletrodomesticos/atualizar', [EletrodomesticosController::class, 'update'])->name('eletros.update');
Route::post('/eletrodomesticos/deletar/{id}', [EletrodomesticosController::class, 'delete'])->name('eletros.delete');









