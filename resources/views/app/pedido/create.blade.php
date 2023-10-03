@extends('app.layouts.basico')

@section('titulo', 'Pedido')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')
    <div class="conteudo-pagina">
        {{-- action="{{route('')}}" --}}
        <div class="titulo-pagina-2">
           {{-- se exitir o atributo id -  entao é edição --}}
            {{-- @if(isset($produto->id))
            <p>Produto = update</p>
            @else
            <p>Produto = adicionnar</p>
            @endif --}}
            <p>Inserir Pedido</p>
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
                {{ isset($msg) && $msg != '' ? $msg : '' }}
                {{-- ou dessa forma dar na mesma  --}}
                {{-- {{  $msg ?? '' }} --}}
            @component('app.pedido._component.form_create_edit',['clientes'=> $clientes])
           @endcomponent
            </div>
        </div>
    </div>
@endsection
