@extends('app.layouts.basico')

@section('titulo', 'Pedido_produto')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')
    <div class="conteudo-pagina">
        {{-- action="{{route('')}}" --}}
        <div class="titulo-pagina-2">
            {{-- se exitir o atributo id -  entao é edição --}}
            {{-- @if (isset($produto->id))
            <p>Produto = update</p>
            @else
            <p>Produto = adicionnar</p>
            @endif --}}
            <p>Inserir Produtos ao Pedido</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                {{-- vai para rota get create que é oculta 
                por conta do metodo route que foi usado nas 
                rotass web --}}
                <li><a href="">Consulta</a></li>

            </ul>
        </div>
        <div class="informacao-pagina">
            {{-- aplicando esse  estilo para centralizar a div --}}
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
                {{-- {{ isset($msg) && $msg != '' ? $msg : '' }} --}}
                {{-- ou dessa forma dar na mesma  --}}
                {{-- {{  $msg ?? '' }} --}}
                <h4>Itens do Pedido
                </h4>
                <table border='1' width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{-- poderia utiliza apenas pedidos , ja que estamos usando 
                    o eager loading , que fizemos no metodo creata --}}
                    @foreach ($pedido->produtos as $produto )
                        
                        <tr>
                            <td>{{$produto->id}}</td>
                            <td>{{$produto->nome}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.pedido_produto._component.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent

            </div>
            <h4>Detalhes do Prdido</h4>
            <p>Id do Pedido: {{ $pedido->id }}</p>
            <p>Id do Cliente: {{ $pedido->cliente_id }}</p>
        </div>
    </div>
@endsection
