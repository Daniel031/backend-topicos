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
