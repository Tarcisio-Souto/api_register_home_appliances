<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Eletrodomesticos extends Model
{
    use HasFactory;

    public static function listAllEletros() {

        $eletros = DB::table('eletrodomesticos as elet')
        ->join('marcas as mc', 'mc.id', '=', 'elet.fk_marca')
        ->select('elet.id as id_eletro', 'mc.id as id_marca', 'elet.nome as nome_eletro', 'descricao', 
                'tensao', 'mc.nome as marca')
                ->orderBy('elet.nome', 'asc')
        ->get();

        return $eletros;

    }

    public static function getEletro($id) {

        $eletro = DB::table('eletrodomesticos as elet')
        ->join('marcas as mc', 'mc.id', '=', 'elet.fk_marca')
        ->select('elet.id as id_eletro', 'mc.id as id_marca', 'elet.nome as nome_eletro', 'descricao', 
                'tensao', 'mc.nome as marca')
        ->where('elet.id', '=', $id)
        ->get();

        return $eletro;

    }






}
