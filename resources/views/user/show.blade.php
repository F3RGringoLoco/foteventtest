@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                      <img style="max-width: 100%; max-height:100%" class="img-thumbnail" src="/storage/images/{{$user->image}}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$user->name}}</h5>
                        <p class="card-text">Email : {{$user->email}}</p>
                        <p class="card-text">Teléfono : {{$user->phone}}</p>
                        <p class="card-text"><small class="text-muted">Creado en : {{$user->created_at}}</small></p>
                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning">Editar</a>
                        @if (is_null($user->image))
                            <small class="text-danger">Sube una foto de perfil!</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection