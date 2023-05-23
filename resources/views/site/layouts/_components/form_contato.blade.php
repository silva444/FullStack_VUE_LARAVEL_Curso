{{-- recebe parametros dos componetes - slot --}}
{{ $slot }}

<form action=" {{ route('site.contato') }}" method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
   {{-- has verifica se tem dentro do obejto um erro relacionado com o nome --}}
    @if ($errors->has('nome'))
     {{--pega o primerio erro relacionado a validação do campo nome --}}
        {{$errors->first('nome')}} 
    @endif
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="borda-preta">
    {{$errors->has('telefone') ? $errors->first('telefone') : ''  }}
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="borda-preta">
    {{$errors->has('email') ? $errors->first('email') : ''  }}
    <br>
    {{-- {{ print_r($motivo_contatos) }} --}}
    <select name="motivo_contatos_id" class="borda-preta">
        <option value="">Qual o motivo do contato?</option>
        {{-- motivo_contatos vem dos conotroller por array associativo --}}
        @foreach ($motivo_contatos as $key => $motivo_contato)
            <option value="{{ $motivo_contato->id}}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : '' }}>
                {{ $motivo_contato->motivo_contato }} </option>
        @endforeach
    </select>
    {{$errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : ''  }}
    <br>
    <textarea name="mensagem" class="borda-preta" placeholder="digte o seu texto">
@if (old('mensagem') != '')
{{ old('mensagem') }}
@endif
</textarea>
{{$errors->has('mensagem') ? $errors->first('mensagem') : ''  }}
    <br>
    <button type="submit" class="borda-preta">ENVIAR</button>
</form>

{{-- caso exista algum errro -> any --}}
@if($errors->any()) 
<div style="position:absolute ; top:0px; left:0px ; width:100%; background-color:red;">
   


  {{-- retorna o array de eroos -> $errors->all() --}}
  {{-- errors está no contexto da views --}}
   @foreach ( $errors->all() as $error )

   {{$error}}
   <br>

   @endforeach

</div>
@endif
