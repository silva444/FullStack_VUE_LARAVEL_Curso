  {{--  componente que é chamado pelos view Create.blade.php ,
  e edit.blade.php --}}
  


  @if(isset($produto_detalhe->id))
  {{-- o parametro tem que ter o mesmo nome do paramento que é 
  mostrado no comando route:list , o paramnetro é passado atraves de  --}}
                 <form method="post" action="{{route('produto-detalhe.update',['produto_detalhe'=>$produto_detalhe->id])}}">
                    @csrf
                    @method('PUT')
                 @else
                <form method="post" action="{{route('produto-detalhe.store')}}">
                    @csrf
                @endif
                    {{-- alteraçõa feita para edição,
                    colocamos o $produto_detalhe->nome , caso ele exista aparece ele ,
                    caso ele não exista aparece o old; no caso de 
                    validação da informação --}}
                    <input type="text" name="produto_id" value="{{$produto_detalhe->produto_id ?? old('produto_id')}}" class="borda-preta" placeholder="Produto_id">
                   {{-- has-> verificar se a erros relaciona como esse nome 
                     first-> traz o primeiro erro--}}
                    {{$errors->has('produto_id') ?  $errors->first('produto_id') : ''}}
                    <input type="text" name="comprimento" value="{{$produto_detalhe->comprimento ?? old('comprimento')}}" class="borda-preta" placeholder="comprimento">
                    {{$errors->has('comprimento') ?  $errors->first('comprimento') : ''}}
                    <input type="text" name="largura" value="{{$produto_detalhe->largura ?? old('largura')}}" class="borda-preta" placeholder="largura">
                    {{$errors->has('largura') ?  $errors->first('largura') : ''}}
                    <input type="text" name="altura" value="{{$produto_detalhe->altura ?? old('altura')}}" class="borda-preta" placeholder="altura">
                    {{$errors->has('altura') ?  $errors->first('altura') : ''}}
                    <select name="unidade_id">
                        <option>Selecion a Unidade</option>
                        @foreach ($unidades as $unidade)
                        {{-- faz o testte primeiro para ver se a unidade existe 
                         --}}
                            <option value="{{ $unidade->id }}" {{($produto_detalhe->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected':'' }}>{{ $unidade->unidade }}</option>
                        @endforeach
                    </select>
                    {{$errors->has('unidade_id') ?  $errors->first('unidade_id') : ''}}
                    <button class="borda-preta" type="submit">Cadastrar</button>
                </form>