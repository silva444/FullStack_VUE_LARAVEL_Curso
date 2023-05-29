<!DOCTYPE html>
<html lang="pt-br">
    <head>
    {{-- está apto a receber uma section com esse nome (titulo) --}}
        <title>Super Gestão - @yield('titulo')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/estilo_basico.css')}}">
    </head>

    <body>
      @include('app.layouts._partials.topo')
       {{-- yeld - usad para indicar onde a sesssão deve ser impresssa(que é o html da view -) --}}
       {{-- cada view vai colocar seu conteudo aqui atraves do Yeld --}}
       @yield('conteudo')
    </body>
</html>