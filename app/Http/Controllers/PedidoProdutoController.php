<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoProduto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        //dd($produtos);
        // dessa forma utilizamos o eager loading(carregamento ocioso);
        
        $pedido->produtos;
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // estou passando a peido na rota de adicionar Produto
    // por isso tenho que passa o Paramentro Pediod;

    public function store(Request $request, Pedido $pedido)
    {
        // echo '<pre>';
        // print_r($pedido->id.  '-'. $request->input('produto_id'));
        // echo '</pre>';
        // echo '<hr>';
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required|integer',
        ];
        $feedback = [
            'produto_id.exists'  => ' o campo :attribute não existe na tabela produtos',
            'quantidade.integer' => 'o campo :attribute deve ser um valorm inteiro',
            'required'           => 'o campo :attribute é obrigatorio'
        ];
        $request->validate($regras, $feedback);
        // quando chamamos o metodo em formato de atributo 
        // o retorno é os regitros relacionados;
        //$pedido->produtos;
        // e quando chamamos no formato de metodo 
        // o que obtemos é um objeto que mapea esse relacionamento;
        // o attach permite adicionar as informações que devem ser 
        // inseridas na tabela criada para armazenar os registros de 
        //  N,N , nesse caso o pedidos_produotos;
        // uttilizamos o id do produot no attach 
        // pois o id do pedio já esta no objeto pediod;
        // então o attach vai saber lidar como a necessidade do pedido_id
        // 

        // e também devemos inserir as conlunas e valores 
        // no aarya associativo 
        // para inserrios na tabela de pediosprodutos;


        // podemos inserir de forma unitaria , o registro na tabela;

    //     $pedido->produtos()->attach($request->produto_id,
    //     ['quantidade' =>$request->quantidade ]
    // );

    // para gravamos multiplos pedidos relacionados 
    // por exemplo cadastrar multiplos proudos a um pedido;
    // fazamos isso :
    
    //  e podemos inserir varios registros de um unica vez;
    $pedido->produtos()->attach([
        $request->produto_id => ['quantidade' => $request->quantidade]
    ]);

        // $pedidoProduto = new PedidoProduto();
        // $pedidoProduto->produto_id = $request->produto_id;
        // $pedidoProduto->pedido_id  = $pedido->id;
        // $pedidoProduto->quantidade  = $request->quantidade;
        // $pedidoProduto->save();
        // dessa forma podemos ir adicionando produtos ára esse pedido;
        return redirect()->route('pedido-produto.create', ['pedido'=>$pedido->id]);
    }
    /**
     * Display the specified resource.
     */
    public function show(PedidoProduto $pedidoProduto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedidoProduto $pedidoProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PedidoProduto $pedidoProduto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoProduto $pedidoproduto , $pedido_id )
    {
        // recupera apenas os atributos
        // print_r($pedido->getAttributes());
        // echo '<br>';
        // print_r($produto->getAttributes());
    // dd($pedido_id);

        // forma convencional para exluir ;
        // PedidoProduto::where([
        //     'pedido_id'=>$pedido->id, 
        //     'produto_id'=>$produto->id, 
        // ])->delete();

        // detach(permite exluir pelo relacionamento)

        // passo por paramentro apenas o produto_id , pq 
        // o pedido ja esta sendo chamado no começo,
        // e o detach consegue tratar a ausencia do pedido->id
        // ou seja o id do objeto pedido ja esta no contexto;
        // então precisamos apenas do id da tabela do relacionamento 
        // o id_produto;
        // também é possivel remover atrves do objeto produto dessa forma:
        // $produto->pedidos()->detach($pedido->id);

        // $pedido->produtos()->detach($produto->id);
        $pedidoproduto->delete();
        return redirect()->route('pedido-produto.create',['pedido'=>$pedido_id]);
    }
}
