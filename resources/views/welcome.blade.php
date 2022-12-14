@extends('layouts.app')

@section('content')
    <h1>Loja de Informática</h1>
    <div class="intro">
        <img src="/img/loja.jpg" alt="loja/img">
        <a href="{{ route('products.index') }}">Ver produtos</a>
    </div>
@endsection

