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
        ];
        $feedback = [
            'produto_id.exists'  => ' o campo :attribute não existe na tabela produtos',
        ];

        $request->validate($regras, $feedback);
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->produto_id = $request->produto_id;
        $pedidoProduto->pedido_id  = $pedido->id;
        $pedidoProduto->save();
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
    public function destroy(PedidoProduto $pedidoProduto)
    {
        //
    }
}
