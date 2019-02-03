@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ url()->previous() }}" class="btn btn-primary" style="color: #fff !important; margin-bottom: 10px;">Volver al listado</a>
    <div class="card">
        {{-- <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        --}}
        @if($anuncio->images->count() > 0)
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            @if($anuncio->images->count() > 1 )
            <ol class="carousel-indicators">
                @foreach ($anuncio->images as $image)
                <li class="li-image" data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            @endif
            <div class="carousel-inner" role="listbox">
                @foreach ($anuncio->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block img-fluid" src="{{ url('storage/anuncios/' . $image->img) }}" style="min-height: 50vh; max-height: 50vh; margin: 0 auto;">
                </div>
                @endforeach
            </div>
            @if($anuncio->images->count() > 1 )
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="fas fa-chevron-left"></i>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="fas fa-chevron-right"></i>
                <span class="sr-only">Siguiente</span>
            </a>
            @endif
        </div>
        @else
        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        @endif
        <h5 class="titulo-producto2">{{ $anuncio->producto }}</h5>
        <div class="card-body" style="background-color: #353535; color: #fff;">
            <p class="card-text">{{ $anuncio->descripcion }}</p>
            <p class="card-text">Categoría: {{ $anuncio->categoria->nombre }}</p>
            @if ($anuncio->isOwner() || !Auth::check())
            <p class="card-text">{{ $anuncio->precio }} €</p>
            @else
            <div class="dropdown-divider"></div>
            <p class="card-text">Vendedor: {{ $anuncio->vendedor->name }}</p>
            @endif
        </div>
        @if(Auth::check())
        <div class="card-footer" style="background-color: rgba(63, 63, 63, 0.8)">
            @if($anuncio->isOwner())
            <a href="/anuncios/edit/{{ $anuncio->id }}" class="btn btn-success" style="color: #fff !important; margin-right: 10px;">Editar
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
