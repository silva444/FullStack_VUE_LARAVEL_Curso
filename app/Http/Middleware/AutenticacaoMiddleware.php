<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     // posoo passar paramertros para o middlewra dessa forma:
    //, $parametro, $perfil
    //mas antes tenho que defininir na rota que eu estou utilizando o middleware;

    public function handle(Request $request, Closure $next ): Response
    {
        // return $next($request);
        // echo $parametro;

        //  if($parametro == 'padrao'){
        //  echo 'verify the User and password on databsae '.' '. $perfil;
        //  }
        // if(false){
        //     return $next($request); // empurra para frente nessa caso para o nucleo na apliccaçõ
        //     // que é a rota ;
        //     // vai para a function de calback da rota;
        // }else {
        //     return Response('Rota exige autenticação');
        // }
    

        // para ter acesso as variaveis de sessão que foram definidas no login;
        session_start();


       // verifica se o atributo email esta definido;
       // verifica se não esta vazio;
        if(isset($_SESSION['email']) && $_SESSION['email']  != ''){
            // empurra a requisão para o passo sequinte , 
            // que neste caso é a rota clientes;
             return $next($request);
        }else{
            echo "Usuario Não autorizado";
            return redirect()->route('site.login',['erro'=>2]);
        }

        
    }
}
