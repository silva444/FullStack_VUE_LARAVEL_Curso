<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class LoginController extends Controller
{
    function index(Request $req)
    {
        //posso utilizar o get no lugar  do input;
        // get -> serve para recuperar os atributos tanto do post quannto do get();

        $erro = $req->input('erro');

        if($erro == 1){
            $erro= 'usuario ou senha não existe';
        }
        else if($erro == 2){
            $erro= 'Usuario não autorizado';
        }

        return view('site.login', ['titulo' => 'login' , 'erro'=>$erro]);
    }

    function Autenticar(Request $req)
    {

        // dd($req);

        // print_r($req->all()); // reotrn um array associativo dos paramentros do resquest;

        // echo "cheagamos na função autenticar" . "<br>";

        //definindos as regras;

        $regras = [
            'email' => 'email',
            'senha' => 'required',

        ];
        // definindo feedback personalizada de errro;
        $feedback = [
            'email.email' => 'Email invalido',
            'senha.required' => 'O campo  é obrigatorio',

        ];
        // se não passar pelo validade , vou para rota antiga;
        $req->validate($regras, $feedback);

        // return  redirect()->route('site.login');

       // print_r($req->all());

       // posoo usar dessa forma com get; 

       $email = $req->get('email');
       $password = $req->get('senha');

       // posso recuperar usando o input no lugar no request;



       // Persistindo o registro no BD;
        $user = new User();
    //    $user->name='vincus';
    //    $user->email = $email; 
    //    $user->password = $password; 
    //    $user->save();
       // Persistindo o registro no BD;

       
    //    echo 'email ' . '-'. $email . 'senha' . '-' . $password;
       
       // get para retornna uma collectoin; // coleção de registros;
       // array de objetos;
       // verifica se exite email e senha iguais passados no input do formulario;

       $existe = $user->where('email',$email)->where('password',$password)->get()->first();
       // posso usar o first aqui em cima de forma encadeada;

       //$existe=$existe->first(); // pega o primeiro registro da coleção;

       // verifica se existe possui o atributo name;
       // se o name o objeto estiver definido;
       // poderia usar o campo email no lugar do nome;
       if(isset($existe->name)){ //  refazer esse if depois;
       // para iniciar uma sessão no laravel usamos o comando 
           session_start();
       // iniciado o session com o (session_start) , podemos acessar a variavel super
       //global $_SESSION(); , e definir indices e valores para essa super global;
       $_SESSION['nome'] = $existe->name;//atribuindo o atributo nome , ao indice nome 
       // da superGlobal $_SESSION ;
       $_SESSION['email'] = $existe->email;

       // a super global fica disponivel do lado do servidor
       //sempre quando a instancia do browser que iniciuou essa super global.
       // realizar uma requisição para o servidor , esse browser tera acesso ,
       // a essas variaveis de sessão do lado do servidor; 

       //ou seja

       // cada instancia ou cada broser tera por tanto uma espaço ,
       // de sessão exclusivo, do lado do servidor; 
       // e esse browser podera recuperar essa informaçõa em outras paginas;
       // sem ter que ficar passando os paramentos;

       return redirect()->route('app.home');

       //dd($_SESSION);

       }else {
           echo "Usuario Não existe";
           // ele é uma execução que utiliza o verbo get();
           // colocando um array associativo passamos parametros para rota get;
           return redirect()->route('site.login',['erro'=>1]);
           // deopis de passar o parametro precisamos ir na rota e colocar 
           // uma cahve com o nome do paramentro(não necessaariamente precisar se 
           // o nome do parametro; / mas para facilitar colocamos o mesmo nome;
           
       }

    //    echo '<pre>';
    //    print_r($existe);
    //    echo '</pre>';
    }

  function sair(){
    
  session_destroy();
  // destroi a sessão que foi criado a funncção autenticar desse controler;

    return redirect()->route('site.index');
    
  }
}
