  {{--  componente que é chamado pelos view Create.blade.php ,
  e edit.blade.php --}}


{{-- /app/pedido-produto/store/1 --}}
  
  {{-- {{ route('pedido-produto.store', ['pedido' => $pedido->id]) }} --}}
  <form method="post" action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}"  >
      @csrf
      <select name="produto_id">
          <option>Selecion um produto</option>
          @foreach ($produtos as $produto)
              {{-- faz o testte primeiro para ver se a unidade existe 
                         --}}
              <option value="{{ $produto->id }}"
                  {{ ( old('produto_id')) == $produto->id ? 'selected' : '' }}>
                  {{ $produto->nome }}
              </option>
          @endforeach
      </select>
        {{-- {{$produto->id}} --}}
      {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
      <input type="number" name="quantidade" value= "{{old('quantidade') ? old('quantidade') : ''}}" 
      pleaceholder="Quantidade" class="borda-preta" >
      {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}

      <button class="borda-preta" type="submit">Cadastrar</button>
  </form>
