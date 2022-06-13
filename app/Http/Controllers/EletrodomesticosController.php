<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EletrodomesticosController extends Controller
{

    public function index() {
        return Inertia::render('Eletrodomesticos');
    }

    
    public static function create() {
        return Inertia::render('AddEletrodomesticos');
    }

    public static function show($id) {
        return Inertia::render('ViewEletrodomestico', ['id_eletro' => $id]);
    }

    public static function edit($id) {
        return Inertia::render('EditEletrodomestico', ['id_eletro' => $id]);
    }

}
