@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Evento') }}
                    <p class="card-text float-end">Fecha Creado : {{$event->created_at}}</p>
                </div>
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Anfitrión</h5>
                                <img style="width: 80%; height:100%;" class="img-thumbnail rounded-circle" src="/storage/images/{{$host->image}}">
                                <br>
                                <p class="card-text">{{$host->name}}</p>
                                <p class="card-text">Teléfono : {{$host->phone}}</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body text-center">
                                @if (is_null($guy))
                                    <h5 class="card-title text-primary">No tiene fotógrafo asignado</h5>
                                @else
                                    <h5 class="card-title">Fotógrafo</h5>
                                    <img style="width: 100%; height:100%;" class="img-thumbnail rounded-circle" src="/storage/images/{{$guy->image}}" >
                                    <p class="card-text">{{$guy->name}}</p>
                                    <p class="card-text">Teléfono : {{$guy->phone}}</p>
                                @endif
                            </div>
                          </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="container">
                        <p class="card-text">Nombre Evento : {{$event->name}} </p> 
                        <p class="card-text">Fecha : {{$event->date}} </p> 
                        <p class="card-text">Hora : {{$event->time}} </p> 
                        <p class="card-text">Dirección : {{$event->location}} </p> 
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" role="button" href="{{route('event.index')}}">Atras</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
