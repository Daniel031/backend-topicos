
@extends('adminlte::page')

@section('title', 'Denuncia')

@section('content_header')

    @foreach($areas as $area)
            @if($area->id == $denuncia->area_id)
                <h1>Denuncias de {{$area->nombre}}</h1>
            @endif
    @endforeach
@stop

@section('content')

<form>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Titulo</label>
        <input type="text" class="form-control" id="inputEmail4" value="{{$denuncia->titulo}}" disabled>
      </div>
      <div class="form-group col-md-3">
        <label for="inputPassword4">Fecha de Denuncia</label>
        <input type="text" class="form-control" id="inputPassword4" value="{{$denuncia->fecha}}" disabled>
      </div>
      <div class="form-group col-md-3">
        <label for="inputAddress">Hora Denuncia</label>
        <input type="datetime" class="form-control" id="inputAddress" value="{{$denuncia->hora}}" disabled>
    </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="inputAddress">Descripcion</label>
            <div class="form-group purple-border">
                <textarea class="form-control" id="exampleFormControlTextarea4" rows="4" disabled>
{{$denuncia->descripcion}}</textarea>
              </div>
        </div>
        <div class="form-group col-md-4">
          <label for="inputPassword4">Estado de la Denuncia</label>
          @if($denuncia->estado == 1)
           <h2><span class="badge badge-warning">Pendiente</span></h2>
           @else
            @if($denuncia->estado == 2)
            <h2><span class="badge badge-success">Aceptada</span></h2>
            @else
            <h2><span class="badge badge-danger">Rechazada</span></h2>
            @endif
          @endif
         
        </div>
      </div>

    <div class="form-row">
        @foreach ($fotos as $foto)
            <div class="card col-md-4" style="width: 18rem;">
                <img class="card-img-top" src="{{$foto->url}}" alt="Imagen Denuncia">
              </div>

        @endforeach
        
        
       
    </div>

  </form>

<div class="acciones">
    <form action="{{route('buzon.update',$denuncia->id)}}" method="post">
        @csrf
        @method('POST')

        <div class="row">
            
            <select class="form-control col-md-6" name="estado" id="">
                <option value="1">Pendiente</option>
                <option value="2">Aceptada</option>
                <option value="3">Rechazada</option>
            </select>
            <div class="col-md-4">
                <textarea class="form-control" id="comentario" name="comentario" rows="5" placeholder="Escriba un comentario"></textarea>
                </div>
            
        </div>
            <a href="{{route('buzon.index')}}" class="btn btn-danger" >Cancelar</a>
            <input type="submit" class="btn btn-primary" value="Cambiar estado">
    </form>
</div>

@stop

@section('css')

<style>
    
</style>

@stop


@section('js')

<script>
    
</script>


@stop
