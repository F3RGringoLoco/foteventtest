@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Imagen : ') }}
                    <small class="text-muted">{{$picture->image_name}}</small>
                    <p class="card-text float-end">Fecha Creado : {{$picture->created_at}}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mx-auto text-center">
                            <img style="width: 100%; height:100%;" class="img-thumbnail" src="/storage/pictures/{{$picture->address}}" >
                        </div>
                    </div>
                    {{_('Monto : ')}}
                    @if (!is_null($picture->amount))
                        <h6 class="card-text">{{$picture->amount}}</h6>
                    @else
                        <h6 class="card-text text-danger">No tiene monto asignado</h6>
                    @endif
                    <hr>
                    @if (is_null($event))
                        <h5 class="card-title ">No tiene evento asignado</h5>
                    @else
                        <label for="eventoLink">Evento : </label>
                        <a id="eventoLink" class="card-text" href="{{route('event.show', $event->id)}}">{{$event->name}}</a><small class="text-muted">    -    {{$event->created_at}}</small>   
                    @endif
                </div>
                <div class="card-footer justify-content-around">
                    {!! Form::open(['route' => ['picture.destroy', $picture->id], 'method' => 'DELETE']) !!}
                        <button class="btn btn-danger float-end">Eliminar</button>
                    {!! Form::close() !!}
                    <a class="btn btn-secondary" href="{{route('picture.index')}}" role="button">Atras</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Asignar Monto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Asignar Monto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{--<form method="PUT" action="{{ route('picture.update', $picture->id) }}">
                @csrf
                <label class="form-label">Monto</label>
                <input name="amount" class="form-control" type="number" id="amount" required>
                <br>
                <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary float-end">Guardar</button>
            </form>--}}
            {!! Form::open(['route' => ['picture.update', $picture->id], 'method' => 'PUT']) !!}
                            <div class="form-group">
                                {{Form::label('amount', 'Monto Bs.')}}
                                {{ Form::number('amount', '', ['class' => 'form-control', 'placeholder' => 'Monto']) }}
                            </div>
                            <br>
                            <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Close</button>
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Guardar Cambios', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>
@endsection
