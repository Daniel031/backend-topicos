@extends('adminlte::page')

@section('title', 'Usuario Crear')

@section('content_header')
    <div class="title">
        <h1>Informacion Del Area</h1>
    </div>
    
@stop

@section('content')

<form action="{{route('areas.update',$area->id)}}" method="POST" >
    @csrf
    @method('POST')
    <div class="card centrar">

 
    <div class="container rounded mt-2 mb-2">
        <div class="row">
     
      <div class="col-md-12 border-right">
        
          <div class="centrar">
              <div class="mt-3">
                 
                <div class="col-md-12"><label class="labels">Nombre</label><input type="text" class="form-control" placeholder="nombre" name="nombre" value="{{$area->nombre}}" disabled></div>
                  
              </div>

              <div class="mt-3">


                  <div class="col-md-12"><label class="labels">Descripcion</label><input type="text" class="form-control" placeholder="descripcion" name="descripcion" value="{{$area->descripcion}}" disabled></div>
 
              </div>
             
            <a href="{{route('areas.index')}}" class="btn btn-primary mt-5 text-center">Volver</a>
         </div>
      </div>
    </div>
 </div>
</div>
</div>
  </form>

@stop

@section('css')

<style>
    .centrar{
        width: 700px;
        margin:auto;
        display:flex;
        flex-direction: column;
        justify-content: center
    }

    .title{
        font-size:3rem;
        text-align:center;
        font-family: 'Courier New', Courier, monospace;
    }
</style>

@stop

@section('js')


@stop




@extends('adminlte::page')

@section('title', 'Area')

@section('content_header')
    <h1>Area</h1>
@stop

@section('content')

<div class="title">
Nombre
</div>
<div class="contain">
 {{$area->nombre}}
</div>
<div class="title">
    Descripci&oacute;n
</div>
<div class="contain">
    {{$area->descripcion}}
</div>

<div class="acciones">
    <a class="btn btn-primary" href="{{route('areas.edit',$area)}}">Editar</a>
    <a class="btn btn-secondary" href="{{route('areas.index')}}">Atras</a>
</div>
@stop

@section('css')

<style>
    .title {
        font-weight: bold
    }
    .acciones {
        margin-top: 10px
    }
</style>

@stop

@section('js')


@stop
