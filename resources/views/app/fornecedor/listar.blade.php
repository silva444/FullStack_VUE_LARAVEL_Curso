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
                                <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                                {{-- passando parametro para o route , que vai para a rota com esse nome --}}
                                <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <p>Lista de produtos</p>
                                    <table border="1" style="margin:20px;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- usa o objeto do primeiro for ecah 
                                        e chamo a função de relacionamento hasMany 
                                        que foi criadad no model fornecedor --}}
                                            {{-- chama a funçção produtos para cada objeto de fornecedro 
                                         e recuperar cada objeto de produtos --}}
                                            @foreach ($fornecedor->produtos as $key => $produto)
                                            {{-- cada produto de cada um dos nosso fornecedores recu
                                            peramos o nome e id --}}
                                                <tr>
                                                    <td>{{$produto->id}}</td>
                                                    <td>{{$produto->nome}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- o append pega todas as informaçãoes od array associativo e 
               anexar ao body da requisição do link  --}}
                {{-- dessa forma traz os daddos relacionados a pesquisa em especifico e não 
               todos os registros do BD --}}
                {{ $fornecedores->count() }} -- mostra a quantidade por pagina
                <br>
                {{ $fornecedores->firstItem() }} -- O numero do primeiro regitro da pagina
                <br>
                {{ $fornecedores->lastItem() }} -- O numero do ultimo regitro da pagina
                <br>
                {{ $fornecedores->total() }} -- O total de resgistro
                {{ $fornecedores->appends($requests)->links() }}

            </div>
        </div>
    </div>
@endsection
