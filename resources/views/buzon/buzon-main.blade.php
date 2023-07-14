

 @extends('adminlte::page')

 @section('title', 'Usuarios')
 
 @section('content_header')
  <div class="title">
    <h1>Mis Denuncias </h1>
  </div>
    
 @stop
 
 @section('content')
 
  <table id="myTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th >Titulo</th>
          <th >Decripcion</th>
          <th >Estado</th>
          <th >Opciones</th>
        </tr>
    </thead>
    <tbody>
 
    @foreach($datos as $dato)
     @foreach($dato as $element)
       <tr>
         <td >{{$element->titulo}}</td>
         <td >{{$element->descripcion}}</td>
         <td >
              @if($element->estado == 1)
                      
                      <span class="badge badge-warning">Pendiente</span>
              @else
                    @if($element->estado == 2)
                        
                        <span class="badge badge-success">Aceptada</span>
                    @else
                        
                        <span class="badge badge-danger">Rechazada</span>
                    @endif
              @endif
         </td>
       
         

         <td >
            <form action="{{route('buzon.destroy',$element->id)}}" method="POST">
              @method('DELETE')
              @csrf
              
              <a href="{{route('buzon.show',$element->id)}}" class="btn btn-info ml-auto"><i class="fa fa-eye">&nbsp;</i></a>

              {{-- <Button type="submit" class="{{$element->estado?'btn btn-danger':'btn btn-success'}}">{{$element->estado?"Deshabilitar":"Habilitar"}}</Button> --}}
          </form>
        </td>
           
       </tr>
     @endforeach
     @endforeach   
   </tbody>
 </table>
 
 
 @stop
 
 @section('css')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
 <style>
     .title {
         text-align:center;
         font-size:3rem;
         font-family:'Courier New', Courier, monospace;
         margin-bottom: 10px;
         font-weight: bold;
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
 
 
 

{{-- 


@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Buzon de denuncias</h1>
@stop

@section('content')

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($datos as $dato)
               @foreach($dato as $element)
               <tr>
                <td >{{$element->titulo}}</td>
                <td>{{$element->fecha}}</td>
                <td>{{($element->estado == 1)?"Pendiente":($element->estado==2?"Aceptado":"Rechazado")}}</td>
                <td>
                   <form action="{{route('buzon.show',$element->id)}}" method="GET">
                    <input type="submit" class="btn btn-secondary" value="Ver Denuncia">
                   </form>
                </td>
               </tr> 
               @endforeach
              @endforeach 
            </tbody>
          </table>
@stop

@section('css')

<style>
    .denuncias {
        margin-bottom: 10px
    }
</style>

@stop

@section('js')


@stop  --}}