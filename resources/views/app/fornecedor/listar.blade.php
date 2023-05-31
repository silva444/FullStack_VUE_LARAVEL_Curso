@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')


    <div class="conteudo-pagina">

        {{-- action="{{route('')}}" --}}

        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">

            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>

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
                            <th>Nome1</th>
                            <th>site</th>
                            <th>uf</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{ $fornecedor->nome }}</td>
                                <td>{{ $fornecedor->site }}</td>
                                <td>{{ $fornecedor->uf }}</td>
                                <td>{{ $fornecedor->email }}</td>
                                <td>Excluir</td>
                                {{-- passando parametro para o route , que vai para a rota com esse nome --}}
                                <td><a href="{{route('app.fornecedor.editar',$fornecedor->id)}}">Editar</a></td>
                            </tr>
                        @endforeach      
                    </tbody>
                </table>

               {{-- o append pega todas as informaçãoes od array associativo e 
               anexar ao body da requisição do link  --}}
               {{-- dessa forma traz os daddos relacionados a pesquisa em especifico e não 
               todos os registros do BD --}}
              {{$fornecedores->count()}} -- mostra a quantidade por  pagina
              <br>
              {{$fornecedores->firstItem()}} -- O numero do primeiro regitro da pagina
              <br>
              {{$fornecedores->lastItem()}} -- O numero do ultimo regitro da pagina
              <br>
              {{$fornecedores->total()}} -- O total de resgistro
               {{$fornecedores->appends($requests)->links()}}
            
            </div>
        </div>
    </div>
@endsection
