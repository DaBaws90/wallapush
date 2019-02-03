@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('deleteimg'))
    <div class="alert alert-{{ session('deleteimg')[0] }} alert-dismissible fade show" role="alert">
        <p>{{ session('deleteimg')[1] }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    @endif
    {{-- <a href="{{ url('/anuncios/list') }}" class="btn btn-primary" style="color: #fff !important; margin-bottom: 10px;">Vista
        de detalles</a> --}}
    @if(session('message'))
    <div class="alert alert-{{ session('message')[0] }} alert-dismissible fade show" role="alert">
        <p>{{ session('message')[1] }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    @endif
    <div class="card" style="margin-bottom: 20px;">
        @if($anuncio->images->count() > 0)
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin: 20px 0 20px 0;">
            <ol class="carousel-indicators">
                @foreach ($anuncio->images as $image)
                <li class="li-image" data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($anuncio->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block img-fluid" src="{{ url('storage/anuncios/' . $image->img) }}" style="min-height: 50vh; max-height: 50vh; margin: 0 auto;">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="fas fa-chevron-left"></i>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="fas fa-chevron-right"></i>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
        @else
        <img class="card-img-top" src="{{ url('storage/anuncios/' . 'default.png') }}" alt="Card image cap" style="height: 50vh; width: auto;">
        @endif
        <div class="guardar-anuncio">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="color: #fff !important; float: right; margin-right: 20px;">Eliminar
                imágenes</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Imágenes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                @if($anuncio->images->count() > 0)
                                @foreach ($anuncio->images as $image)
                                <div class="row">
                                    <div class="col">
                                        <li class="list-group-item"><img src="{{ url('storage/anuncios/' . $image->img) }}"
                                                style="width: 200px;">
                                    </div>
                                    <div class="col">
                                        <p>Fecha de subida: {{ $image->updated_at}}</p>
                                        <a href="{{ route('removeImage', $image->img) }}" class="btn btn-danger" style="color: #fff !important;">Eliminar</a>
                                        {{-- <label for="eliminar">Eliminar</label>
                                        <input id="eliminar" type="checkbox" value="{{ $image->id }}"> --}}
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        </li>
                                        @endforeach
                                        @endif
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" style="background-color: #353535; color:#fff;">
            <form method="POST" action="{{ route('editAnuncio') }}" enctype="multipart/form-data">
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
                        multiple accept="image/*" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ url('anuncios/remove/' . $anuncio->id)}}" class="btn btn-danger" style="color: #fff !important;">Eliminar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
