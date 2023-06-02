@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')


    <div class="conteudo-pagina">

        {{-- action="{{route('')}}" --}}

        <div class="titulo-pagina-2">
            <p>Produto = Listagem Especifica</p>
        </div>

        <div class="menu">

            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                {{-- vai para rota get create que é oculta 
                por conta do metodo route que foi usado nas 
                rotass web --}}
                <li><a href="">Consulta</a></li>

            </ul>

        </div>

        <div class="informacao-pagina">
            {{-- aplicando esse  estilo para centralizar a div --}}
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
              
                
                <table border="1" style="text-align: left;">
                <t-body>
                <tr>
                  <td>ID</td>
                  <td>{{$produto->id}}</td>
                </tr>
                <tr>
                  <td>Nome</td>
                  <td>{{$produto->nome}}</td>
                </tr>
                <tr>
                  <td>Descrição</td>
                  <td>{{$produto->descricao}}</td>
                </tr>
                <tr>
                  <td>Peso</td>
                  <td>{{$produto->peso}}</td>
                </tr>
                <tr>
                  <td>Unidade</td>
                  <td>{{$produto->unidade_id}}</td>
                </tr>
                </t-body>
                </table>

            </div>

        </div>


    </div>


@endsection
