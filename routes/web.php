<?php

use App\Http\Controllers\EletrodomesticosController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::get('/eletrodomesticos/listar', [EletrodomesticosController::class, 'index'])->name('eletros.index');
Route::get('/eletrodomesticos/novo', [EletrodomesticosController::class, 'create'])->name('eletros.create');
Route::get('/eletrodomesticos/visualizar/{id}', [EletrodomesticosController::class, 'show'])->name('eletros.show');
Route::get('/eletrodomesticos/editar/{id}', [EletrodomesticosController::class, 'edit'])->name('eletros.edit');


