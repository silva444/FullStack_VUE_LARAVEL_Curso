<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class TesteController extends Controller
{
    public function teste (int $p1, int $p2){

        // array associativo , associa um nome par o valor da variavel,
        // ou seja ola tem o valor de $p1 , e assim sucessivamente;
        //  return view('site.teste', [
        //     'x' => $p1,
        //     'y' => $p2,

        //  ]);    

        // ----------------compact
        //return view('site.teste', compact('p1','p2')); // resultado é mesmo do associtivo;

        // ---------------- with

        return view('site.teste')->with('p1',$p1)->with('p2',$p2);

    }
}
