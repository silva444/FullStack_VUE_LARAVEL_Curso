<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Item;
use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Models\ProdutoDetalhe;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // é posso subistituir produto por item 
        //  que vai ter o mesmo resultado;
        
        // nessse caso não daria nehuma erro pois as funções da model item 
        //  é a mesma de Produto;
        // mas posso mudar o nome do metodo, mas tem que mudar no index de 
        // produto para não da nenhum erro;vou Usar item mas poode deixar
        // produto mesmo;
        // passa o nome da função feita na model item 
        // para ser usadasd no index do proudo 
        // essa forma é conhecida como eagerloading(carregamento ancioso);
        // agora produto tem as infroamaçõa de item detalhe e fornecedor
        // antes de precisar ser chamada no index do produto;
        $produtos = Item::with(['ItemDetalhe', 'fornecedor'])->paginate(10);

        // foreach , cria uma copia do array que ele esta percorrendo
        // foreach ($produtos as $key => $produto) {
        //     // quando eu uso o first retorna um produto detahle
        //     // se eu não usar retornaria um colletion ;
        //     // ou seja um aarya de objetos; ou regstros
        //    // print_r($produto->getAttributes());
        //    // echo '<br><br>';
        //     $produtodetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
        //     //  se existir produto_detalhe 
        //     if (isset($produtodetalhe)) {
        //         // acessa os atributos do Objeto
        //        // print_r($produtodetalhe->getAttributes());
        //         //se o produto_detalhe existir recupero o produto utilzando a key 
        //         // e como o relacionamento é de 1,1 ja pego os atributos 

        //         // qual o indice do produto que eu quero afetar
        //         // por isso uso o kEy
        //         $produtos[$key]['comprimento'] = $produtodetalhe->comprimento;
        //         $produtos[$key]['altura'] = $produtodetalhe->altura;
        //         $produtos[$key]['largura'] = $produtodetalhe->largura;
        //     }
        // };
        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // all(), retorna uma array associativo 
        // dos nomes e valores do formulario;

        $regras = [
            'nome' => 'required',
            'descricao' => 'required',
            'peso' => 'required',
            // o id informado tem que existir na tabela unidades;
            'unidade_id' => 'exists:unidades,id',
            'nome' => 'required',
        ];

        $feedback = [
            // essa mesagem vai para todos os atributos que tem 
            // o required;
            'required' => 'O campo :attribute  é obrigatorio',
            'unidade_id.integer' => 'O de :attribute tem que ser um valor inteiro',
            'unidade_id.exists' => 'não existe essa unidade',
        ];
        $request->validate($regras, $feedback);

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

        return view('app.produto.show', ['produto' => $produto]);
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

        $unidade = Unidade::all();

        // dd($unidade);

        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidade]);
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


        return redirect()->route('produto.show', ['produto' => $produto->id]);
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
