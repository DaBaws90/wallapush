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
    <div class="card">
        <div class="card-header" style="text-align: center; background-color: #353535; color: #fff;">
            <h1>Anuncios</h1>
            <form action="{{ route('listAnunciosBuscador') }}" class="form-inline">{{ csrf_field() }}
                <i class="fas fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3 w-75" name="buscador" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <div class="card-body" style="background-color: #b0b4ba;">
            <div class="grid-container">
                @forelse ($anuncios as $anuncio)
                @if($anuncio->vendedor->actived == true)
                <a class="black" href="{{route('detailAnuncio', $anuncio->id )}}">
                    {{-- <h1>{{ $anuncio->image }}</h1> --}}
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
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Vendedor: {{
                                $anuncio->vendedor->name }}</p>
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;">Localidad: {{
                                $anuncio->vendedor->localidad }}</p>
                        </div>
                        <div class="card-footer" style="background-color: rgba(63, 63, 63, 0.8); color: #fff;">
                            <p class="card-text" style="font-weight: bold; font-size: 1.2em;"> {{ $anuncio->precio }} €</p>
                        </div>
                    </div>
                </a>
                @endif
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
