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

  <select name="cliente_id">
      <option>Selecion a Unidade</option>
      @foreach ($clientes as $cliente)
          {{-- faz o testte primeiro para ver se a unidade existe 
                         --}}
          <option value="{{ $cliente->id }}"
              {{ ($pedido->cliente_id ?? old('cliente_id')) == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}
          </option>
      @endforeach
  </select>
  {{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}
  
  <button class="borda-preta" type="submit">Cadastrar</button>
  </form>
