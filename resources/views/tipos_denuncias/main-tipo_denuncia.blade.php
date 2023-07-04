@extends('adminlte::page')

@section('title', 'Tipo Denuncias')

@section('content_header')
    <h1>Tipos de denuncias</h1>
@stop

@section('content')

<div class="denuncias">
    <a class="btn btn-primary" href="{{route('tipos_denuncias.create')}}">+Crear</a>
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
              @foreach($tipos as $tipo)

              <tr>
                <td >{{$tipo->nombre}}</td>
                <td>{{$tipo->descripcion}}</td>
                <td>{{$tipo->estado?'Habilitado':'Deshabilitado'}}</td>
                <td>
                    <form action="{{route('tipos_denuncias.destroy',$tipo)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{route('tipos_denuncias.edit',$tipo)}}" class="btn btn-secondary">Editar</a>
                        <a href="{{route('tipos_denuncias.show',$tipo)}}" class="btn btn-info">Mostrar</a>
                        <Button type="submit" class="{{$tipo->estado?'btn btn-danger':'btn btn-success'}}">{{$tipo->estado?"Deshabilitar":"Habilitar"}}</Button>
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