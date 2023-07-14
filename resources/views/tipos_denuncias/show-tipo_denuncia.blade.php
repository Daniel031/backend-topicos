@extends('adminlte::page')

@section('title', 'Usuario Crear')

@section('content_header')
    <div class="title">
        <h1>Informacion Tipo De Denuncia</h1>
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
        
          <div class="centrar">
              <div class="mt-3">
                 
                <div class="col-md-12"><label class="labels">Nombre Tipo Denuncia</label><input type="text" class="form-control" placeholder="nombre" name="nombre" value="{{$tipoDenuncia->nombre}}" disabled></div>
                  
              </div>

              <div class="mt-3">


                  <div class="col-md-12"><label class="labels">Descripcion</label><input type="text" class="form-control" placeholder="descripcion" name="descripcion" value="{{$tipoDenuncia->descripcion}}" disabled></div>
 
              </div>
             
              <div class="mt-3">
                <label class="labels">Area</label>
                    @foreach($areas as $area)
                            @if($area->id==$tipoDenuncia->area_id)
                            <input type="text" class="form-control" name="descripcion" value="{{$area->nombre}}" disabled>
                            @endif
                    @endforeach  
                
            </div>
            <a href="{{route('tipos_denuncias.index')}}" class="btn btn-primary mt-5 text-center">Volver</a>
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

