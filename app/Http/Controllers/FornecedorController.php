<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {

        // $fornecedores = [ // array multidimencional
        //     0 => [
        //         'nome' => 'fornecedor1',
        //         'status' => 'N',
        //         'cnpj' => null,
        //         'dd' => '11',
        //         'telefone' => '88111830'
        //     ], // na posição zero; // array associativos;


        //     1 => [
        //         'nome' => 'fornecedor2',
        //         'status' => 's',
        //         'dd' => '85', // fortaleza
        //         'telefone' => '88111830'
        //     ],

        //     2 => [
        //         'nome' => 'fornecedor3',
        //         'status' => 'N',
        //         'cnpj' => '123123.23.32.3.',
        //         'dd' => '87', // pernambuco
        //         'telefone' => '88111830'
        //     ], // na posição zero; // array associativos;
        // ];

        // $msg = isset($fornecedores['cnpj']) ? 'cnpj foi definido' : 'Cnpj nao definido';

        // //$fornecedores=[];




        // return view('app.fornecedor.index', compact('fornecedores'));

        return view('app.fornecedor.index');
    }

    public function listar(Request $req){

        // pegamos os valores do formulario com req;
        //pesquisa no banco as colunas com nome que vem do request;
        // get -> para retorna uma collection; um array de Objeos;

       $fornecedor2 = Fornecedor::where('nome', 'like', '%'.$req->input('nome').'%')
       ->where('site', 'like', '%'.$req->input('site').'%')
       ->where('uf', 'like', '%'.$req->input('uf').'%')
       ->where('email', 'like', '%'.$req->input('email').'%')
       ->get();// get retorna uma collection ;

       //dd($fornecedor2);

        return view('app.fornecedor.listar',['fornecedor'=>$fornecedor2]);
    }
    // iremos adicionar novos fornecedores aqui;
    public function adicionar(Request $request){
         // retorna um array associativo dos parametros do request;
          print_r($request->all());

          // se o token for diferente de vazio 
          // tiver token;
          if($request->input('_token') != ''){
            $regra = [
                'nome'=>'required|min:3|max:60',
                'site'=>'required',
                'uf'=>'required',
                'email'=>'email'
            ];
            // feddback de Erros 
            $feddbcak =[
                // criar uma mensagem para todos os campos com required
                // e recupera o nome do campo que retorna na validação das regras;
                'required' => 'O campo :attribute deve ser preenchido',
                'email.email' =>'O email não foi preenchido corretamente',
                'nome.min' =>'Deve conter no minimo 3 caracteres',
                'nome.max' =>'Deve conter no maximo 60 caracteres',
            ];
            // quando o validate da erro volta para a rota anterior;
            $request->validate($regra,$feddbcak);
            // instaciamos apartir do model Fornecedor 
            // que é uma classe que pode ser instanciada;
            // podemos inserir dessa forma:
            // $fornecedor1 = new Fornecedor();
            // $fornecedor1->nome  = $request->input('nome');
            // $fornecedor1->site  = $request->input('site');
            // $fornecedor1->uf    = $request->input('uf');
            // $fornecedor1->email = $request->input('email');
            // $fornecedor1->save();

             $msg= "CADASTRO REALIZADO COM SUCESSO";
            // podemos inserir desa forma também;
            $fornecedor1 = new Fornecedor();
            // requeste all , traz um array associativo no campos preenchidos 
            // no input, só é possivel inserir dessa forma quando criamos a varial 
            // $fillable no model se não da erro;
            $fornecedor1->create($request->all());


            
            
            
          }
           
          return view('app.fornecedor.adicionar',['msg'=>$msg]);
    }
}
