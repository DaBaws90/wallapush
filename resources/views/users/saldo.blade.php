@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <h1 class="text-center text-muted mt-5 mb-5"> {{ __("Ajustes de saldo") }} </h1>

            <form action="{{ route('setSaldo') }}" method="POST" id="myForm">
            @csrf 
            <table class="table" id="example">
                <thead>
                    <tr scope="row">
                        <th scope="col">Nombre</th>
                        <th scope="col">Saldo actual</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr scope="row">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->saldo > 0 ? $user->saldo : 'Sin saldo' }}</td>
                        <input type="hidden" name="users[]" value="{{$user->id}}">
                    </tr>
                @empty
                    <tr scope="row">
                        <td col="2">
                            {{ __("No hay registros") }}
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="form-group">
                <label class="col-md-2 col-form-label" for="saldo">Nuevo saldo</label>
                <div class="col-md-12">
                    <input class="form-control" type="number" name="saldo" min="0" required/>
                    <!-- @if($errors->has('saldo'))
                    <div class="text-center alert-dismissible fade show alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif -->
                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-outline-primary btn-block" form="myForm">Ajustar</button>
            </div>
            <div class="mb-4">
                <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-block">Volver atrás</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
