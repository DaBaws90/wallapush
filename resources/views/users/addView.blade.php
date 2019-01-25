@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 mt-5">
            <div class="card border-primary">
                <div class="card-header text-center border-primary">
                    <h4 class="pt-3 pb-2">{{ __(('Añadir usuario')) }}</h4>
                </div>
                <div class="card-body">

                    <form action="" method="POST">
                        @csrf

                        <div class="form-group row mt-3">
                            <label class="col-md-2 col-form-label" for="name">Nombre</label>
                            <div class="col-md-10">
                                <input autofocus="true" class="form-control" type="text" id="name" name="name"/>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback mt-1" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="email">Email</label>
                            <div class="col-md-10">
                                <input class="form-control" type="email" id="email" name="email"/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback  mt-1" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="password">Contraseña</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" id="password" name="password"/>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback  mt-1" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="localidad">Localidad</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="localidad" name="localidad"/>
                                @if ($errors->has('localidad'))
                                    <span class="invalid-feedback  mt-1" role="alert">
                                        <strong>{{ $errors->first('localidad') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group row mb-3 mt-4">
                            <div class="col-md-12 text-center">
                                <a class="float-left pt-2" href="{{ route('users.index') }}"><i class="fas fa-chevron-left"></i> Volver</a>
                                <button style="position: relative; left: -3%;" type="submit" class="btn btn-outline-primary">
                                    {{ __('Añadir') }}
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