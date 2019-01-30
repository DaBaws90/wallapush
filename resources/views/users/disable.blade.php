@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="text-center">
            <h1 class="text-center text-muted mt-5 mb-5"> {{ __("Activar/Desactivar usuarios") }} </h1>
            <div class="alert alert-warning alert-dismissible fade show">
                {{__('Atención. Los usuarios seleccionados alternarán su estado de desactivado a activado o viceversa cuando pulse de botón situado en el margen inferior')}}
            </div>
            <form action="{{ route('disableUsersPost') }}" method="POST" id="disableForm">
                @csrf
                <table class="table" id="example">
                    <thead>
                        <tr scope="row">
                            <th scope="col"></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Habilitado</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        @if($user->role != "admin")
                        <tr scope="row">                        
                            <td><input type="checkbox" name="id_list[]" value="{{ $user->id }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->actived ? 'Sí' : 'No'}}</td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td col="3">
                                {{ __("No hay registros") }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </form>
            <button type="submit" form="disableForm" class="btn btn-outline-primary btn-block mb-5">Activar/desactivar</button>
        </div>
    </div>
</div>
@endsection