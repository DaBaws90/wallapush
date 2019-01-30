@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <img class="card-img-top" src="../../anuncios/default.png" alt="Card image cap"
        style="height: 50vh;">
        <div class="card-body">
            <h5 class="card-title">{{ $anuncio->producto}} </h5>
            <p class="card-text">{{ $anuncio->descripcion }}</p>
            <p class="card-text">Categoría: {{ $anuncio->categoria->nombre }}</p>
        </div>
        <div class="card-footer">
        <a href="#" class="btn btn-primary" style="color: #fff !important;">Comprar ({{ $anuncio->precio }} €)</a>
        </div>
    </div>
</div>
@endsection
