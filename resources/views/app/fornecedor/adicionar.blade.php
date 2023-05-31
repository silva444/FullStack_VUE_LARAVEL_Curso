@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')


{{-- este conteudo vai para o Yeld do basico.blade.php , mas 
para fazer isso tenho que extender(herda) a view que quero adicionnar essa section(conteudo)
hmlt --}}
@section('conteudo')


    <div class="conteudo-pagina">

        {{-- action="{{route('')}}" --}}

        <div class="titulo-pagina-2">
            <p>Fornecedor = Adicionar</p>
        </div>

        <div class="menu">

            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>

            </ul>

        </div>

        <div class="informacao-pagina">
            {{-- aplicando esse  estilo para centralizar a div --}}
            <div style="width: 30%; margin-right: auto; margin-left: auto;">
                {{ isset($msg) && $msg != '' ? $msg : '' }}
                {{-- ou dessa forma dar na mesma  --}}
                 {{-- {{  $msg ?? '' }} --}}
                <form method="POST" action="{{ route('app.fornecedor.adicionar') }}">
                    @csrf
                    {{-- criamos esse inpunt quando fazermos uma requisção ppost em adicionar .
                    recuperamos as informações pelo id --}}
                    {{-- casso o valor de id exista use ele , caso não recebe um valor em branco --}}
                    <input type="hidden" name="id" value="{{ $fornecedor->id ?? ''}}" class="borda-preta">
                    {{-- caso o forneceodr nome esteja definido recebe esse valor, caso não receba nome --}}
                    <input type="text" name="nome" value="{{ $fornecedor->nome ?? old('nome') }}" class="borda-preta"
                        placeholder="Nome">
                    {{-- has -> caso haja uma erro para nome --}}
                    {{-- caso haja um erro com nome retonr o primeiro erro da varivvel $errors 
                se não não imprima nada --}}
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    <input type="text" name="site" value="{{ $fornecedor->site ?? old('site') }}" class="borda-preta"
                        placeholder="digite o site">
                    {{ $errors->has('site') ? $errors->first('site') : '' }}
                    <input type="text" minlength="2" value="{{ $fornecedor->uf ?? old('uf') }}" maxlength="2"
                        name="uf" class="borda-preta" placeholder="Uf">
                    {{ $errors->has('uf') ? $errors->first('uf') : '' }}
                    <input type="text" name="email" value="{{ $fornecedor->email ?? old('email') }}"
                        class="borda-preta" placeholder="digite o Email">
                    {{ $errors->has('email') ? $errors->first('email') : '' }}
                    <button class="borda-preta" type="submit">Cadastrar</button>
                </form>

            </div>

        </div>


    </div>


@endsection
