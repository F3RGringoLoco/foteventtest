@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Galeria de : ') }}
                    <small class="text-primary">{{Auth::user()->name}}</small>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Nuevo +
                    </button>
                </div>

                <div class="card-body">
                    <div class="container">
                        @if (count($pictures) > 0)
                            <div class="row">
                                @foreach ($pictures as $pic)
                                    <div class="col">
                                        <a href="{{route('picture.show', $pic->id)}}">
                                            <img src="/storage/pictures/{{$pic->address}}" class="cover">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h5 class="card-title text-center">No tienes Fotografías!</h5>
                            <p class="card-text text-center"><small class="text-muted">Empieza a publicar fotografías</small></p>
                        @endif
                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Fotografia(s)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('picture.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="formFileMultiple" class="form-label">Foto(s) <small class="text-muted">Puede seleccionar mas de una</small></label>
                        <input name=image[] class="form-control" type="file" id="formFileMultiple" multiple required accept="image/*">
                        <br>
                        <label for="exampleDataList" class="form-label">Evento <small class="text-danger">(opcional)</small></label>
                        <input name="event" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Buscar Evento">
                        <datalist id="datalistOptions">
                            @if (count($eventos) > 1)
                                @foreach ($eventos as $ev)
                                    <option value="{{$ev->id}}">{{$ev->name}}</option>    
                                @endforeach
                            @else
                                <option value="No hay Eventos"></option>
                            @endif
                        </datalist>
                        <br>
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-end">Guardar</button>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
