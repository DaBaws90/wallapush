@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
            <div class="card text-center">
                <div class="card-header ">
                    <h4 class="pt-3 pb-2">{{ __('Perfil del usuario :name', ['name' => $user->name]) }}</h4>
                </div>
                <div class="card-body">
                    <p class="pt-3">{{ __('Localidad: :city', ['city' => $user->localidad != null ? $user->localidad : 'No hay información registrada'])}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="text-muted pt-3">{{ __('Dirección de email: :email', ['email' => $user->email])}}</p>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted pt-3">{{ __('Saldo disponible: :saldo €', ['saldo' => $user->saldo])}}</p>
                    </li>
                </ul>
                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-block"><i class="fas fa-chevron-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection