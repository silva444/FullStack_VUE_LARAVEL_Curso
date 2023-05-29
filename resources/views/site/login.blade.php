@extends('site.layouts.basico')


{{-- utilizo para enviar o titulo para o template com o sengundo parametro sendo o nome(sttring) do titulo --}}
{{-- posso utlizar par enviar variaveis também --}}
{{-- o tetulo vem do ocontrller contado; --}}
@section('titulo', $titulo)

@section('conteudo')

    {{-- @include('site.layouts._partials.topo') --}}

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Login</h1>
        </div>

        <div class="informacao-pagina">

            <div style="width:30%; margin-left:auto; margin-right:auto">
                <form action="{{ route('site.login') }}" method="post">
                    @csrf
                    <input type="text" value="{{old('email')}}" name="email" id="id_name" placeholder="digite o email" class="borda-preta">
                    {{$errors->has('email') ? $errors->first('email'): ''}}
                    
                    <input type="password" value="{{old('senha')}}" name="senha" placeholder="digite a senha" class="borda-preta">
                    {{$errors->has('senha') ? $errors->first('senha'): ''}}
                    <button type="submit" class="borda-preta">Enviar</button>
                </form>
                 {{-- se tiver algo dentro de erro e se for diferente de vazio; --}}
                {{ isset($erro) && $erro != '' ?  $erro : ''}}
            </div>
        </div>
    </div>

    {{-- {{print_r($motivo_contatos)}} --}}

    <div class="rodape">
        <div class="redes-sociais">
            <h2>Redes sociais</h2>
            <img src="{{ asset('img/facebook.png') }}">
            <img src="{{ asset('img/linkedin.png') }}">
            <img src="{{ asset('img/youtube.png') }}">
        </div>
        <div class="area-contato">
            <h2>Contato</h2>
            <span>(11) 3333-4444</span>
            <br>
            <span>supergestao@dominio.com.br</span>
        </div>
        <div class="localizacao">
            <h2>Localização</h2>
            <img src="{{ asset('img/mapa.png') }}">
        </div>
    </div>
@endsection
