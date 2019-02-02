@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        {{-- <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        --}}
        @if($anuncio->images->count() > 0)
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                    @foreach ($anuncio->images as $image)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($anuncio->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block img-fluid" src="{{ url('storage/anuncios/' . $image->img) }}" style="min-height: 50vh; max-height: 50vh; margin: 0 auto;">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
        </div>
        @else
        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $anuncio->producto}} </h5>
            <p class="card-text">{{ $anuncio->descripcion }}</p>
            <p class="card-text">Categoría: {{ $anuncio->categoria->nombre }}</p>
            @if ($anuncio->isOwner() || !Auth::check())
            <p class="card-text">{{ $anuncio->precio }} €</p>
            @endif
        </div>
        @if(Auth::check())
        <div class="card-footer">
            @if($anuncio->isOwner())
            <a href="/anuncios/edit/{{ $anuncio->id }}" class="btn btn-success" style="color: #fff !important;">Editar
                anuncio</a>
            <a href="/anuncios/remove/{{ $anuncio->id }}" class="btn btn-danger" style="color: #fff !important;">Eliminar
                anuncio</a>
            @else
            <a href="#" class="btn btn-primary" style="color: #fff !important;">Comprar ({{ $anuncio->precio }} €)</a>
            @endif
        </div>
        @else
        @endif
    </div>
</div>
@endsection
