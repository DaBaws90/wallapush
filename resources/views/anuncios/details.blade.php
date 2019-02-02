@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        {{-- <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap"
        style="height: 50vh; width: auto;"> --}}
        @if($anuncio->images->count() > 0)
        @foreach ($anuncio->images as $image)
        <img class="card-img-top" src="{{ url('storage/anuncios/' . $image->img) }}" alt="Card image cap"
        style="height: 50vh; width: auto;">
        @endforeach
        @else
        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap"
        style="height: 50vh; width: auto;"> 
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $anuncio->producto}} </h5>
            <p class="card-text">{{ $anuncio->descripcion }}</p>
            <p class="card-text">Categoría: {{ $anuncio->categoria->nombre }}</p>
        </div>
        <div class="card-footer">
            @if ($anuncio->isOwner())
            <a href="/anuncios/edit/{{ $anuncio->id }}" class="btn btn-success" style="color: #fff !important;">Editar anuncio</a>
        <a href="/anuncios/remove/{{ $anuncio->id }}" class="btn btn-danger" style="color: #fff !important;">Eliminar anuncio</a>
            @else
            <a href="#" class="btn btn-primary" style="color: #fff !important;">Comprar ({{ $anuncio->precio }} €)</a>
            @endif
        </div>
    </div>
</div>
@endsection
