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

        // dd($unidade);

          return view('app.produto.edit',['produto'=>$produto , 'unidades'=>$unidade]);
        // return view('app.produto.create',['produto'=>$produto , 'unidades'=>$unidade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        // AO ENVIAR O ID PARA O CONTROLLER , ATRAVES DA ROTA QUE COLOCAMOS NO FORMULARIO,
        // O LARAVEL JA TRAZ O OJETO RELACIONADO AO ID ENVIADO ATRAVES DO ARRAY ASSOCIATIVO,
        // DESSA FORMA JÁ TEMOS O REGISTRO CORRETO PARA FAZEMOS A EDIÇÃO;

        // NO REQUESTE VEM AS INFORMAÇÕES DIGITADAS NO FORMUALARIO;
         

       // $request->all();// representa o payload , os dados uteis da requisição http;

       // print_r($request->all());// reorna um arry associativo ;
        //atributos que eu quero persistir no lugar do resgsitro antigo;

       // echo '<br>';

        //print_r($produto->getAttributes()); // retorna um arrray associativo  ;
        // do objeto no estado anterior; traz o registro em que quero alterar 
        // pelo id enviado na rota do formulario atraves de um array associativo;
        // dados do objeto no banco;
       

        $produto->update($request->all());

      // redirecionanod para o view show , e passado com parametro o id do produto(registro);


        return redirect()->route('produto.show',['produto'=>$produto->id]);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
       //print_r($produto->getAttributes());// retorna um arrray associtivo do 
       //objeeto, que tem os registro associado a id passada como parametro;
       $produto->delete();

       return redirect()->route('produto.index');
    }
}
