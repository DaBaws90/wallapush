@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="text-center">
                <table class="table">
                    <thead>
                        <tr scope="row">
                            <th scope="col">Nombre</th>
                            <th scope="col">Total valoraciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($sortByValoration as $users)
                        <tr scope="row">
                            @foreach($users as $user)
                                <td>{{ $user }}</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr scope="row">
                            <td col="2">{{ __('No hay registros') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
