<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {

        // $fornecedores = [ // array multidimencional
        //     0 => [
        //         'nome' => 'fornecedor1',
        //         'status' => 'N',
        //         'cnpj' => null,
        //         'dd' => '11',
        //         'telefone' => '88111830'
        //     ], // na posição zero; // array associativos;


        //     1 => [
        //         'nome' => 'fornecedor2',
        //         'status' => 's',
        //         'dd' => '85', // fortaleza
        //         'telefone' => '88111830'
        //     ],

        //     2 => [
        //         'nome' => 'fornecedor3',
        //         'status' => 'N',
        //         'cnpj' => '123123.23.32.3.',
        //         'dd' => '87', // pernambuco
        //         'telefone' => '88111830'
        //     ], // na posição zero; // array associativos;
        // ];

        // $msg = isset($fornecedores['cnpj']) ? 'cnpj foi definido' : 'Cnpj nao definido';

        // //$fornecedores=[];




        // return view('app.fornecedor.index', compact('fornecedores'));

        return view('app.fornecedor.index');
    }

    public function listar(){

        return view('app.fornecedor.listar');
    }
}
