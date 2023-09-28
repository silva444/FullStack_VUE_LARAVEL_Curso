@extends('app.layouts.basico')

@section('titulo', 'Cliente')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')
    <div class="conteudo-pagina">
        {{-- action="{{route('')}}" --}}
        <div class="titulo-pagina-2">
            <p>Listagem de Clientes</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.create') }}">Novo</a></li>
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
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{$request ?? ''}} --}}
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nome }}</td>
                                <td>
                                    <form id="form_{{ $cliente->id }}"
                                        action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}" method="post">

                                        @method('delete')
                                        @csrf
                                        {{-- utilzamoss um evento js , para executar o submit do form --}}
                                        {{-- o onclick, feita dessa forma seleciona o elemetno html com id especidifoco
                                para ser submetido --}}
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $cliente->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                {{-- enviamos um parameto ateves de um array --}}
                                <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">Visualizar</a></td>
                                {{-- passando parametro para o route , que vai para a rota com esse nome --}}
                                <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- o append pega todas as informaçãoes od array associativo e 
               anexar ao body da requisição do link  --}}
                {{-- dessa forma traz os daddos relacionados a pesquisa em especifico e não 
               todos os registros do BD --}}
                {{ $clientes->appends($request)->links() }}
                {{ $clientes->count() }} -- mostra a quantidade por pagina
                <br>
                {{ $clientes->firstItem() }} -- O numero do primeiro regitro da pagina
                <br>
                {{ $clientes->lastItem() }} -- O numero do ultimo regitro da pagina
                <br>
                {{ $clientes->total() }} -- O total de resgistro


            </div>
        </div>
    </div>
@endsection
