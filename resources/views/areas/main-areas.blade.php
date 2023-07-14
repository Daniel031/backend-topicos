@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Areas</h1>
@stop

@section('content')

<div class="denuncias">
  <a class="btn btn-warning" href="{{route('areas.create')}}">Crear</a>
</div>
<table id="myTable" class="table table-striped table-bordered" style="width:100%">
  <thead>
      <tr>
        <th>Nombre</th>
        <th>Descripci&oacute;n</th>
        <th>Estado</th>
        <th>Opciones</th>
      </tr>
  </thead>
  <tbody>

    @foreach($areas as $user)
      <tr>
        <td >{{$user->nombre}}</td>
        <td >{{$user->descripcion}}</td>
        <td >{{$user->estado?"Habilitado":"Deshabilitado"}}</td>
        <td >
          <form action="{{route('areas.destroy',$user)}}" method="POST">
            @method('DELETE')
            @csrf
            <a href="{{route('areas.edit',$user)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i></a>
            <a href="{{route('areas.show',$user)}}" class="btn btn-info"><i class="fa fa-eye">&nbsp;</i></a>
            <Button type="submit" class="{{$user->estado?'btn btn-danger':'btn btn-success'}}">{{$user->estado?"Deshabilitar":"Habilitar"}}</Button>
        </form>
        </td>
          
      </tr>
    @endforeach
      
  </tbody>
</table>


@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<style>
    .denuncias {
        margin-bottom: 10px
    }
</style>

@stop

@section('js')
  	
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

  <script>
      //new DataTable('#myTable');
      let t = $('#myTable').dataTable({

        "info":false,
  "language": {
    "info": "_TOTAL_ usuarios",
    "infoEmpty": "0 usuarios",
    "oPaginate": {
                    "sFirst": "Primero", // This is the link to the first page
                    "sPrevious": "Anterior", // This is the link to the previous page
                    "sNext": "Siguiente", // This is the link to the next page
                    "sLast": "Ultimo" // This is the link to the last page
                }
  }
});
  </script>
@stop


