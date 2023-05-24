<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // podemmos manipular esse request;
        // metodo next da sequencia a requisição; // empurra para frente;;
        // ou seja passa essa requisçõa para nossa aplicaçõa ou seja
        // a rota que chama o controller;
        //return $next($request);
  
        // despois recebemos a reposta , e podemos manipula-la ,
        // antes de entergar essa reposta para o browsser(cliete) , 
        // que fez essa requiçõa;
        // essa reposta(retorno) é dada pelo controller;s
        
       // $request->all() // retora um array associativo dos parametros do request ;

      // dd($request); // ver detahles da requisção;
       // pega o um valor do request, mas especificamente do parametro,
       // server (que é um array) , 
       $ip = $request->server->get('REMOTE_ADDR'); 
       // pegamos a informação da rota atraves do reqeust URI ;
       // é um atributo direto e não um array; por isso utilzamos o get direto;
       // sem ter que acessar um outro atribtuo;

       $rota = $request->getRequestUri();
        LogAcesso::create(['log' => "Ip $ip requisitou a rota $rota"]); 
        return Response(' chegmos e finalizamos no proprio middleware');
    }
}
