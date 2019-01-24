@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center text-muted mt-5 mb-5"> {{ __("Listado de usuarios") }} </h1>
            <div class="mb-4">
                <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-block">Añadir usuario</a>
            </div>

            @forelse($users as $user)
                @if($user->role != 'admin')
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-forum">
                        <a href="users/{{ $user->id }}"> {{ $user->name }} </a>
                        <!-- <form action="{route('users.destroy', $user->id)}}" method="POST">
                        {csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs pull-right" type="submit"><i class="far fa-trash-alt"></i></button>
                        </form> -->
                    </div>
                </div>
                @endif

            @empty
            <div class="alert alert-danger">
                {{ __("Todvía no hay ningún usuario registrado en el sistema") }}
            </div>
            @endforelse
            <!-- Navegación -->
            <div style="text-align:center">
                @if($users->count())
                    {{$users->links()}}
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
