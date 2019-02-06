@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
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
						<div class="col-2"><img class="img-responsive" src="http://placehold.it/100x70">
						</div>
						<div class="col-8">
							<h4 class="product-name"><strong>{{ $anuncio->producto}}</strong></h4><h4><small>{{ $anuncio->descripcion }}</small></h4>
						</div>
						<div class="col-2 mt-4">
								<h3><strong>{{ $anuncio->precio }}€</strong></h3>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row text-center">
						<div class="col-8">
							<h4 class="text-right mt-2">Total: <strong>{{ $anuncio->precio }}€</strong></h4>
						</div>
						<div class="col-2" style="color: white;">
                            <form action="{{ route('comprar') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$anuncio->id}}">
                                <input type="submit" value="Realizar compra" class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-2" style="color: white;">
						<a href="{{route ('listAnuncios')}}" class="btn btn-danger">Cancelar compra</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <br>
    @if ($error)
        <div style="margin: 0 auto;">
            <a class="alert alert-danger">{{$error}}</a>
        </div>
    @endif
</div>
@endsection