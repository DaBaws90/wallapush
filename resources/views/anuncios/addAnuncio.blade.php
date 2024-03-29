@extends('layouts.app')

@section('links')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="card addFormAnuncio">
        <div class="card-header">
            <h1 class="text-center text-muted"> {{ __("Añadir anuncio") }} </h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
        <ul class="card-body">
            @if(session('message'))
            <div class="alert alert-{{ session('message')[0] }} alert-dismissible fade show" role="alert">
                <p>{{ session('message')[1] }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @endif
            <div class="form">
                <form method="POST" action="{{ route('storeAnuncio') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="id_categoria">{{ __("Categoría") }}</label>
                        <select id="id_categoria" name="id_categoria" class="form-control">
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="producto">{{ __("Producto") }}</label>
                        <input id="producto" class="form-control" name="producto" value="{{ old('producto') }}"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="descripcion">{{ __("Descripcion") }}</label>
                        <textarea id="descripcion" class="form-control" name="descripcion" value="{{ old('descripcion') }}"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precio">{{ __("Precio") }}</label>
                        <input type="number" min="0" id="precio" class="form-control" name="precio" value="{{ old('precio') }}"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="images">{{ __("Imágenes") }}</label>
                        <input type="file" id="images" class="form-control" name="images[]" value="{{ old('images') }}"
                            multiple accept="image/*"/>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="nuevo" id="nuevo" value="1" checked>
                            <label class="form-check-label" for="nuevo">
                                {{ __("Nuevo") }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="nuevo" id="nuevo" value="0" checked>
                            <label class="form-check-label" for="nuevo">
                                {{ __("Segunda mano") }}
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default btn-anuncio"> {{ __("Añadir ") }} </button>
                </form>
            </div>
        </ul>
    </div>
</div>
@endsection
