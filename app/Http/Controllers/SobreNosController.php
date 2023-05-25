<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Middleware\LogAcessoMiddleware;



class SobreNosController extends Controller
{

    // aqui é uma forma de chamar o middlewares no construtor da class;
    // public function __construct()
    // {
    //     $this->middleware(LogAcessoMiddleware::class);
    // }

    // aqui é uma  outra forma de chamar o middlewares no construtor da class pelo seu apelido 
    //defino la no array do kernal;;
    public function __construct()
    {
        $this->middleware('log.acesso');
    }
    public function sobre(){


        return view('site.sobre-nos');
    }
}
