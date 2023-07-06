@extends('adminlte::page')

@section('title', 'Buzon')

@section('content_header')
    <h1>Buzon de denucias</h1>
@stop

@section('content')

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($datos as $vectores)
              @foreach ($vectores as $denuncia)
              <tr>
                <td >{{$denuncia->titulo}}</td>
                <td>{{$denuncia->descripcion}}</td>
                <td>{{($denuncia->estado == 1)?"En proceso":(($denuncia->estado == 2)?"Aprobado":"Rechazado")}}</td>
                <td>{{$denuncia->fecha}}</td>
                <td>
                    <form action="{{route('buzon.update',$denuncia->id)}}" method="POST">
                        <select name="estado" class="custom-select medium">
                            <option value="1">En proceso</option>
                            <option value="2">Aprobado</option>
                            <option value="3">Rechazado</option>
                        </select>
                        @csrf
                        <button class="btn btn-primary" type="submit">Cambiar estado</button>
                    </form>
                </td>
               </tr>
              @endforeach

              @endforeach 
            </tbody>
          </table>
@stop

@section('css')

<style>
    .medium {
        width: 50%
    }
    .denuncias {
        margin-bottom: 10px
    }
</style>

@stop

@section('js')


@stop