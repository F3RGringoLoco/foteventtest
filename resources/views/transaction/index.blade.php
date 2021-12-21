@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Transacciones') }}
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Fotografía</th>
                                <th scope="col">Comprador</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $trans)
                                <tr>
                                    <th>{{$trans->image_name}}</th>
                                    <td>{{$trans->buyer_name}}</td>
                                    <td>{{$trans->created_at}}</td>
                                    <td>{{$trans->amount}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>             
                </div>
            </div>
        </div>
    </div>
</div>
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
                    "sInfoEmpty":      "No hay transacciones",
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