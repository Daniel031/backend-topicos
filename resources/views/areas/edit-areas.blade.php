@extends('adminlte::page')

@section('title', 'Areas Crear')

@section('content_header')
  <div class="title">
    <h1>Editar Area</h1>
  </div>
    
@stop

@section('content')
<form action="{{route('areas.update',$area)}}" method="POST" >
    @csrf
    @method('POST')
    <div class="card card-body centrar">

    
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="{{$area->nombre}}" placeholder="Nombre de las areas">
    </div>
    <div class="form-group">
      <label for="descripcion">Descripci&oacute;n</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$area->descripcion}}" placeholder="Descripcion ">
    </div>
    <a class="btn btn-secondary" href="{{route('areas.index')}}">Atras</a>
    <hr>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
  </form>

@stop

@section('css')

<style>
    .denuncias {
        margin-bottom: 10px
    }

    .centrar{
      width:70%;
      margin:auto;
      margin-bottom: 10px
    }

    .title{
      text-align:center;
      font-size:3rem;
      font-family: 'Courier New', Courier, monospace;
    }
</style>

@stop

@section('js')


@stop