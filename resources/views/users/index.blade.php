@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 text-center">
            <h1 class="text-center text-muted mt-5 mb-5"> {{ __("Listado de usuarios") }} </h1>
            <div class="mb-4">
                <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-block">Añadir usuario</a>
            </div>
            <div class="mb-4">
                <a href="{{ route('setSaldo', $id_list[]) }}" class="btn btn-outline-primary btn-block">Añadir usuario</a>
            </div>

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
                    <tr scope="row">
                        <td><input onchange="return alert('{{$user->id}}')" type="checkbox" name="id_list[]" value="{{ $user->id }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->localidad != null ? $user->localidad : '(No data)' }}</td>
                        <td>{{ $user->saldo > 0 ? $user->saldo : 'Sin saldo' }}</td>
                        <td>{{ $user->actived ? 'Sí' : 'No'}}</td>
                        <td><a href="{{ route('users.show', $user->id) }}"><i class="fas fa-search"></i></a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}"><i class="fas fa-user-edit"></i></a></td>
                        <td>
                            <form action="{{ route('disableUser', $user->id) }}" method="POST">
                                {{csrf_field()}}
                                <button onclick="return confirm('Deshabilitar usuario?')"  class="btn btn-danger btn-sm" type="submit"><i class="fas fa-times"></i></button>
                            </form>
                            <!-- <a href="{{ route('disableUser', ['id'=> $user->id]) }}"><i class="fas fa-times"></i></a> -->
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button onclick="return confirm('Eliminar usuario?')"  class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i></button>
                            </form>
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
        </div>
    </div>
    <!-- Navegación -->
    <div class="row">
        <div class="col-md-4 offset-md-4 mt-3 mb-5">
            <div style="text-align:center">
                @if($users->count())
                    {{$users->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
