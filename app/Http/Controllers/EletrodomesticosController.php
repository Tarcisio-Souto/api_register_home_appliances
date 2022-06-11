<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EletrodomesticosController extends Controller
{
    
    public static function create() {

        $marcas = Marcas::getMarcas();
        return Inertia::render('AddEletrodomesticos', ['marcas' => $marcas]);

    }

}
