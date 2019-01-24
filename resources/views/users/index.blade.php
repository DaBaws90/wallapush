@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center text-muted mt-5 mb-5"> {{ __("Listado de usuarios") }} </h1>
            <div class="mb-4">
                <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-block">Añadir usuario</a>
            </div>

            <table class="table">
                <thead>
                    <tr scope="row">
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Localidad</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Habilitado</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    @if($user->role != "admin")
                    <tr scope="row">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->localidad }}</td>
                        <td>{{ $user->saldo }}</td>
                        <td>{{ $user->actived ? 'Sí' : 'No'}}</td>
                        <td><a href="{{ route('users.show', $user->id) }}"><i class="fas fa-search"></i></a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}"><i class="fas fa-user-edit"></i></a></td>
                        <td><a href="{{ route('disableUser', ['id'=> $user->id]) }}"><i class="fas fa-times"></i></a></td>
                        <td></td>
                    </tr>
                    @endif
                <!-- </tbody> -->
                @empty
                    <tr scope="row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-muted; text-center">{{ __("No hay registros") }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse

                <!-- @forelse($users as $user)
                    @if($user->role != 'admin')
                        
                    @endif
                </tbody>
                @empty
                <tr scope="col">
                    <td class="alert alert-danger">
                        {{ __("Todvía no hay ningún usuario registrado en el sistema") }}
                    </td>
                </tr>
                @endforelse -->
            </table>
            <!-- @forelse($users as $user)
                @if($user->role != 'admin')
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-forum">
                        <a href="users/{{ $user->id }}"> {{ $user->name }} </a>
                        <!-- <form action="{route('users.destroy', $user->id)}}" method="POST">
                            {csrf_field()}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs pull-right" type="submit"><i class="far fa-trash-alt"></i></button>
                        </form> 
                    </div>
                </div>
                @endif

            @empty
            <div class="alert alert-danger">
                {{ __("Todvía no hay ningún usuario registrado en el sistema") }}
            </div>
            @endforelse -->
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
