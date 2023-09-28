  {{--  componente que é chamado pelos view Create.blade.php ,
  e edit.blade.php --}}



  @if (isset($pedido->id))
      <form method="post" action="{{ route('pedido.update', ['pedido' => $pedido->id]) }}">
          @csrf
          @method('PUT')
      @else
          <form method="post" action="{{ route('pedido.store') }}">
              @csrf
  @endif
  {{-- alteraçõa feita para edição,
                    colocamos o $produto->nome , caso ele exista aparece ele ,
                    caso ele não exista aparece o old; no caso de 
                    validação da informação --}}
  <input type="text" name="cliente_id" value="{{ $pedido->cliente_id ?? old('cliente_id') }}" class="borda-preta" placeholder="digite o id do cliente">
  {{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}
  {{-- has-> verificar se a erros relaciona como esse nome 
                     first-> traz o primeiro erro --}}
  <button class="borda-preta" type="submit">Cadastrar</button>
  </form>
