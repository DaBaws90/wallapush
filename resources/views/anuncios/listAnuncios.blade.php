@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header" style="text-align: center; background-color: #353535; color: #fff;">
            <h1>Lista de anuncios</h1>
        </div>
        <div class="card-body" style="background-color: #b0b4ba;">
            <div class="grid-container">
                @forelse ($anuncios as $anuncio)
                <a href="/anuncios/details/{{ $anuncio->id }}">
                {{-- <h1>{{ $anuncio->image }}</h1> --}}
                    <div class="card anuncio">
                        <div class="image" style="">
                        @if($anuncio->image())
                        <img class="card-img-top" src="{{ url('storage/anuncios/' . $anuncio->image()->img) }}" alt="Card image cap" style="max-height: 35vh; min-height: 35vh; max-width: 100%;">
                        @else
                        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default2.png') }}" alt="Card image cap" style="max-height: 35vh; min-height: 35vh; max-width: 100%;">
                        @endif
                        </div>
                        <div class="card-body" style="background-color: #353535; color: #fff;">
                            <div class="card-title" style="font-weight: bold; font-size: 2em;">{{ $anuncio->producto }}</div>
                            <p class="card-text">{{ $anuncio->descripcion }}</p>
                            <p class="card-text">Categoría: {{ $anuncio->categoria->nombre }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $anuncio->precio }} €</li>
                        </ul>
                    </div>
                </a>
                @empty
                <div class="alert alert-danger" role="alert">
                    No hay anuncios disponibles
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @if($anuncios->count())
    {{ $anuncios->links() }}
    @endif
</div>

@endsection
