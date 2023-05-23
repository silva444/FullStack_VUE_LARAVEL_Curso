<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MotivoContato;

class PrincipalController extends Controller
{
    public function principal(){ // pode ser chamado de action;

        $motivo_contatos = MotivoContato::all(); // pega todos os registros  do DB
            

        return view('site.principal', ['motivo_contatos'=>$motivo_contatos]);

    }
}
