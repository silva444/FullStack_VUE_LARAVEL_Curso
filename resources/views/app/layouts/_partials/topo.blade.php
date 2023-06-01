<div class="topo">

    <div class="logo">
        {{-- assete olha sempre para o diretorio public --}}
        <img src="{{ asset('img/logo.png') }}">
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ route('app.home') }}">Home</a></li>
            <li><a href="{{ route('app.cliente') }}">CLiente</a></li>
            <li><a href="{{ route('app.fornecedor') }}">fornecedor</a></li>
            {{-- fetio o ajuste na rota de produto pq p metodo 
            Route::resource('produto', ProdutoController::class); , 
            de um apelido automatico para rota --}}
            <li><a href="{{ route('produto.index') }}">Produto</a></li>
            <li><a href="{{ route('app.sair') }}">Sair</a></li>
        </ul>
    </div>
</div>
