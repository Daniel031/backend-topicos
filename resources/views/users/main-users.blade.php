@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

<div class="denuncias">
    <a class="btn btn-primary" href="{{route('administrativos.create')}}">+Crear</a>
</div>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nombre de usuario</th>
                <th scope="col">Correo electronico</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td >{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->estado?"Habilitado":"Deshabilitado"}}</td>
                <td>
                    <form action="{{route('administrativos.destroy',$user)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{route('administrativos.edit',$user)}}" class="btn btn-secondary">Editar</a>
                        <a href="{{route('administrativos.show',$user)}}" class="btn btn-info">Mostrar</a>
                        <Button type="submit" class="{{$user->estado?'btn btn-danger':'btn btn-success'}}">{{$user->estado?"Deshabilitar":"Habilitar"}}</Button>
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