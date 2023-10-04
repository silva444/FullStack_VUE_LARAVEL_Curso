<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessoMiddleware;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\ProdutoController;

use App\Http\Controllers\ProdutoDetalheController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// antes de entrar no controllador get  a request será interceptada pelo middleware;

// Route::middleware(LogAcessoMiddleware::class)->get('/',[\App\Http\Controllers\PrincipalController::class,'principal'])->name('site.index');
Route::get('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])
    ->name('site.index')->middleware('log.acesso');

Route::get('/sobrenos', [\App\Http\Controllers\SobreNosController::class, 'sobre'])->name('site.sobrenos');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'salvar'])->name('site.contato');

// para turna  o paramentro opicional utiliamos o ?;
Route::get('/login/{erro?}', [LoginController::class,'index'] )->name('site.login');
Route::post('/login', [LoginController::class,'Autenticar'] )->name('site.login');

// passando um paramentro strig para o midddleware usando o :
// nesta caso passaei doois parametro, o padrão e o visitante;
// podemos passar quantos parametros for necessario;
Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function () {



    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair',[LoginController::class, 'sair'])->name('app.sair');
    // chamada encadeada de middleware /
    // caso de tudo certo vai para na função  de callback;
    // Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');

    Route::get('/fornecedor', [\App\Http\Controllers\FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar/', [\App\Http\Controllers\FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    // criamos o get por conta do link do paginate;
    Route::get('/fornecedor/listar/', [\App\Http\Controllers\FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    // fornecedor get , esta sendo usado no botão novo;
    Route::get('/fornecedor/adicionar', [\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    //nao necessariamente precisar ser id o nome , mas é bom para identificar ;
    // colocamos o ? , para dizer que é um paramentro não obrigattorio;
    Route::get('/fornecedor/editar/{id}/{msg?}', [\App\Http\Controllers\FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [\App\Http\Controllers\FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    // Produtos
    Route::get('/produto', [ProdutoController::class, 'index'])->name('app.produto');
    Route::get('/produto/create', [ProdutoController::class, 'create'])->name('app.produto.create');

    // para criar as rotas de acordo com as funções do controller Produto 
    // usamos esse comando :
    // isso cria as rotas de acordo com as funções predefinidas do controller produto 
    // ou seja inde, create, store, update, destroy;
    Route::resource('produto', ProdutoController::class);
    // como esta dentro de prefixo app , a rota fiaca dessa forma:
        //app/produto/ -> 



    //  produto-detalhe é a rota raiz 
    // cria as rotas de acordo com as funções padroes do controller 
    // produto-detahle;
    Route::resource('produto-detalhe', ProdutoDetalheController::class);


    // criando rotas de acordo com as funções padrões do controler
    // elas ficam implicitas
    // para ver é só usar o comando route:list
    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    // Route::resource('pedido-produto', PedidoProdutoController::class);
    // passamos o paramentro pedido pq para cirar um pedido_produto
    // precisamos desse parametro;

    Route::get('pedido-produto/create/{pedido}',
     [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');

    Route::post('pedido-produto/store/{pedido}',
     [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    Route::delete('pedido-produto/destroy/{pedidoProduto}/{pedido_id}',
     [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');

});

// oque esta entre chaves pode ser chamado de parametro;
// coloca o ? para dizer que o parametro é opcional, e atribuo um valor padrão para nao da erro;
// possos colocar mais de um parametro opcional desde que seja passado da diretia para esquerda;
// então posso colocar todos como opicional, mas tenho que colocar valores padrão ;


Route::get(
    '/contato/{nome}/{cat_id}',
    function (
        string $nome,
        int $cat_id = 1
    ) {
        return 'esse é o nome  ' . $nome . ' ' . $cat_id;
    }
)->where('cat_id', '[0-9]+')->where('nome', '[A-Za-z]+'); // [0,9]+ , é uma expressão regular que diz oque pode ser recebido no cat-id
//no caso: poder ser um numero de 0 a 9 e o mais siginifica que pode ter mais de um numero;
// se eu tirar o mais , so poder ser um numero com apeas um caracter;
// o mais sigfica pelos meno 1 caracter;

// controleer logica que deve ser feita quando o cliete acessar a rota;


// redircinar rota;
Route::get('/route1', function () {
    return "1";
})->name('site.route1');
Route::get('/route2', function () {
    return redirect()->route('site.route1');
})->name('site.route2');


// ao acessar a rota dois redirecione para rota 1;
///Route:redirect('/route2','/route1');


//----------------------------------------

// rota de contigencia(fallback)
// rota que sera disponibilizada para o usario , caso a rota não seja encontrada; 


Route::fallback(function () {
    return  'a Rota acessad não existe <a href="/">clique aqui</a> para ir para principal';
});


// encaminhado paramentros da rota para o controlador;

Route::get("/teste/{p1}/{p2}", [\App\Http\Controllers\TesteController::class, 'teste'])->name('teste');


// passar parametros de um controller para a view 

// podemos passar atraves de array associativos;
// compact 
// 
