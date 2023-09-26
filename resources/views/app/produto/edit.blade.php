@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')


    <div class="conteudo-pagina">

        {{-- action="{{route('')}}" --}}

        <div class="titulo-pagina-2">
            <p>Produto = Editar</p>
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
             {{ isset($msg) && $msg != '' ? $msg : '' }}
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
                @component('app.produto._component.form_create_edit',['produto'=>$produto , 'unidades'=>$unidades, 'fornecedores'=> $fornecedores])
                @endcomponent
    
            </div>

        </div>


    </div>


@endsection
