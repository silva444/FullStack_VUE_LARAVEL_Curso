  {{--  componente que é chamado pelos view Create.blade.php ,
  e edit.blade.php --}}



  @if (isset($produto->id))
      <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
          @csrf
          @method('PUT')
      @else
          <form method="post" action="{{ route('produto.store') }}">
              @csrf
  @endif

  <select name="fornecedor_id">
      <option>Selecion a Unidade</option>
      @foreach ($fornecedores as $fornecedor)
          {{-- faz o testte primeiro para ver se a unidade existe 
                         --}}
          <option value="{{ $fornecedor->id }}"
              {{ ($produto->fornecedor_id ?? old('fornecedor_id')) == $fornecedor->id ? 'selected' : '' }}>{{ $fornecedor->nome }}
          </option>
      @endforeach
  </select>
  {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}
  {{-- alteraçõa feita para edição,
                    colocamos o $produto->nome , caso ele exista aparece ele ,
                    caso ele não exista aparece o old; no caso de 
                    validação da informação --}}
  <input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" class="borda-preta" placeholder="Nome">
  {{-- has-> verificar se a erros relaciona como esse nome 
                     first-> traz o primeiro erro --}}
  {{ $errors->has('nome') ? $errors->first('nome') : '' }}
  <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" class="borda-preta"
      placeholder="Descrição">
  {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
  <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" class="borda-preta"
      placeholder="Peso">
  {{ $errors->has('peso') ? $errors->first('peso') : '' }}
  <select name="unidade_id">
      <option>Selecion a Unidade</option>
      @foreach ($unidades as $unidade)
          {{-- faz o testte primeiro para ver se a unidade existe 
                         --}}
          <option value="{{ $unidade->id }}"
              {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>
              {{ $unidade->unidade }}</option>
      @endforeach
  </select>
  {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
  <button class="borda-preta" type="submit">Cadastrar</button>
  </form>
