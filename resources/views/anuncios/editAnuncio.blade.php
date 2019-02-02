@extends('layouts.app')

@section('content')
<div class="container">
        @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }} alert-dismissible fade show" role="alert">
            <p>{{ session('message')[1] }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        @endif
    <div class="card" style="margin-bottom: 20px;">
        {{-- <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        --}}
        @if($anuncio->images->count() > 0)
        @foreach ($anuncio->images as $image)
        <img class="card-img-top" src="{{ url('storage/anuncios/' . $image->img) }}" alt="Card image cap" style="height: 50vh; width: auto;">
        @endforeach
        @else
        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        @endif
        <div class="card-body">
                <form method="POST" action="{{ route('editAnuncio', $anuncio) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
            <div class="form-group">
                <label for="producto">Producto</label>
                <input id="producto" name="producto" class="form-control" type="text" value="{{ $anuncio->producto }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control">{{ $anuncio->descripcion }}</textarea>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría</label>
            <select id="id_categoria" name="id_categoria" class="form-control" value="{{ $anuncio->categoria }}">
                    @foreach ($categorias as $categoria)
                    @if ($categoria == $anuncio->categoria)
                    <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                    @else
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endif

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="precio">Precio (€)</label>
                <input id="precio" name="precio" class="form-control" type="number" min="0" value="{{ $anuncio->precio }}">
            </div>
            <input id="id" name="id" value="{{ $anuncio->id }}" type="hidden" />
            <div class="form-group">
                    <label for="images">{{ __("Imágenes") }}</label>
                    <input type="file" id="images" class="form-control" name="images[]" value="{{ old('images') }}"
                        multiple accept="image/*"/>
                </div>
                <button type="submit" class="btn btn-success" style="color: #fff !important;">Guardar</button>
            </form>
        </div>
        {{-- <div class="card-footer">
            
        </div> --}}
    
        
    </div>
</div>
@endsection
