<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\PrincipalController::class,'principal'])->name('site.index');

Route::get('/sobrenos', [\App\Http\Controllers\SobreNosController::class,'sobre'])->name('site.sobrenos');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class,'contato'])->name('site.contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class,'salvar'])->name('site.contato');

Route::get('/login', function(){
    return 'Login';
});

Route::prefix('/app')->group(function() {
    Route::get('/clientes', function(){
        return 'Clientes';
    })->name('app.clientes');
    Route::get('/fornecedores',[\App\Http\Controllers\FornecedorController::class,'index'])->name('app.fornecedores');
    Route::get('/produtos', function(){
        return 'produtos';
    })->name('app.produtos');
});

// oque esta entre chaves pode ser chamado de parametro;
// coloca o ? para dizer que o parametro é opcional, e atribuo um valor padrão para nao da erro;
// possos colocar mais de um parametro opcional desde que seja passado da diretia para esquerda;
// então posso colocar todos como opicional, mas tenho que colocar valores padrão ;


Route::get('/contato/{nome}/{cat_id}',
 function(
  string $nome,
  int $cat_id=1
  )
  {
    return 'esse é o nome  '.$nome .' '. $cat_id;
}
)->where('cat_id','[0-9]+')->where('nome','[A-Za-z]+'); // [0,9]+ , é uma expressão regular que diz oque pode ser recebido no cat-id
//no caso: poder ser um numero de 0 a 9 e o mais siginifica que pode ter mais de um numero;
// se eu tirar o mais , so poder ser um numero com apeas um caracter;
// o mais sigfica pelos meno 1 caracter;

// controleer logica que deve ser feita quando o cliete acessar a rota;


// redircinar rota;
Route::get('/route1', function(){
    return "1";
})->name('site.route1');
Route::get('/route2', function(){
    return redirect()->route('site.route1');
})->name('site.route2');


// ao acessar a rota dois redirecione para rota 1;
///Route:redirect('/route2','/route1');


//----------------------------------------

// rota de contigencia(fallback)
// rota que sera disponibilizada para o usario , caso a rota não seja encontrada; 


Route::fallback(function(){
   return  'a Rota acessad não existe <a href="/">clique aqui</a> para ir para principal';
});


// encaminhado paramentros da rota para o controlador;

Route::get("/teste/{p1}/{p2}", [\App\Http\Controllers\TesteController::class,'teste'])->name('teste');


// passar parametros de um controller para a view 

// podemos passar atraves de array associativos;
// compact 
// 
