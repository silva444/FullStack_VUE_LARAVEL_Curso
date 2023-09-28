<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // quando trabalhamos com paginação precisamos recuperar os dados do request 
        // isso porque , precisamos adicionar os dados do request ao array de clientes
        // paginados 
        $clientes = Cliente::paginate(10);
        // passando todos os regitros de clientes para o 
        // index da pasta clientes; para ser listado na tela;
        return view('app.cliente.index',['clientes' => $clientes, 'request'=> $request->all() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40'
        ];

        $feedback=[
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'deve ter no minimo 3 caracteres',
            'nome.max' => 'deve ter no maximo 40 caracteres',
        ];
        $request->validate($regras,$feedback);


        $cliente = new Cliente();
        // não precisa usar o get nesse caso;
        $cliente->nome = $request->get('nome');
        $cliente->save();

       // após inserir o registro na tabela cliente vai redirecinar para a pagina
       // index do cliente;
        return redirect()->route('cliente.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
