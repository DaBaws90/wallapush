@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header" style="text-align: center; background-color: #353535; color: #fff; margin-top: 20px;">
            <h1>Lista de anuncios</h1>
        </div>
        <div class="card-body">
            <div class="grid-container">
                @forelse ($anuncios as $anuncio)
                <div class="card">
                        <img class="card-img-top" src="../anuncios/default.png" alt="Card image cap">
                        <div class="card-body">
                        <div class="card-title">{{ $anuncio->producto }}</div>
                            <p class="card-text">{{ $anuncio->descripcion }}</p>
                        </div>
                    </div>
                @empty
                <div class="alert alert-danger" role="alert">
                        No hay anuncios disponibles
                      </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
