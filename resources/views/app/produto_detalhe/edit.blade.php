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

             <h4>Produto</h4>
             {{-- o produto é a função criada no model Produo detahle --}}
             {{-- podemos chamar um atributo do objeto no qual o produto detalhe pertence
             no caso o Produto; --}}

             {{-- mudamos de produto para item , pois agora estamos utilizando 
             a model Item detlhae de tem um relacionando belogs to que é uma 
             função chamada item, por isso temos que chamar item aqui --}}
             <div>nome: {{$produto_detalhe->item->nome}} </div>
             <br>
             <div>Descrição: {{$produto_detalhe->item->descricao}} </div>
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
