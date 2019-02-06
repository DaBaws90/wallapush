@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 mt-5">
            <div class="card border-primary">
                <div class="card-header text-center border-primary">
                    <h4 class="pt-3 pb-2">{{ __(('Editar usuario')) }}</h4>
                </div>
                @if(session('message')) 
                <div class="text-center alert alert-{{ session('message')[0] }} alert-dismissible fade show"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    {{ session('message')[1] }} 
                </div> 
                @endif
                <div class="card-body">

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH"/>
                        <input name="id" type="hidden" value="{{ $user->id }}"/>

                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label" for="name">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" autofocus>
                                @if($errors->has('name'))
                                    <span class="invalid-feedback mt-1" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="email">Email</label>
                            <div class="col-md-9">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" id="email" name="email" value="{{ old('email', $user->email) }}"/>
                                @if($errors->has('email'))
                                    <span class="invalid-feedback  mt-1" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="password">Contraseña</label>
                            <div class="col-md-9">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password"/>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback  mt-1" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div> -->

                        <!-- <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="password-confirm">Contraseña (confirmación)</label>
                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"/>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="localidad">Localidad</label>
                            <div class="col-md-9">
                                <input class="form-control{{ $errors->has('localidad') ? ' is-invalid' : '' }}" type="text" id="localidad" name="localidad" value="{{ old('localidad', $user->localidad) }}"/>
                                @if($errors->has('localidad'))
                                    <span class="invalid-feedback  mt-1" role="alert">
                                        <strong>{{ $errors->first('localidad') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group row mb-3 mt-4">
                            <div class="col-md-12 text-center">
                                @if(auth()->user()->role == 'admin')
                                    <a class="float-left pt-2" href="{{ route('users.index') }}"><i class="fas fa-chevron-left"></i> Volver</a>
                                @else
                                    <a class="float-left pt-2" href="{{ route('home') }}"><i class="fas fa-chevron-left"></i> Volver</a>
                                @endif
                                <button style="position: relative; left: -3%;" type="submit" class="btn btn-outline-primary">
                                    {{ __('Guardar cambios') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection