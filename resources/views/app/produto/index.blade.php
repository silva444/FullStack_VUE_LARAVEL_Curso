@extends('app.layouts.basico')

@section('titulo', 'Produto')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')


    <div class="conteudo-pagina">

        {{-- action="{{route('')}}" --}}

        <div class="titulo-pagina-2">
            <p>Produto - Listar</p>
        </div>

        <div class="menu">
  
            <ul>
                <li><a href="">Novo</a></li>
                <li><a href="">Consulta</a></li>

            </ul>

        </div>

        <div class="informacao-pagina">
            {{-- aplicando esse  estilo para centralizar a div --}}
            <div style="width: 90%; margin-right: auto; margin-left: auto;">
                {{-- {{print_r($requests)}} --}}
                 
                <table border="1" width="100%">
                    <thead>
                        {{-- tr- linha --}}
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade_id</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    {{-- {{$request ?? ''}} --}}
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td><a href="" >Excluir</a></td>
                                {{-- passando parametro para o route , que vai para a rota com esse nome --}}
                                <td><a href="">Editar</a></td>
                            </tr>
                        @endforeach      
                    </tbody>
                </table>

               {{-- o append pega todas as informaçãoes od array associativo e 
               anexar ao body da requisição do link  --}}
               {{-- dessa forma traz os daddos relacionados a pesquisa em especifico e não 
               todos os registros do BD --}}
              {{$produtos->count()}} -- mostra a quantidade por  pagina
              <br>
              {{$produtos->firstItem()}} -- O numero do primeiro regitro da pagina
              <br>
              {{$produtos->lastItem()}} -- O numero do ultimo regitro da pagina
              <br>
              {{$produtos->total()}} -- O total de resgistro
               {{-- {{$produtos->appends($requests)->links()}} --}}
            
            </div>
        </div>
    </div>
@endsection
