@extends('adminlte::page')

@section('title', 'Usuarios Mostrar')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

<div class="title">
Nombre
</div>
<div class="contain">
 {{$admin->name}}
</div>
<div class="title">
    Correo Electronico
</div>
<div class="contain">
    {{$admin->email}}
</div>
<div class="title">
    Rol
</div>
<div class="contain">
    @if ($admin->administrativo)
        Usuario
    @else
        Administrador
    @endif
</div>
<div class="title">
    Area
</div>
<div class="contain">
    @if (!$admin->area_id)
        Sin definir
    @else
     {{$areas->where('id',$admin->area_id)->first()->nombre}} 
    @endif

</div>

<div class="acciones">
    <a class="btn btn-primary" href="{{route('administrativos.edit',$admin)}}">Editar</a>
    <a class="btn btn-secondary" href="{{route('administrativos.index')}}">Atras</a>
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