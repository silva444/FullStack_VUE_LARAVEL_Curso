<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Estamos em fornecedores</h1>


    {{-- @if (count($fornecedores) > 0)
               <h1>tem</h1>
        @else if(count($fornecedores) < 0)
        <h1>nao tem</h1>
         @endif

         @php
         if(count($fornecedores)> 0){
            echo("ola");
         }else {
            echo("nada");
         }
         
         @endphp --}}

</body>

</html>

{{-- isset(variavel)  - verifica se a variavel existe ou não --}}

{{-- @unless , faz o inverso do if;  if(!condição ) --}}

{{-- se a varivel fornecedores existir entre bloco --}}
@isset($fornecedores)
    Fornecedores: {{ $fornecedores[1]['nome'] }}
    <br>
    Status: {{ $fornecedores[1]['status'] }}
    <br>
    {{-- se a variavel não estiver  definida ou 
    se a variavel testa possuir um valor null 
    vai aparece a msg o valor esta vazio -> (??);
     --}}
    Cnpj: {{ $fornecedores[0]['cnpj'] ?? 'O valor esta vazio ' }}

    Telefone: ({{ $fornecedores[0]['dd'] ?? '' }} ) {{ $fornecedores[0]['telefone'] ?? '' }}
    @switch($fornecedores[0]['dd'])
        @case('11')
            são paulo
        @break

        @case('85')
            fortazela
        @break

        @case('87')
            Pernambuco
        @break

        @default
            Estado não indetificado
    @endswitch
    {{-- se eu não colocasse o isset daria erro pois no index 1 não existe cnpj --}}
    @isset($fornecedores[1]['cnpj'])
        cnpj: {{ $fornecedores[1]['cnpj'] }}
        @empty($fornecedores[1]['cnpj'])
            Vazio
        @endempty
    @endisset
    {{-- @dd($fornecedores) --}}
@endisset

{{-- @empty(variavel) - verifica se esta vazio se sim retorna true --}}

{{-- ?? - valor default -- serve como um atahlo para os ternarios --}}
<hr>
<br>

@isset($fornecedores)
    {{-- quando chegar no limite no vetor o isset vai retorna falso --}}
    @for ($i = 0; isset($fornecedores[$i]); $i++)
        Fornecedores: {{ $fornecedores[$i]['nome'] }}
        <br>
        Status: {{ $fornecedores[$i]['status'] }}
        <br>
        {{-- se a variavel não estiver  definida ou 
    se a variavel testa possuir um valor null 
    vai aparece a msg o valor esta vazio -> (??);
     --}}
        Cnpj: {{ $fornecedores[$i]['cnpj'] ?? 'O valor esta vazio ' }}
        <hr>
    @endfor
@endisset

<br>
<h1> while </h1>
<br>

@isset($fornecedores)
    {{-- quando chegar no limite no vetor o isset vai retorna falso --}}
    @php  $i=0; @endphp
    @while (isset($fornecedores[$i]))
        Fornecedores: {{ $fornecedores[$i]['nome'] }}
        <br>
        Status: {{ $fornecedores[$i]['status'] }}
        <br>
        {{-- se a variavel não estiver  definida ou 
    se a variavel testa possuir um valor null 
    vai aparece a msg o valor esta vazio -> (??);
     --}}
        Cnpj: {{ $fornecedores[$i]['cnpj'] ?? 'O valor esta vazio ' }}
        <hr>
        @php  $i++; @endphp
    @endwhile
@endisset
<br>
<h1> ForEach </h1>
<br>

@isset($fornecedores)
    
     {{-- gera uma copia do array --}}
    @foreach ($fornecedores as $indices => $fornecedor)

        Fornecedores: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        {{-- se a variavel não estiver  definida ou 
    se a variavel testa possuir um valor null 
    vai aparece a msg o valor esta vazio -> (??);
     --}}
        Cnpj: {{ $fornecedor['cnpj'] ?? 'O valor esta vazio ' }}
        <hr>
        
    @endforeach
@endisset
<br>
<h1> ForElse</h1>
<br>

@isset($fornecedores)
    
     {{-- gera uma copia do array --}}
    @forelse ($fornecedores as $indices => $fornecedor)
         Iteração Atual: {{$loop->iteration}}
        <br>
        Fornecedores: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        {{-- se a variavel não estiver  definida ou 
    se a variavel testa possuir um valor null 
    vai aparece a msg o valor esta vazio -> (??);
     --}}
        Cnpj: @{{ $fornecedor['cnpj'] ?? 'O valor esta vazio ' }}
         @if($loop->first)
             Primeira interação
             
        @endif
         @if($loop->last)
            Ultima interação
            <br>
            Total de Registros: {{$loop->count}}
        @endif
        <hr>
       
        @empty
        não existe fornecedores
      
    @endforelse
@endisset
{{--@{{}} - usamos o @ para dizer para o blade que nos queremos que o bloco de impressão
não seja interpretado --}}

{{-- for else funciona com a combição de uma comando condicional junto com ele
 --}}



