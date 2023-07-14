@extends('adminlte::page')

@section('title', 'Usuario Crear')

@section('content_header')
  <div class="title">
    <h1>Editar Tipo:  {{$tipoDenuncia->nombre}}</h1>
  </div>
  
@stop

@section('content')

<form action="{{route('tipos_denuncias.update',$tipoDenuncia->id)}}" method="POST" >
    @csrf
    @method('POST')
    <div class="card centrar">

    
     <div class="container rounded mt-2 mb-2">
      <div class="row">
     
      <div class="col-md-12 border-right">
        
          <div>
              <div class="mt-3">
                 
                <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="nombre" name="nombre" value="{{$tipoDenuncia->nombre}}"></div>
                  
              </div>

              <div class="mt-3">


                  <div class="col-md-12"><label class="labels">Descripcion</label><input type="text" class="form-control" placeholder="descripcion" name="descripcion" value="{{$tipoDenuncia->descripcion}}"></div>
 
              </div>
             
              <div class="mt-3">
                <select class="form-control col-md-12" name="area_id">
                  @foreach($areas as $area)
                  <option value='{{$area->id}}'>{{$area->nombre}}</option>
                  @endforeach  
                </select>
            </div>
          
         </div>
        
      </div>
     </div>
    
 </div>
 <a class="btn btn-secondary" href="{{route('tipos_denuncias.index')}}">Atras</a>
 <hr>
 <button type="submit" class="btn btn-primary mb-2 text-center">Editar</button>
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
      text-align: center;
      font-size:3rem;
      font-family: 'Courier New', Courier, monospace;
    }
</style>

@stop

@section('js')


@stop



@extends('adminlte::page')

@section('title', 'Tipo Denuncias Editar')

@section('content_header')
    <h1>Editar tipo de denuncia</h1>
@stop

@section('content')
<form action="{{route('tipos_denuncias.update',$tipoDenuncia)}}" method="POST" >
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la denuncia" value="{{$tipoDenuncia->nombre}}" required>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripci&oacute;n</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion " value="{{$tipoDenuncia->descripcion}}">
    </div>
    <div class="form-group">
    <label for="area">
        Seleccione el &aacute;rea al que pertenece
    </label>
    <select id="area" name="area_id" class="custom-select">
        @if (!$tipoDenuncia->area_id)
        <option value="{{null}}" selected> Sin definir </option>
           @foreach($areas as $area)
            <option value="{{$area->id}}">{{$area->nombre}}</option>
           @endforeach
        @else
          <option value="{{null}}"> Sin definir </option>
          @foreach($areas as $area)
            @if ($area->id == $tipoDenuncia->area_id)
            <option value="{{$area->id}}" selected>{{$area->nombre}}</option>
            @else
              <option value="{{$area->id}}">{{$area->nombre}}</option>
            @endif
          @endforeach
        @endif
      </select>
    </div>

    <a class="btn btn-secondary" href="{{route('tipos_denuncias.index')}}">Atras</a>
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