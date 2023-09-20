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

    public function listar(Request $req)
    {

        // pegamos os valores do formulario com req;
        //pesquisa no banco as colunas com nome que vem do request;
        // get -> para retorna uma collection; um array de Objeos;

           // $fornecedor2 = Fornecedor::where('nome', 'like', '%' . $req->input('nome') . '%')
            // ->where('site', 'like', '%' . $req->input('site') . '%')
            // ->where('uf', 'like', '%' . $req->input('uf') . '%')
            // ->where('email', 'like', '%' . $req->input('email') . '%')
            // ->get(); // get retorna uma collection ;
          
            // chamamos a função prodtuos , criada no model fornecerdo,
            // dessa forma estamos utlizando o Eagaer loaadin (carregamento ocioso);
             
            $fornecedor2 = Fornecedor::with('produtos')->where('nome', 'like', '%'. $req->input('nome') .'%')
            ->where('site', 'like', '%' . $req->input('site') . '%')
            ->where('uf', 'like', '%' . $req->input('uf') . '%')
            ->where('email', 'like', '%' . $req->input('email') . '%')
            ->paginate(5); // quantidade de registro retornado por paginação~;

        
        // eviando a colletion para a pagina de listar ;
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedor2 ,'requests' => $req->all()] );
    }
    // iremos adicionar novos fornecedores aqui;
    public function adicionar(Request $request)
    {
        // retorna um array associativo dos parametros do request;
        // print_r($request->all());

        // se o token for diferente de vazio 
        // tiver token;
        $msg = '';
        // quando o token existir e o id for vazio // fazemos a inserção;
        if ($request->input('_token') != '' && $request->input('id') == '') {
            $regra = [
                'nome' => 'required|min:3|max:60',
                'site' => 'required',
                'uf' => 'required',
                'email' => 'email'
            ];
            // feddback de Erros 
            $feddbcak = [
                // criar uma mensagem para todos os campos com required
                // e recupera o nome do campo que retorna na validação das regras;
                'required' => 'O campo :attribute deve ser preenchido',
                'email.email' => 'O email não foi preenchido corretamente',
                'nome.min' => 'Deve conter no minimo 3 caracteres',
                'nome.max' => 'Deve conter no maximo 60 caracteres',
            ];
            // quando o validate da erro volta para a rota anterior;
            $request->validate($regra, $feddbcak);
            // instaciamos apartir do model Fornecedor 
            // que é uma classe que pode ser instanciada;
            // podemos inserir dessa forma:
            // $fornecedor1 = new Fornecedor();
            // $fornecedor1->nome  = $request->input('nome');
            // $fornecedor1->site  = $request->input('site');
            // $fornecedor1->uf    = $request->input('uf');
            // $fornecedor1->email = $request->input('email');
            // $fornecedor1->save();

            $msg = "CADASTRO REALIZADO COM SUCESSO";
            // podemos inserir desa forma também;
            $fornecedor1 = new Fornecedor();
            // requeste all , traz um array associativo no campos preenchidos 
            // no input, só é possivel inserir dessa forma quando criamos a varial 
            // $fillable no model se não da erro;
            $fornecedor1->create($request->all());

            // caso tenho o token e o id , fazermos a edição dos registros;  
        } else if ($request->input('_token') != '' && $request->input('id') != '') {

            $fornecedor = Fornecedor::find($request->input('id'));
            // requeste all - retorna um array associativo dos dados do formulario//
            // utilizando o name que foi definido nos inputs como o chave , e o que foi digitado 
            // como valor;

            // ou seja um array com todas as informações do formulario;
            $update = $fornecedor->update($request->all());

            //dd($update);

            if ($update) { // caso realizado com sucesso 
                $msg = "Update realizado com sucesso";
            } else {
                $msg = "Update Não realizado";
            }

            // para fazer o update eu poderia passar o nome de cada coluna no Tabela do DB,
            // para recebre o request ,
            // dessa forma: $fornecedor->nome = $request->input('nome');
            // e deopis da um save() , dessa forma: $fornecedor->nome(); 

            // vamos fazer o o redirect pois se eu tenhtar manda o registro de fornecedor
            // para o return os dados estarõa desatualizados;

            // pois quando for para o metodo editar vai fazer um nova consulta e vai carregar 
            // os dados atualizados;

            // vai para o redirect novamente;
            // temos que configurar os paremetros na rota , senod id obrigatorio,
            // e a mensagem não obrigatoria;
            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar');
    }

    // determinamos um valor default para msg , pois ela não é obrigatorio na rota;
    public function editar($id, $msg = '')
    {
        // return "chegamos aqui. $id";
        //    pesquisa o resgistro atraves do id;
        // quando recebemos o id do metodo adicioanr fazemos uma nova consulta e 
        // passamos os valores atualizados; // pois no metodo adicionar faz um redirect para 
        // essse meto novamnete pssando os parametros id e msg , sendo id obrigatorio e msg não;

        $fornecedor = Fornecedor::find($id); // atualiza os dados dos forncedores atraves de uma 
        // pesquisa por id;

        // dd($fornecedor);
        // passa para viu uma variavel fornecedor que tem o valor de fornecedor,
        // para a view -> array Associativo;
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id){
         // pesquisa pelo id e apaga , nao definitivamente pois,
         // a tabela usa o softdelete;
        Fornecedor::find($id)->delete();
        // para apagar definitivamente usamoos esse comando:
        Fornecedor::find($id)->forceDelete();
        return  redirect()->route('app.fornecedor');

    }
}
