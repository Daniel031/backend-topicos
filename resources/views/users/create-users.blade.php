@extends('adminlte::page')

@section('title', 'Usuario Crear')

@section('content_header')
    <h1>Crear nuevo usuario</h1>
@stop

@section('content')
<form action="{{route('administrativos.store')}}" method="POST" >
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario" required>
    </div>
    <div class="form-group">
      <label for="email">Correo electronico</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Correo electronico" required>
    </div> 
    <div class="form-group">
        <label for="password">Contrase&ntilde;a</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" min="8" required>
    </div>
    <div class="form-group">
        <label for="tipo">
            Tipo
        </label>
        <select id="tipo" name="administrativo" class="custom-select">
            <option value="0">Usuario</option>
            <option value="1">Administrador</option>
        </select>
    </div>
    <div class="form-group">
        <label for="area">
            Area
        </label>
        <select id="area" name="area_id" class="custom-select">
            <option value="{{null}}" selected> Sin definir </option>
          @foreach($areas as $area)
            <option value="{{$area->id}}">{{$area->nombre}}</option>
          @endforeach
        </select>
    </div>
    <a class="btn btn-secondary" href="{{route('administrativos.index')}}">Atras</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>

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