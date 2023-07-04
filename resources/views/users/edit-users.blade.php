@extends('adminlte::page')

@section('title', 'Usuario Editar')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')
<form action="{{route('administrativos.update',$admin)}}" method="POST" >
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario" value="{{$admin->name}}" required>
    </div>
    <div class="form-group">
      <label for="email">Correo electronico</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Correo electronico" value="{{$admin->email}}" required>
    </div> 
    <div class="form-group">
        <label for="password">Contrase&ntilde;a</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" >
    </div>
    <div class="form-group">
        <label for="tipo">
            Tipo
        </label>
        <select id="tipo" name="administrativo" class="custom-select">
            @if (!$admin->administrativo)
            <option value="0" selected>Usuario</option>
            <option value="1">Administrador</option>
            @else
            <option value="0">Usuario</option>
            <option value="1" selected>Administrador</option>
            @endif


        </select>
    </div>
    <div class="form-group">
        <label for="area">
            Area
        </label>
        <select id="area" name="area_id" class="custom-select">
            @if (!$admin->area_id)
            <option value="{{null}}" selected> Sin definir </option>
               @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->nombre}}</option>
               @endforeach
            @else
              <option value="{{null}}"> Sin definir </option>
              @foreach($areas as $area)
                @if ($area->id == $admin->area_id)
                <option value="{{$area->id}}" selected>{{$area->nombre}}</option>
                @else
                  <option value="{{$area->id}}">{{$area->nombre}}</option>
                @endif
              @endforeach
            @endif
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