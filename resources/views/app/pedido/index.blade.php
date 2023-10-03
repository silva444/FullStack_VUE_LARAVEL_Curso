@extends('app.layouts.basico')

@section('titulo', 'Pedido')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')
    <div class="conteudo-pagina">
        {{-- action="{{route('')}}" --}}
        <div class="titulo-pagina-2">
            <p>Listagem de Pedidos</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.create') }}">Novo</a></li>
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
                            <th>ID do Pedido</th>
                            <th>Cliente</th>
                            <th></th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{$request ?? ''}} --}}
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->cliente_id }}</td>
                                <td><a href="{{route('pedido-produto.create',['pedido'=>$pedido->id])}}">Adicionar Produto</a></td>
                                <td>
                                    <form id="form_{{ $pedido->id }}"
                                        action="{{ route('pedido.destroy', ['pedido' => $pedido->id]) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        {{-- utilzamoss um evento js , para executar o submit do form --}}
                                        {{-- o onclick, feita dessa forma seleciona o elemetno html com id especidifoco
                                para ser submetido --}}
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $pedido->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                {{-- enviamos um parameto ateves de um array --}}
                                <td><a href="{{ route('pedido.show', ['pedido' => $pedido->id]) }}">Visualizar</a></td>
                                {{-- passando parametro para o route , que vai para a rota com esse nome --}}
                                <td><a href="{{ route('pedido.edit', ['pedido' => $pedido->id]) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- o append pega todas as informaçãoes od array associativo e 
               anexar ao body da requisição do link  --}}
                {{-- dessa forma traz os daddos relacionados a pesquisa em especifico e não 
               todos os registros do BD --}}
                {{ $pedidos->appends($request)->links() }}
                {{ $pedidos->count() }} -- mostra a quantidade por pagina
                <br>
                {{ $pedidos->firstItem() }} -- O numero do primeiro regitro da pagina
                <br>
                {{ $pedidos->lastItem() }} -- O numero do ultimo regitro da pagina
                <br>
                {{ $pedidos->total() }} -- O total de resgistro
            </div>
        </div>
    </div>
@endsection
