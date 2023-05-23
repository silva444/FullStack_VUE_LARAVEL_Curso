@extends('site.layouts.basico')


{{-- utilizo para enviar o titulo para o template com o sengundo parametro sendo o nome(sttring) do titulo --}}
{{-- posso utlizar par enviar variaveis também --}}
{{-- o tetulo vem do ocontrller contado; --}}
@section('titulo', $titulo)

@section('conteudo')

    {{-- @include('site.layouts._partials.topo') --}}

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Entre em contato conosco</h1>
        </div>

        <div class="informacao-pagina">
            <div class="contato-principal">
            {{-- poso utilizar o get mas não é recomendado; --}}
            {{-- O laravel exige que todos formularios submetidos via posts teha uma token(identificação 
            que garante que o formulario está sendo enviado via post pelo browesr(client da sessão)), 
            caso não tenha vai dar o erro 419   para insso utilizamos o @csrf--}}
                @component('site.layouts._components.form_contato' , ['classe'=>'borda-preta', 'motivo_contatos' => $motivo_contatos])
                  <p>Nao atendemos nesse horario podemos  </p>
                  <p> agredecemos </p>

                @endcomponent
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
