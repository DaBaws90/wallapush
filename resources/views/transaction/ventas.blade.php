@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @foreach ($anuncios as $anuncio)
		    <div class="card-body">
                <div class="grid-container">
                    <div class="card anuncio">
                        <img class="card-img-top" src="../anuncio/default.png" alt="Card image cap">
                        <div class="card-body">
                            <div class="card-title">{{ $anuncio->producto }}</div>
                            <p class="card-text">{{ $anuncio->descripcion }}</p>
                            <p class="card-text">Categoría: {{ $anuncio->categoria->nombre }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $anuncio->precio }}€</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
	</div>
</div>
@endsection