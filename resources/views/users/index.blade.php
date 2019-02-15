@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 text-center">
            <h1 class="text-center text-muted mt-5 mb-5"> {{ __("Listado de usuarios") }} </h1>
            <div class="mb-3">
                <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-block">Añadir usuario</a>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-outline-primary btn-block" form="myForm">Ajustes de saldo</button>
            </div>
            <div class="mb-3">
                <a href="{{ route('disableUsers') }}" class="btn btn-outline-primary btn-block">Activar/Desactivar usuarios</a>
            </div>
            <div class="mb-3">
                <a href="{{ route('orderBySales') }}" class="btn btn-outline-primary btn-block">Ordenar por ventas</a>
            </div>
            <div class="mb-3">
                    <a href="{{ route('orderByValoration') }}" class="btn btn-outline-primary btn-block">Ordenar por valoraciones</a>
                </div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $error }}
                </div>
                @endforeach
            @endif
            @if(session('message'))
            <div class="alert alert-{{ session('message')[0] }} alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                {{ session('message')[1] }}
            </div>
            @endif
            <form action="{{ route('saldo') }}" method="POST" id="myForm">
            @csrf
            <table class="table" id="example">
                <thead>
                    <tr scope="row">
                        <th scope="col"></th>
                        <th scope="col">Nombre</th>
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
                    <tr scope="row" class="pt-2 mt-3">
                        <td><input type="checkbox" class="form-control{{ $errors->has('id_list') ? ' is-invalid' : '' }}" name="id_list[]" value="{{ $user->id }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->localidad != null ? $user->localidad : '(No data)' }}</td>
                        <td>{{ $user->saldo > 0 ? $user->saldo : 'Sin saldo' }}</td>
                        <td>{{ $user->actived ? 'Sí' : 'No'}}</td>
                        <td><a href="{{ route('users.show', $user->id) }}"><i class="fas fa-search"></i></a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}"><i class="fas fa-user-edit"></i></a></td>
                        <td>
                            <form action="{{ route('disableUser', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <button onclick="return confirm('Deshabilitar/habilitar usuario?')" style="padding: 0;" class="btn btn-light btn-sm" type="submit"><i style="color:#1d68a7;" class="fas fa-sync-alt"></i></button>
                            </form>
                        </td>
                        <td>
                            @if($user->sold->count() == 0 && $user->transacciones->count() == 0)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button onclick="return confirm('Eliminar usuario?')"  style="padding: 0;" class="btn btn-light btn-sm" type="submit"><i style="color:red;" class="far fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endif
                <!-- </tbody> -->
                @empty
                    <tr>
                        <td col="8">
                            {{ __("No hay registros") }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </form>
        </div>
    </div>
    <!-- Navegación -->
    <div class="row">
        <div class="col-md-4 offset-md-3 mt-3 mb-5">
            <div style="text-align:center" >
                @if($users->count())
                    {{$users->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
