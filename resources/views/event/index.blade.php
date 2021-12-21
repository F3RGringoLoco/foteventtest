@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Eventos') }}
                    <!-- Button trigger modal 
                    <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Nuevo +
                    </button>-->
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Evento</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col" width="10px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $ev)
                                <tr>
                                    <th>{{$ev->name}}</th>
                                    <td>{{$ev->date}}</td>
                                    <td>{{$ev->time}}</td>
                                    <td>
                                        <a href="{{route('event.show', $ev->id)}}" class="btn btn-secondary float-end">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>             
                </div>
            </div>
        </div>
    </div>
</div>

  
  <!-- Modal -->
  {{--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('event.store') }}">
                @csrf
                <label class="form-label">Nombre</label>
                <input name="name" class="form-control" type="text" required>
                <br>
                <label class="form-label">Fecha y Hora</label>
                <input name="date" class="form-control" type="datetime-local" required>
                <br>
                <label class="form-label">Ubicación</label>
                <input name="location" class="" type="text" required>
                <br>
                <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary float-end">Guardar</button>
            </form>
        </div>
      </div>
    </div>
  </div>--}}
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando _START_ al _END_ registros de un total de _TOTAL_",
                    "sInfoEmpty":      "No hay eventos",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                }
            });
        } );
    </script>
@endsection