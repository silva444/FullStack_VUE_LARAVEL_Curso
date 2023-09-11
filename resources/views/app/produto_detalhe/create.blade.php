@extends('app.layouts.basico')

@section('titulo', 'Proddutos-detalhes Criar')


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
            
            <p>Produto_detalhe = Criar</p>
      
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
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
                {{ isset($msg) && $msg != '' ? $msg : '' }}
                {{-- ou dessa forma dar na mesma  --}}
                {{-- {{  $msg ?? '' }} --}}

            @component('app.produto_detalhe._component.form_create_edit', ['unidades'=>$unidades])
    
           @endcomponent
               

            </div>

        </div>


    </div>


@endsection
