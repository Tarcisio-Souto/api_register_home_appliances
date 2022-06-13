<?php

use App\Http\Controllers\Api\EletrodomesticosControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/marcas/listar', [EletrodomesticosControllerApi::class, 'listAllMarcas'])->name('eletros.api_marcas');

Route::get('/eletrodomesticos/listar', [EletrodomesticosControllerApi::class, 'index'])->name('eletros.api_index');
Route::get('/eletrodomesticos/visualizar/{id}', [EletrodomesticosControllerApi::class, 'show'])->name('eletros.api_show');
Route::post('/eletrodomesticos/registrar', [EletrodomesticosControllerApi::class, 'store'])->name('eletros.api_store');
Route::post('/eletrodomesticos/atualizar', [EletrodomesticosControllerApi::class, 'update'])->name('eletros.api_update');
Route::post('/eletrodomesticos/deletar/{id}', [EletrodomesticosControllerApi::class, 'delete'])->name('eletros.api_delete');









