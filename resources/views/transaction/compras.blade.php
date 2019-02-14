@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @foreach ($transacciones as $transaccion)
		    <div class="card-body">
                <div class="grid-container">
                    <div class="card anuncio">
                        @if ($transaccion->anuncio->images->count() > 0)
                        <img class="card-img-top" style="width: 100px; height: 70px;" src="{{ url('storage/anuncios/' . $transaccion->anuncio->image()->img) }}" alt="Card image cap">
                        @else
                        <img class="card-img-top" style="width: 100px; height: 70px;" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <div class="card-title">{{ $transaccion->anuncio->producto }}</div>
                            <p class="card-text">{{ $transaccion->anuncio->descripcion }}</p>
                            <p class="card-text">Categoría: {{ $transaccion->anuncio->categoria->nombre }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $transaccion->anuncio->precio }}€</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
	</div>
</div>
@endsection