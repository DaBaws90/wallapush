@extends('layouts.app')

@section('links')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-{{ session('message')[0] }} alert-dismissible fade show" role="alert">
        <p>{{ session('message')[1] }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    @endif
    <a href="#" class="btn btn-primary" style="color: #fff !important; margin-bottom: 10px;">Filtrar
        por categoría</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 10px;">
        Filtrar por categoría y fecha
    </button>
    <a href="{{ route('vendidos') }}" class="btn btn-primary" style="margin-bottom: 10px; color: #fff !important; float:right;">
            Volver al listado
    </a>
    
    <!-- Modal categoría y fecha-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="{{ route('filtroFechas') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filtrado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select id="categoria" class="form-control" name="categoria" value="{{ old('categoria') }}" required>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="fecha_inicio">Fecha inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="fecha_fin">Fecha fin</label>
                            <input id="fecha-fin" type="date" class="form-control" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="text-align: center; background-color: #353535; color: #fff;">
            <h1>Anuncios</h1>
        </div>
        <div class="card-body" style="background-color: #b0b4ba;">
            <div class="grid-container">
                @forelse ($anuncios as $anuncio)
                <a href="/anuncios/details/{{ $anuncio->id }}">
                    <div class="card anuncio">
                        <div class="image">
                            @if($anuncio->image())
                            <img class="card-img-top" src="{{ url('storage/anuncios/' . $anuncio->image()->img) }}"
                                style="max-height: 35vh; min-height: 35vh; max-width: 100%;">
                            <h5 class="titulo-producto">{{ $anuncio->producto }}</h5>
                            @else
                            <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default2.png') }}" style="max-height: 35vh; min-height: 35vh; max-width: 100%;">
                            <h5 class="titulo-producto">{{ $anuncio->producto }}</h5>
                            @endif
                        </div>
                        <div class="card-body" style="background-color: #353535; color: #fff;">
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Categoría: {{
                                $anuncio->categoria->nombre }}</p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Localidad: {{
                                $anuncio->vendedor->localidad }}</p>
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Fecha: {{
                                    $anuncio->created_at }}</p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Vendedor: {{
                                $anuncio->vendedor->name }}</p>
                            @if($anuncio->transaccion)
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Comprador: {{
                                $anuncio->transaccion->comprador->name }}</p>
                            @endif
                        </div>
                        <div class="card-footer" style="background-color: rgba(63, 63, 63, 0.8); color: #fff;">
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;"> {{ $anuncio->precio }} €</p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="alert alert-danger" role="alert">
                    No hay anuncios disponibles
                </div>
                @endforelse
            </div>
            {{-- <a href="{{ route('pdfFechas', ['id' => $categoria, 'inicio' => $fecha_inicio, 'fin' => $fecha_fin]) }}" class="btn btn-info pull-right" style="margin-top: 20px;"> {{ __("Descargar PDF") }} </a> --}}
        </div>
    </div>
    @if($anuncios->count())
    {{ $anuncios->links() }}
    @endif
</div>

@endsection
