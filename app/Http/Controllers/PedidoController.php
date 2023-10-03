<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::paginate(10);
        // enviando 10 registros de pedidos para o index da pasta pediddos;
        return view('app.pedido.index',['pedidos'=>$pedidos, 'request'=> $request->all()]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all(); 
        //dd($clientes);
        return view('app.pedido.create',['clientes'=> $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras= [
            'cliente_id' => 'required|integer',
        ];
        $feedback = [
            'required' => 'o campo :attributes é orbigatorio',
            'cliente_id.integer' => 'o valor não é um inteiro',
        ];
        $request->validate($regras,$feedback);
        $pedido = new Pedido();
        $pedido->cliente_id =  $request->get('cliente_id');
        $pedido->save();
        return redirect()->route('pedido.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
