@extends('adminlte::page')

@section('title', 'Areas Crear')

@section('content_header')
    <h1>Crear Area</h1>
@stop

@section('content')
<form action="{{route('areas.store')}}" method="POST" >
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de las areas">
    </div>
    <div class="form-group">
      <label for="descripcion">Descripci&oacute;n</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion ">
    </div>
    <a class="btn btn-secondary" href="{{route('areas.index')}}">Atras</a>
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