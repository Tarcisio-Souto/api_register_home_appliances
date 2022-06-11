<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marcas extends Model
{
    use HasFactory;

    public static function getMarcas(){

        $marcas = DB::table('marcas')
        ->select('nome', 'id as id_marca')
        ->get();

        return $marcas;

    }



}
