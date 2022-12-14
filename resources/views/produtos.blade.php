@extends('layouts.app')

@section('content')
    <h1>Loja de Informática - Produtos</h1>
    <div class="listaTipos">
        
        @if (!isset($actTipo))
            <b>
        @endif
        <a href="{{route("products.index")}}">Todos os produtos</a>

        @if (!isset($actTipo))
            </b>
        @endif

        @foreach ($tipos as $tipo)
            @if (!isset($actTipo)&& $actTipo == $tipo->id)
                <b>
            @endif
            - <a href="{{route('products.by.tipo',$tipo->id)}}">{{$tipo->nome}}</a>

            @if (!isset($actTipo)&& $actTipo == $tipo->id)
                </b>
            @endif
        @endforeach
    </div>

    @foreach ($products as $product)
        <div class="produto">
            <a href="{{ route('products.show', $product->id) }}">
                <img src="{{$product["url"]}}" alt="img/produto">
                <h2>{{$product["nome"]}}</h2>
            </a>
        </div>    
    @endforeach
    
@endsection