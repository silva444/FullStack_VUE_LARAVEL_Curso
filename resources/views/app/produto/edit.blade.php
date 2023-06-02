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
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
                {{ isset($msg) && $msg != '' ? $msg : '' }}
                {{-- ou dessa forma dar na mesma  --}}
                {{-- {{  $msg ?? '' }} --}}
                <form method="post" action="">
                    @csrf
                    <input type="text" name="nome" value="{{$produto->nome ?? old('nome')}}" class="borda-preta" placeholder="Nome">
                   {{-- has-> verificar se a erros relaciona como esse nome 
                     first-> traz o primeiro erro--}}
                    {{$errors->has('nome') ?  $errors->first('nome') : ''}}
                    <input type="text" name="descricao" value="{{$produto->descricao ?? old('descricao')}}" class="borda-preta" placeholder="Descrição">
                    {{$errors->has('descricao') ?  $errors->first('descricao') : ''}}
                    <input type="text" name="peso" value="{{$produto->peso ?? old('peso')}}" class="borda-preta" placeholder="Peso">
                    {{$errors->has('peso') ?  $errors->first('peso') : ''}}
                    <select name="unidade_id">
                        <option>Selecion a Unidade</option>
                        @foreach ($unidades as $unidade)
                            {{-- se estiver preenchido utilizaremos o valor atual ,
                            se nõa utilizaremos o valor da requisição anterior 
                            dai fazemos  a proxima comparação  --}}
                            <option value="{{ $unidade->id }}" {{($produto->unidade_id ?? old('unidade_id') )== $unidade->id ? 'selected':'' }}>{{ $unidade->unidade }}</option>
                        @endforeach
                    </select>
                    {{$errors->has('unidade_id') ?  $errors->first('unidade_id') : ''}}
                    <button class="borda-preta" type="submit">Editar</button>
                </form>

            </div>

        </div>


    </div>


@endsection
