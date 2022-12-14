@extends('layouts.app')

@section('content')
    <h1>Loja de Informática - 
        @if (isset($produto))
            Editar Produto
        @else
            Criar Produto</h1>
        @endif
        
    <div class = "detalhes">
        <p class="message"> {{session("mssg")}}</p>
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        <form 
            @if (isset($produto))
                action="{{ route('products.update', $produto->id) }}"    
            @else
                action="{{ route('products.store') }}"
            @endif
        method="POST" enctype="multipart/form-data">
            @csrf
            <div class="field">
            <label class="label" for="name">Nome do Produto:</label>
            <div class="control">
            <input id = "name" type="text" class="input" name="name"
                @if (isset($produto))
                    value= "{{$produto->nome}}"
                @endif
            >
            </div>
            </div>
            <div class="field">
            <label class="label" for="desc">Descrição do Produto:</label>
            <div class="control">
                <input id = "desc" type="text" class="input" name="desc"
                @if (isset($produto))
                value= "{{$produto->desc}}"
            @endif
                >
            </div>
            </div>
            <div class="field">
                <label class="label" for="url">Imagem:</label>
                <div class="control">
                    <input id = "url" type="file" class="input" name="url"
                        onchange="document.getElementById('changed').value=true"
                    >
                    @if (isset($produto))
                        (não alterar para manter a foto)
                    @endif
                </div>
                </div>
                <div class="field">
                    <label class="label" for="price">Preço:</label>
                    <div class="control">
                        <input id = "price" type="text" class="input" name="price"
                        @if (isset($produto))
                        value= "{{$produto->preco}}"
                    @endif
                        >
                    </div>
                </div>
                <div class="field">
                    <label for="tipoProduto">Tipo De produto:</label>
                    <select name="tipoProduto" id="tipoProduto">
                        @foreach ($tipos as $tipo)
                            <option value="{{$tipo->id}}"
                                    @if(isset($produto) && $produto->tipo_protuto_id == $tipo->id)
                                        selected= "selected"
                                    @endif
                                >{{$tipo->nome}}</option>
                        @endforeach
                    </select>
                </div> 

            <div class="field">
            <div class="control">

            <button type="submit" class="button is-link"
                @if (isset($produto))
                        value= "Editar Produto"
                    @else 
                        value = "Criar Produto"
                @endif
                >
                </button>
            </div>
            </div>
            </form>
            <a href="/produtos">Voltar aos produtos</a>
        
    </div>
@endsection