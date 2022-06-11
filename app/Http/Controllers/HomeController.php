<?php

namespace App\Http\Controllers;

use App\Models\Eletrodomesticos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    
    public function index(){

        $eletros = Eletrodomesticos::listAllEletros();
        return Inertia::render('Eletrodomesticos', ['eletros' => $eletros]);

    }


}
