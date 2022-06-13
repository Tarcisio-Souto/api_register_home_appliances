<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Eletrodomesticos;
use App\Models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EletrodomesticosControllerApi extends Controller
{

    /* Listar Marcas */

    public function listAllMarcas()
    {

        $marcas = Marcas::getMarcas();
        return response()->json($marcas);
    }


    /* Listar eletrodomésticos */

    public function index()
    {

        $eletros = Eletrodomesticos::listAllEletros();
        return response()->json($eletros);
    }

    /* Visualizar eletrodoméstico */

    public function show($id)
    {
        $eletro = Eletrodomesticos::getEletro($id);
        return response()->json($eletro);
    }

    public function store(Request $req)
    {

        $msg1 = '';
        $msg2 = '';
        $msg3 = '';
        $msg4 = '';

        if ($req->nome == '') {
            $msg1 = "Informe o nome do produto!";
        }

        if ($req->fk_marca == null) {
            $msg2 = "Selecione a marca do produto!";
        }

        if ($req->descricao == null) {
            $msg3 = "Informe uma descrição para o produto!";
        }

        if ($req->tensao == null) {
            $msg4 = "Selecione a tensão do produto!";
        }

        if ($msg1 != '' || $msg2 != '' || $msg3 != '' || $msg4 != '') {

            $arr_err = array(

                'nome' => $msg1,
                'marca' => $msg2,
                'descricao' => $msg3,
                'tensao' => $msg4

            );
        }


        if (isset($arr_err)) {
            
            return response()->json(['errors' => $arr_err]);

        } else {
            
            $eletro = new Eletrodomesticos();
            $eletro->nome = $req->nome;
            $eletro->fk_marca = $req->fk_marca;
            $eletro->descricao = $req->descricao;
            $eletro->tensao = $req->tensao;
            $eletro->save();                             

            $msg = 'Eletrodoméstico cadastrado com sucesso!';
            return response()->json(['success' => $msg]);

        }
    }


    public function update(Request $req)
    {

        $msg1 = '';
        $msg2 = '';
        $msg3 = '';
        $msg4 = '';

        if ($req->nome_eletro == null) {
            $msg1 = "Informe o nome do produto!";
        }

        if ($req->marca == null) {
            $msg2 = "Selecione a marca do produto!";
        }

        if ($req->descricao == null) {
            $msg3 = "Informe uma descrição para o produto!";
        }

        if ($req->tensao == null) {
            $msg4 = "Selecione a tensão do produto!";
        }

        if ($msg1 != '' || $msg2 != '' || $msg3 != '' || $msg4 != '') {

            $arr_err = array(

                'nome' => $msg1,
                'marca' => $msg2,
                'descricao' => $msg3,
                'tensao' => $msg4
            );
        }


        if (isset($arr_err)) {
            
            return response()->json(['errors' => $arr_err]);

        } else {
            
            $marca = Marcas::where('nome', '=', $req->marca)->first();

            $eletro = Eletrodomesticos::find($req->id);            
            $eletro->nome = $req->nome_eletro;
            $eletro->fk_marca = $marca['id'];
            $eletro->descricao = $req->descricao;
            $eletro->tensao = $req->tensao;
            $eletro->save();                             

            $msg = 'Eletrodoméstico atualizado com sucesso!';
            return response()->json(['success' => $msg]);

        }
    }

    public function delete($id) {

        DB::table('eletrodomesticos')->delete($id);
        return response()->json(['success' => 'Eletrodoméstico deletado com sucesso!']);


    }

}
