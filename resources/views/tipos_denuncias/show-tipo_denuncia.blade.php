@extends('adminlte::page')

@section('title', 'Tipo Denuncias')

@section('content_header')
    <h1>Tipos de denuncias</h1>
@stop

@section('content')

<div class="title">
Nombre
</div>
<div class="contain">
 {{$tipoDenuncia->nombre}}
</div>
<div class="title">
    Descripci&oacute;n
</div>
<div class="contain">
    {{$tipoDenuncia->descripcion}}
</div>
<div class="title">
    Area
</div>
<div class="contain">
    @if (!$tipoDenuncia->area_id)
        Sin definir
    @else
     {{$areas->where('id',$tipoDenuncia->area_id)->first()->nombre}} 
    @endif

</div>

<div class="acciones">
    <a class="btn btn-primary" href="{{route('tipos_denuncias.edit',$tipoDenuncia)}}">Editar</a>
    <a class="btn btn-secondary" href="{{route('tipos_denuncias.index')}}">Atras</a>
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