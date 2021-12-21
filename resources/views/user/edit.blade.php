@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Editar Cuenta') }}
                    <small class="text-muted float-end">Creado : {{$user->created_at}}</small>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-4 mx-auto text-center">
                                <img style="width: 100%; height:100%;" class="img-thumbnail rounded-circle" src="/storage/images/{{$user->image}}" alt="...">
                            </div>
                        </div>
                    
                    {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group float-right"> 
                            <div class="form-group">
                                {{Form::label('name', 'Nombre')}}
                                <li class="list-group-item text-muted">{{$user->name}}</li>
                            </div>
                            <br>
                            <div class="form-group">
                                {{Form::label('email', 'Email')}}
                                {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            </div>
                            <br>
                            <div class="form-group">
                                {{Form::label('phone', 'Teléfono')}}
                                {{ Form::text('phone', $user->phone, ['class' => 'form-control', 'placeholder' => 'Teléfono']) }}
                            </div>
                            <br>
                            <div class="form-group">
                                {{Form::file('image', ['class' => 'form-control', 'accept' => 'image/*'])}}
                            </div>
                            <br>
                            <a href="{{route('user.show', $user->id)}}" class="btn btn-danger">Cancelar</a> 
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Guardar Cambios', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection