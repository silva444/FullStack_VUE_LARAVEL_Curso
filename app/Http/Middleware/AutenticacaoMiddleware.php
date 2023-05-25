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
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);

        if(true){
            return $next($request); // empurra para frente nessa caso para o nucleo na apliccaçõ
            // que é a rota ;
            // vai para a function de calback da rota;
        }else {
            return Response('Rota exige autenticação');
        }

        
    }
}
