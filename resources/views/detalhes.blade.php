@extends('layouts.app')

@section('content')
    <h1>Loja de Informática - Detalhes</h1>
    <div class = "detalhes">

        @if (isset($produto))
            <img src="{{$produto["url"]}}" alt="produto/img">
            <h2>{{$produto["nome"]}}</h2><br>
            <p>{{$produto["desc"]}}</p><br>
            €{{$produto["preco"]}}
        @else
            <h1>O produto não existe</h1>
        @endif
        @auth
        @if ($produto->created_by == auth()->user()->id || auth()->user()->IsAdmin)
        <form action="{{ route('products.destroy',$produto->id) }}" method="post">
            @csrf
            @method("DELETE")
            <button>Eliminar Produto</button>
        </form>
        <form action="{{route("products.edit", $produto->id)}}" method="get">
            @csrf
            <button>Editar produto</button>
        </form>
        @endif
        @endauth
        <br>

        <a href="/produtos">Voltar aos produtos</a>
    </div>
@endsection