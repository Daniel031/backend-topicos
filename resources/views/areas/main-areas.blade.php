@extends('adminlte::page')

@section('title', 'Areas')

@section('content_header')
    <h1>Areas</h1>
@stop

@section('content')

<div class="denuncias">
    <a class="btn btn-primary" href="{{route('areas.create')}}">+Crear</a>
</div>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripci&oacute;n</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($areas as $area)
           
              <tr>
                <td >{{$area->nombre}}</td>
                <td>{{$area->descripcion}}</td>
                <td>{{$area->estado?'Habilitado':'Deshabilitado'}}</td>
                <td>
                    <form action="{{route('areas.destroy',$area)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{route('areas.edit',$area)}}" class="btn btn-secondary">Editar</a>
                        <a href="{{route('areas.show',$area)}}" class="btn btn-info">Mostrar</a>
                        <Button type="submit" class="{{$area->estado?'btn btn-danger':'btn btn-success'}}">{{$area->estado?"Deshabilitar":"Habilitar"}}</Button>
                    </form>
                </td>
               </tr>
         
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