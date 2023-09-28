  {{--  componente que é chamado pelos view Create.blade.php ,
  e edit.blade.php --}}



  @if (isset($cliente->id))
      <form method="post" action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}">
          @csrf
          @method('PUT')
      @else
          <form method="post" action="{{ route('cliente.store') }}">
              @csrf
  @endif
  {{-- alteraçõa feita para edição,
                    colocamos o $produto->nome , caso ele exista aparece ele ,
                    caso ele não exista aparece o old; no caso de 
                    validação da informação --}}
  <input type="text" name="nome" value="{{ $cliente->nome ?? old('nome') }}" class="borda-preta" placeholder="Nome">
  {{ $errors->has('nome') ? $errors->first('nome') : '' }}
  {{-- has-> verificar se a erros relaciona como esse nome 
                     first-> traz o primeiro erro --}}
  <button class="borda-preta" type="submit">Cadastrar</button>
  </form>
