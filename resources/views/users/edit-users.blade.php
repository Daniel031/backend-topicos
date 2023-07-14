@extends('adminlte::page')

@section('title', 'Usuario Crear')

@section('content_header')
    <h1>Editar Usuario:  {{$admin->name}}</h1>
@stop

@section('content')



  
<form action="{{route('administrativos.update',$admin->id)}}" method="POST" >
    @csrf
    @method('POST')
    <div class="container rounded mt-2 mb-2">
    <div class="row">
      <div class="col-md-3 border-right">
          <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$admin->name}}</span><span> </span></div>
      </div>
      <div class="col-md-5 border-right">
          <div class="p-3 py-5">
              <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="text-right">Profile Settings</h4>
              </div>
              <div class="row mt-2">
                  <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="nombre" name="name" value="{{$admin->name}}"></div>
                  
              </div>
            <div class="row mt-3">
                  <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="Email" name="email" value="{{$admin->email}}"></div>

                  
              </div>
              <div class="row mt-3">
                <label class="labels">Tipo de usuario</label>
              <select class="form-control col-md-12" name="administrativo">
                <option value='0'>--</option>
                <option value='0'>Administrador</option>
                <option value='1'>Usuario</option>  
              </select>
            </div>

              <div class="row mt-12">
                  <div class="col-md-12"><label class="labels">Contraseña</label><input type="password" class="form-control" placeholder="contraseña" name="password"></div>
                 
              </div>
              
              <div class="row mt-12">
                <div class="col-md-12"><label class="labels">Verificar Contraseña</label><input type="password" class="form-control" placeholder="contraseña"></div>
             </div>

             <div class="row mt-3">
              <select class="form-control col-md-12" name="area_id">
                @foreach($areas as $area)
                <option value='{{$area->id}}'>{{$area->nombre}}</option>
                @endforeach  
              </select>
             
              </div>
               <button type="submit" class="btn btn-primary mt-5 text-center">Guardar</button>
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
   
</style>

@stop

@section('js')


@stop