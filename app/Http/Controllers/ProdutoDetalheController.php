<?php

namespace App\Http\Controllers;

use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use App\Models\ItemDetalhe;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;


class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "entramos no index";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.create',['unidades'=>$unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProdutoDetalhe::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdutoDetalhe $produto_Detalhe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param App\Models\ProdutoDetalhe
     */

    //  quando eu uso o produto detalhe não vem os atributres 
    // e uso o dd para visualizar não vem os atribuites 
    // mas quando eu uso o find vem os atributes da tabela certinho;
    public function edit($id)
    {
        //dd($produtodetahle);
        $unidades= Unidade::all();
        // mudamos de produto detlahe para item detalhe;
        $prod = ItemDetalhe::with(['item'])->find($id);
      // dd($unidades);
        return view('app.produto_detalhe.edit',['produto_detalhe'=>$prod , 'unidades'=>$unidades]);
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id )
    {
        // esta dando errro qundo utilizo o model como paramentro 
        // mas quando uso o id da certo; 
        // acho que foi um erro na hora de cirar o controller usando o source ;
        // ProdutoDetalhe $produto_Detalhe
        // ---------------------------------------
        // quando mandamos o id por parametro, o laravel 
        // traz o registro Correto a partir desse id .
        //dd($produto_Detalhe);
        //  all() -> traz um array associativo da requisição feita;

        // so da certo desse forma , mas tenho que verificar pq 
       // esta dando esse erro quando uso o Model como paramenro    
        $produto_Detalhe = ProdutoDetalhe::findOrFail($id);
        $produto_Detalhe->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdutoDetalhe $produto_Detalhe)
    {
        //
    }
}
