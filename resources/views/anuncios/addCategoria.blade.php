@extends('layouts.app')

@section('links')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="card addFormCategoria">
        <div class="card-header">
            <h1 class="text-center text-muted"> {{ __("Añadir categoría") }} </h1>
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
                <form method="POST" action="{{ route('storeCategoria') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="categoria">{{ __("Categoría") }}</label>
                        <input id="nombre" class="form-control" name="nombre" value="{{ old('nombre') }}" required />
                    </div>
                    <button type="submit" class="btn btn-default btn-categoria"> {{ __("Añadir ") }} </button>
                </form>
            </div>
        </ul>
    </div>
</div>
@endsection
