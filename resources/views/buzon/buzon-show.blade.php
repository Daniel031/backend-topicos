@extends('adminlte::page')

@section('title', 'Denuncia')

@section('content_header')
    <h1>Denuncia</h1>
@stop

@section('content')

<div class="title">
 Titulo
</div>
<div class="contain">
 {{$denuncia->titulo}}
</div>
<div class="title">
    Descripcion
</div>
<div class="contain">
    {{$denuncia->descripcion}}
</div>
<div class="title">
    Fecha
</div>
<div class="contain">
    {{$denuncia->fecha}}
</div>
<div class="title">
    Hora
</div>
<div class="contain">
    {{$denuncia->hora}}
</div>
<div class="title">
    Estado
</div>
<div class="contain title {{($denuncia->estado==1?"enProceso":($denuncia->estado==2?"aceptado":"rechazado"))}}">
    {{($denuncia->estado==1?"Pendiente":($denuncia->estado==2?"Aceptado":"Rechazado"))}}
</div>
<div class="title">
    Fotos
</div>
<div class="contain">
    @foreach ($fotos as $foto)
    <img src="{{$foto->url}}" alt="Imagen denuncia">
    @endforeach
</div>

<div class="acciones">
    <form action="" method="post">
        <a href="{{route('buzon.index')}}" class="btn btn-danger" >Cancelar</a>
        <input type="submit" class="btn btn-primary" value="Cambiar estado">
        <select class="custom-select dimensionar" name="estado" id="">
            <option value="1">Pendiente</option>
            <option value="2">Aceptada</option>
            <option value="3">Rechazada</option>
        </select>
    </form>
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
    .dimensionar {
        width: 50%
    }
    .aceptado {
        color: green
    }
    .rechazado{
        color: red
    }
    .enProceso{
        color: rgb(206, 175, 0)
    }
</style>

@stop


@section('js')


@stop