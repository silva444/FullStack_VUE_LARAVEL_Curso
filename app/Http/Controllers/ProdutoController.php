<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);

        return view('app.produto.index', ['produtos'=>$produtos, 'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $unidades=Unidade::all();
        return view('app.produto.create',['unidades'=>$unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         // all(), retorna uma array associativo 
         // dos nomes e valores do formulario;

         $regras=[
            'nome' => 'required',
            'descricao' => 'required',
            'peso' => 'required',
            // o id informado tem que existir na tabela unidades;
            'unidade_id' => 'exists:unidades,id',
            'nome' => 'required',
         ];

         $feedback=[
            // essa mesagem vai para todos os atributos que tem 
            // o required;
            'required'=>'O campo :attribute  é obrigatorio',
            'unidade_id.integer'=>'O de :attribute tem que ser um valor inteiro',
            'unidade_id.exists'=>'não existe essa unidade',
         ];
         $request->validate($regras,$feedback);

        Produto::create($request->all());

       return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)


    {
        // caso o id  que foi enviado por paramentro no index 
        // exista, já temo um objeto do tipo produto relacionado 
        // com esse id, 
        // pois nos parametros dessa classe temos uma variavel do tipo Produto;


        //dd($produto);

        return view('app.produto.show',['produto'=>$produto]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    // recebemos um id ,  e o laravel já faz a pesquisa automaticamente do 
    // objeto relacionado ao id;
    public function edit(Produto $produto)
    {  
        // recebe todos os registro da tabela unidades,
        // isso é feito atraves do metodo all();
        $unidade= Unidade::all();

        return view('app.produto.edit',['produto'=>$produto , 'unidades'=>$unidade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
