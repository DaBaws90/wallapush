@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @forelse ($anuncios as $anuncio)
		    <div class="card-body">
                <div class="grid-container">
                    <div class="card anuncio">
                        @if ($anuncio->images->count() > 0)
                        <img class="card-img-top" style="width: 100px; height: 70px;" src="{{ url('storage/anuncios/' . $anuncio->image()->img) }}" alt="Card image cap">
                        @else
                        <img class="card-img-top" style="width: 100px; height: 70px;" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap">
                        @endif
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
        @empty
        <div class="alert alert-danger" role="alert">
            No has realizado ninguna compra.
        </div>
        @endforelse
	</div>
</div>
@endsection