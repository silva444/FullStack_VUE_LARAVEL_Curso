@extends('app.layouts.basico')

@section('titulo', 'produto-detalhe editar')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')


    <div class="conteudo-pagina">

        {{-- action="{{route('')}}" --}}

        <div class="titulo-pagina-2">
            <p>Produto detalhe Editar = Editar</p>
        </div>

        <div class="menu">

            <ul>
                <li><a href="#">Voltar</a></li>
                {{-- vai para rota get create que é oculta 
                por conta do metodo route que foi usado nas 
                rotass web --}}
            </ul>
        </div>
        <div class="informacao-pagina">
            {{-- aplicando esse  estilo para centralizar a div --}}
            {{ isset($msg) && $msg != '' ? $msg : '' }}
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
                @component('app.produto_detalhe._component.form_create_edit', [
                    'produto_detalhe' => $produto_detalhe,
                    'unidades' => $unidades,
                ])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
