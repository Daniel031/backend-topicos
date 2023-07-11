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


@stop