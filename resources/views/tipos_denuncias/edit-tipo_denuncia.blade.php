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