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
        ->get();

        return $eletros;

    }



}
