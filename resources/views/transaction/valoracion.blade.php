@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @forelse ($ventas as $venta)
        @if ($venta->anuncio->count())
		<div class="col-11" style="margin: 0 auto;">
			<div class="card">
                <div class="card-title">
                    <div class="row">
                        <div class="col-6">
                            <h4><strong>Realizar compra</strong></h4>
                        </div>
                    </div>
                </div>
				<div class="card-body">
					<div class="row">
						<div class="col-2">
							@if ($venta->anuncio->images->count() > 0)
							<img class="card-img-top" style="width: 100px; height: 70px;" src="{{ url('storage/anuncios/' . $venta->anuncio->image()->img) }}" alt="Card image cap">
							@else
							<img class="card-img-top" style="width: 100px; height: 70px;" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap">
							@endif
						</div>
						<div class="col-8">
							<h4 class="product-name"><strong>{{ $venta->anuncio->producto}}</strong></h4><h4><small>{{ $venta->anuncio->descripcion }}</small></h4>
						</div>
						<div class="col-2 mt-4">
								<h3><strong>{{ $venta->anuncio->precio }}€</strong></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row text-center">
						<div class="col-7">
							<h4 class="text-right mt-2">Valoracion de 1 a 5:</h4>
						</div>
						<div class="col-5" style="color: white;">
                            <form action="{{route ('valoracion')}}" method="post" style="display: inline">
                                {{ csrf_field() }}
                                <input type="number" min="1" max="5" class="col-4" name="valoracion">
                                <input type="hidden" name="id" value="{{$venta->id}}">
                                <input type="submit" value="Realizar valoracion" class="btn btn-success col-6">
                            </form>
                        </div>
					</div>
				</div>
			</div>
        </div>
        @endif
		@empty
		<div class="alert alert-danger" role="alert">
			No tienes valoraciones pendientes.
		</div>
		@endforelse
	</div>
</div>
@endsection