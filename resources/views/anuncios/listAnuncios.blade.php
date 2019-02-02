@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header" style="text-align: center; background-color: #353535; color: #fff;">
            <h1>Lista de anuncios</h1>
        </div>
        <div class="card-body">
            <div class="grid-container">
                @forelse ($anuncios as $anuncio)
                <a href="/anuncios/details/{{ $anuncio->id }}">
                    <div class="card anuncio">
                        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap">
                        <div class="card-body">
                            <div class="card-title">{{ $anuncio->producto }}</div>
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
