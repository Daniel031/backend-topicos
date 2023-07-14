@extends('adminlte::page')

@section('title', 'Tipo Denuncias Editar')

@section('content_header')
  
  <div class="title">
    <h1>Crear Area</h1>
  </div>

@stop

@section('content')
<form action="{{route('areas.store')}}" method="POST" >
    @csrf
    @method('POST')


    <div class="card card-body centrar">
      <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la denuncia"  required>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripci&oacute;n</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion " >
      </div>
      <a class="btn btn-secondary" href="{{route('areas.index')}}">Atras</a>
      <hr>
      <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
  </form>

@stop

@section('css')

<style>
    .centrar {
      width:70%;
      margin:auto;
      margin-bottom: 10px
    }

    .title{
      font-size:3rem;
      text-align:center;
      font-family: 'Courier New', Courier, monospace;
      font-style:bold;
      font-weight: 600;
    }
</style>

@stop

@section('js')


@stop
